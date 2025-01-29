<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check authentication
        if (!$user) {
            Log::warning('Unauthenticated admin access attempt', [
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);
            return redirect()->route('admin.login')
                ->with('error', 'Please log in to access the admin panel.');
        }

        // Check admin status
        if (!$user->isAdmin()) {
            Log::warning('Unauthorized admin access attempt', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'ip' => $request->ip(),
                'path' => $request->path(),
            ]);
            
            // Optional: Add more granular responses
            return response()->view('errors.403', [
                'message' => 'You do not have permission to access the admin panel.'
            ], 403);
        }

        return $next($request);
    }
}
