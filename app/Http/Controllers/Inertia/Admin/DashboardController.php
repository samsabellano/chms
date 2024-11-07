<?php

namespace App\Http\Controllers\Inertia\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberResource;
use App\Services\MemberService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private MemberService $memberService)
    {
    }

    public function index()
    {
        return inertia("admin/dashboard/Index");
    }
}
