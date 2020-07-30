<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Created By Nahla Sameh
     * Check if current user authenticate current functionality or not
     * @return bool
     */
    public function authenticate()
    {
        /* Get requested resource*/
        $resource = class_basename(Route::current()->controller) . '@' . request()->route()->getActionMethod();

        /* check user permissions if has requested resource*/
        if (Auth::check() && in_array($resource, Auth::user()->permissions)) {
            return true;
        } else {
            return false;
        }
    }
}
