<?php

namespace App\Http\Controllers;

use App\Services\AdminApiService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $adminApiService = app(AdminApiService::class);
        $orders = $adminApiService->sendRequest('GET', 'orders');

        return view('orders', compact('orders'));
    }
}
