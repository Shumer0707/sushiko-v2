<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $service
    ) {}

    public function index(Request $request)
    {
        $data = $this->service->getListData($request);

        return Inertia::render('Admin/Orders/Index', $data);
    }
}
