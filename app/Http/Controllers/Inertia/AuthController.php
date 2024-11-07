<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin()
    {
        return inertia("Auth/Signin");
    }
}
