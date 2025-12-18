<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'url',
        'method',
        'data',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->created_at = now();
        });
    }

    /**
     * Get the user that performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'UserID');
    }

    /**
     * Log user activity
     */
    public static function logActivity(
        int $userId,
        string $action,
        string $module,
        string $description,
        array $data = [],
        string $url = null,
        string $method = 'GET'
    ): void {
        $request = request();
        
        static::create([
            'user_id' => $userId,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'url' => $url ?? $request->fullUrl(),
            'method' => $method ?? $request->method(),
            'data' => $data,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Get activity logs for a specific user
     */
    public static function getUserActivity(int $userId, int $limit = 50)
    {
        return static::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent activity across all users
     */
    public static function getRecentActivity(int $limit = 100)
    {
        return static::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activity by module
     */
    public static function getModuleActivity(string $module, int $limit = 50)
    {
        return static::with('user')
            ->where('module', $module)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}