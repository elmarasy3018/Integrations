<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Signifly\Shopify\Shopify;

class ShopifyController extends Controller
{
    public function index()
    {
        return view('shopify');
    }
    public function fetchData(Request $request)
    {
        config(['shopify.credentials.access_token' => $request->input('access_token')]);
        config(['shopify.credentials.domain' => $request->input('domain')]);
        $shopify = \Signifly\Shopify\Factory::fromConfig();
        $count = $shopify->getOrders();  // On Live Change From Draft to Orders
        // dd($count);
        return $count;
    }
}
