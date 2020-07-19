<?php
namespace App\Traits;

trait Helpers
{
    function notificationMsg($type, $message) {
        // Session::put($type, $message);
        session([$type => $message]);
    }
}
