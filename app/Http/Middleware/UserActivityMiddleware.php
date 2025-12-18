<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserActivityLog;
use Symfony\Component\HttpFoundation\Response;

class UserActivityMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log for authenticated users
        if (Auth::check()) {
            $this->logActivity($request, $response);
        }

        return $response;
    }

    /**
     * Log the user activity
     */
    private function logActivity(Request $request, Response $response): void
    {
        // Skip logging for certain routes/conditions
        if ($this->shouldSkipLogging($request, $response)) {
            return;
        }

        $user = Auth::user();
        $route = $request->route();
        $routeName = $route ? $route->getName() : null;
        $method = $request->method();
        
        // Determine module and action from route
        $moduleInfo = $this->extractModuleInfo($request, $routeName);
        
        // Create description
        $description = $this->createDescription($moduleInfo, $method, $request);
        
        // Prepare additional data
        $data = $this->prepareLogData($request, $response);

        // Log the activity
        UserActivityLog::logActivity(
            $user->UserID,
            $moduleInfo['action'],
            $moduleInfo['module'],
            $description,
            $data,
            $request->fullUrl(),
            $method
        );
    }

    /**
     * Determine if we should skip logging this request
     */
    private function shouldSkipLogging(Request $request, Response $response): bool
    {
        // Skip AJAX requests for search/autocomplete
        if ($request->ajax() && $request->has('search')) {
            return true;
        }

        // Skip asset requests
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf)$/i', $request->path())) {
            return true;
        }

        // Skip failed requests (4xx, 5xx)
        if ($response->getStatusCode() >= 400) {
            return true;
        }

        // Skip certain routes
        $skipRoutes = [
            'debugbar.*',
            'horizon.*',
            '_ignition.*',
        ];

        $routeName = $request->route()?->getName();
        if ($routeName) {
            foreach ($skipRoutes as $pattern) {
                if (fnmatch($pattern, $routeName)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Extract module and action information from the request
     */
    private function extractModuleInfo(Request $request, ?string $routeName): array
    {
        $path = $request->path();
        $method = $request->method();
        
        // Default values
        $module = 'system';
        $action = 'page_visit';

        // Extract from route name if available
        if ($routeName) {
            $parts = explode('.', $routeName);
            
            if (count($parts) >= 2) {
                $module = $parts[0];
                $actionMap = [
                    'index' => 'page_visit',
                    'show' => 'view',
                    'create' => 'page_visit',
                    'store' => 'create',
                    'edit' => 'page_visit',
                    'update' => 'update',
                    'destroy' => 'delete',
                ];
                $action = $actionMap[$parts[1]] ?? $parts[1];
            }
        } else {
            // Extract from URL path
            $pathParts = explode('/', trim($path, '/'));
            
            if (!empty($pathParts[0])) {
                $module = $pathParts[0];
                
                // Determine action from method and path
                if ($method === 'POST') {
                    $action = 'create';
                } elseif ($method === 'PUT' || $method === 'PATCH') {
                    $action = 'update';
                } elseif ($method === 'DELETE') {
                    $action = 'delete';
                } elseif (isset($pathParts[1]) && is_numeric($pathParts[1])) {
                    $action = 'view';
                } else {
                    $action = 'page_visit';
                }
            }
        }

        // Handle special modules
        if (str_starts_with($path, 'tools/')) {
            $module = 'tools';
            if (isset(explode('/', $path)[1])) {
                $module = 'tools.' . explode('/', $path)[1];
            }
        }

        return [
            'module' => $module,
            'action' => $action,
        ];
    }

    /**
     * Create a human-readable description
     */
    private function createDescription(array $moduleInfo, string $method, Request $request): string
    {
        $module = $moduleInfo['module'];
        $action = $moduleInfo['action'];
        
        $descriptions = [
            'page_visit' => "Visited {$module} page",
            'view' => "Viewed {$module} details",
            'create' => "Created new {$module} record",
            'update' => "Updated {$module} record",
            'delete' => "Deleted {$module} record",
            'login' => "Logged into the system",
            'logout' => "Logged out of the system",
        ];

        $description = $descriptions[$action] ?? "Performed {$action} on {$module}";

        // Add specific record ID if available
        $route = $request->route();
        if ($route && $route->hasParameter('id')) {
            $id = $route->parameter('id');
            $description .= " (ID: {$id})";
        }

        return $description;
    }

    /**
     * Prepare additional data to log
     */
    private function prepareLogData(Request $request, Response $response): array
    {
        $data = [];

        // Add route parameters
        if ($request->route()) {
            $parameters = $request->route()->parameters();
            if (!empty($parameters)) {
                $data['route_parameters'] = $parameters;
            }
        }

        // Add form data for POST/PUT requests (excluding sensitive fields)
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            $formData = $request->except([
                'password',
                'password_confirmation',
                '_token',
                '_method',
            ]);
            
            if (!empty($formData)) {
                $data['form_data'] = $formData;
            }
        }

        // Add query parameters
        if ($request->query()) {
            $data['query_parameters'] = $request->query();
        }

        return $data;
    }
}