<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\Order;

class WoocommerceController extends Controller
{
    public function index()
    {
        return view('woocommerce');
    }
    public function fetchData(Request $request)
    {
        config(['woocommerce.store_url' => $request->input('store_url')]);
        config(['woocommerce.consumer_key' => $request->input('consumer_key')]);
        config(['woocommerce.consumer_secret' => $request->input('consumer_secret')]);

        $orders = Order::all();
        // dd($orders);
        return $orders;
    }
}
