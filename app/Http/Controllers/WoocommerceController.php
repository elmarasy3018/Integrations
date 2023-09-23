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

        // config(['woocommerce.store_url' => 'https://woo-sweetly-important-panda.wpcomstaging.com/']);
        // config(['woocommerce.consumer_key' => 'ck_a713c773dbf64a0848b52bd4425af1687394632b']);
        // config(['woocommerce.consumer_secret' => 'cs_1b9251a89be1cd911c3860cb1f44eae654b1a679']);

        $orders = Order::all();
        // dd($orders);
        return $orders;
    }
}
