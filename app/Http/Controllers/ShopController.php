<?php

namespace App\Http\Controllers;

use App\Services\AdminApiService;
use App\Services\WeatherApiService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{

    const CURRENT_LOCATION = 'Moscow';

    public function index(): View
    {
        $items = [];
        $weatherApiService = app(WeatherApiService::class);
        $forecast = WeatherService::wrap($weatherApiService->getWeeklyWeather(static::CURRENT_LOCATION));

        return view('mainPage', compact('items', 'forecast'));
    }

    public function productsAll(): View
    {
        $items = [];
        $adminApiService = app(AdminApiService::class);
        $items = $adminApiService->getProducts();

        return view('mainPage', compact('items'));
    }

    public function add(Request $request)
    {
        $request->session()->push('cart.products', json_decode($request->input('product'), true));
        return redirect()->route('products.index');
    }
}
