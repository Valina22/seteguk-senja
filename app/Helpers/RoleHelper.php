<?php

if (!function_exists('checkAdminRole')) {
    function checkAdminRole($requiredRole)
    {
        return session()->get('admin_role') === $requiredRole;
    }
}
