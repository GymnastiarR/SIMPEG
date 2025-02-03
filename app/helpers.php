<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('define_vacation_status')) {
    function define_vacation_status($var)
    {
        if (is_null($var->first_approval)) {
            return ['status' => 'Pending', 'color' => 'warning'];
        }

        if ($var->first_approval == 0) {
            return ['status' => 'Rejected', 'color' => 'danger'];
        }

        if (is_null($var->second_approval)) {
            return ['status' => 'Pending', 'color' => 'warning'];
        }

        return $var->second_approval ? ['status' => 'Approved', 'color' => 'success'] : ['status' => 'Rejected', 'color' => 'danger'];
    }
}

if (! function_exists('define_approval_status')) {
    function define_approval_status($var)
    {
        if (is_null($var)) {
            return ['status' => 'Pending', 'color' => 'warning'];
        }

        return $var ? ['status' => 'Approved', 'color' => 'success'] : ['status' => 'Rejected', 'color' => 'danger'];
    }
}

if (! function_exists('get_notifications')) {
    function get_notifications(string $user_id)
    {
        $notifications = \App\Models\Notification::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        $there_is_unread_notification = $notifications->where('read_at', null)->count() > 0;

        return [$notifications, $there_is_unread_notification];
    }
}

if (! function_exists('approval_status')) {
    function approval_status($var)
    {
        if ($var->departement->first_approver_id == Auth::user()->id) {
            if (is_null($var->first_approval)) {
                return ['status' => 'Pending', 'color' => 'warning'];
            }

            if ($var->first_approval == 0) {
                return ['status' => 'Rejected', 'color' => 'danger'];
            }

            if ($var->first_approval == 1) {
                return ['status' => 'Approved', 'color' => 'success'];
            }
        }

        if ($var->departement->second_approver_id == Auth::user()->id) {
            if (is_null($var->second_approval)) {
                return ['status' => 'Pending', 'color' => 'warning'];
            }

            if ($var->second_approval == 0) {
                return ['status' => 'Rejected', 'color' => 'danger'];
            }

            if ($var->second_approval == 1) {
                return ['status' => 'Approved', 'color' => 'success'];
            }
        }
    }
}
