<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function __invoke(Request $request): RedirectResponse
    {
        $request->user()->notifications()->update(['read_at' => now()]);
        return redirect()->back();
    }
}
