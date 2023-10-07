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

        DB::transaction(function () {
            $x = DB::table('marketer_stores')
                ->select('last_order_id')
                ->where('url', 'https://ahmedhisham.socialgossip.website/')
                ->get();
            dd($x);

            $orders = Order::all();

            dd($orders);

            foreach ($orders as $order) {
                // $location = Location::get($order->customer_ip_address);
                // dd($order);
                DB::table('orders')->insert([
                    'ip' => $order->customer_ip_address,
                    // 'approximate_location' => $location->timezone . '-' . $location->countryName . '-' . $location->regionName . '-' . $location->cityName,
                    'name' => $order->shipping->first_name . ' ' . $order->shipping->last_name,
                    'address' => $order->shipping->address_1,
                    'city' => $order->shipping->city,
                    'phone' => $order->billing->phone,
                    'landing_page' => $order->payment_url,
                    'notice' => $order->customer_note,
                    'product_number' => count($order->line_items),
                    'final_price' => $order->total,
                    // 'country_id' => Country::where('code', $order->billing->country)->first()->id,
                    'created_at' => $order->date_created,
                    'updated_at' => $order->date_modified,
                ]);
                $order_id = DB::getPdo()->lastInsertId();
                foreach ($order->line_items as $line) {
                    DB::table('order_product_sku')->insert([
                        'product_sku_id' => '2',
                        'order_id' => $order_id,
                        'type' => 'Normal',
                        'quantity' => $line->quantity,
                        'piece_price' => $line->price,
                        'final_price_for_product' => $line->total,
                        'created_at' => $order->date_created,
                        'updated_at' => $order->date_modified,
                    ]);
                }
            }
        });
        return 'Done';
    }
}
