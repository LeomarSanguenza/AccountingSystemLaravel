<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserActivityController extends Controller
{
    /**
     * Display user activity logs
     */
    public function index(Request $request)
    {
        $query = UserActivityLog::with('user')->orderBy('created_at', 'desc');

        // Filter by user if specified
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by module if specified
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // Filter by action if specified
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $activities = $query->paginate(50);

        // Get filter options
        $users = User::select('UserID', 'FirstName', 'LastName', 'Username')
            ->orderBy('FirstName')
            ->get();

        $modules = UserActivityLog::select('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        $actions = UserActivityLog::select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('activity-logs.index', compact('activities', 'users', 'modules', 'actions'));
    }

    /**
     * Show activity for a specific user
     */
    public function userActivity(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        
        $activities = UserActivityLog::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('activity-logs.user', compact('activities', 'user'));
    }

    /**
     * Show my activity (current user)
     */
    public function myActivity(Request $request)
    {
        $user = Auth::user();
        
        $activities = UserActivityLog::where('user_id', $user->UserID)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('activity-logs.my-activity', compact('activities', 'user'));
    }

    /**
     * Get activity statistics
     */
    public function statistics()
    {
        $stats = [
            'total_activities' => UserActivityLog::count(),
            'today_activities' => UserActivityLog::whereDate('created_at', today())->count(),
            'this_week_activities' => UserActivityLog::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
            'this_month_activities' => UserActivityLog::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];

        // Most active users
        $activeUsers = UserActivityLog::selectRaw('user_id, COUNT(*) as activity_count')
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('activity_count', 'desc')
            ->limit(10)
            ->get();

        // Most accessed modules
        $popularModules = UserActivityLog::selectRaw('module, COUNT(*) as access_count')
            ->groupBy('module')
            ->orderBy('access_count', 'desc')
            ->limit(10)
            ->get();

        // Recent activities
        $recentActivities = UserActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('activity-logs.statistics', compact(
            'stats',
            'activeUsers',
            'popularModules',
            'recentActivities'
        ));
    }

    /**
     * Export activity logs
     */
    public function export(Request $request)
    {
        $query = UserActivityLog::with('user')->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->limit(5000)->get(); // Limit for performance

        $filename = 'user_activity_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($activities) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Date/Time',
                'User',
                'Action',
                'Module',
                'Description',
                'URL',
                'Method',
                'IP Address',
            ]);

            // CSV data
            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity->created_at->format('Y-m-d H:i:s'),
                    $activity->user ? $activity->user->FirstName . ' ' . $activity->user->LastName : 'Unknown',
                    $activity->action,
                    $activity->module,
                    $activity->description,
                    $activity->url,
                    $activity->method,
                    $activity->ip_address,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}