<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public static function isUserAllowed($allowedRoles, $role) {
    //     $isAllowed = false;
    //     for ($i = 0; $i < count($allowedRoles); $i++) {
    //         if ($role == $allowedRoles[$i]) {
    //             $isAllowed = true;
    //             break;
    //         }
    //     }

    //     if (!$isAllowed) {
    //         return response([
    //             'message' => 'Unauthorized access',
    //             'data' => ''
    //         ], 403); 
    //     }
    // }
}
