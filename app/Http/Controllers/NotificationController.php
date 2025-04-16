<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index($role)
    {
        $user = auth()->user();
        if (!in_array($role, ['admin', 'tu', 'kaprodi', 'mahasiswa'])) {
            abort(404);
        }
        $notifications = auth()->user()->notifications()->paginate(15);
        return view($role.'.notifications.index', compact('notifications', 'role', 'user'));
    }
    
    
    
    public function markAsRead($role, $id)
    {
        if (!in_array($role, ['admin', 'tu', 'kaprodi', 'mahasiswa'])) {
            abort(404);
        }
        
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
