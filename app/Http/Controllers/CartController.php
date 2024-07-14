<?php

namespace App\Http\Controllers;

use App\Services\AdminApiService;

class CartController extends Controller
{

    public function index()
    {
        $products = session()->get('cart.products') ?? [];
        return view('cart', compact('products'));
    }

    public function buy()
    {
        $adminApiService = app(AdminApiService::class);

        $products = session()->get('cart.products') ?? [];
        $response = $adminApiService->sendRequest('POST', 'orders', $products);

//        if ($response['message']) {
//            return redirect()->route('cart.index')->with('message', $response['message']);
//        }

        session()->flush();

        return redirect('/')->with('order_number', $response['number']);
    }
}
