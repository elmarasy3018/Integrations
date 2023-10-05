<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use Illuminate\Support\Facades\DB;

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

        foreach ($orders as $order) {
            foreach ($order->line_items as $line) {
                DB::table('order_product_sku')->insert([
                    // 'type' => 'example',
                    'quantity' => $line->quantity,
                    'piece_price' => $line->price,
                    'final_price_for_product' => $line->total,
                ]);
            }
            DB::table('orders')->insert([
                'name' => $order->shipping->first_name.' '.$order->shipping->last_name,
                'address' => $order->shipping->address_1,
                'city' => $order->shipping->city,
                'phone' => $order->billing->phone,
                'product_number' => count($order->line_items),
                'final_price' => $order->total,
            ]);
        }

        return 'Done';
    }
}
