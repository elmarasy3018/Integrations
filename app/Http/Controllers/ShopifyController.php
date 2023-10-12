<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Signifly\Shopify\Factory;

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

        // DB::transaction(function () {

        $shopify = Factory::fromConfig();
        // $orders = $shopify->getOrders();
        $orders = $shopify->get('orders.json?fulfillment_status=');
        // $orders = $shopify->put('orders/5480056783136.json', ["contact_email" => "test2@test.com"]);
        // $orders = $shopify->updateOrder(5480056783136, ["contact_email" => "test2@test.com"]);
        // $orders = $shopify->getOrder(5480056783136);
        return $orders;
        foreach ($orders as $order) {
            $ordertoArray = $order->toArray();

            // $location = Location::get($order->customer_ip_address);
            // dd($ordertoArray['shipping_address']['address1']);
            // dd($ordertoArray['note_attributes'][0]['value']);
            DB::table('orders')->insert([
                'ip' => $ordertoArray['note_attributes'][9]['value'],
                // 'approximate_location' => $location->timezone . '-' . $location->countryName . '-' . $location->regionName . '-' . $location->cityName,
                'name' => $ordertoArray['shipping_address']['first_name'] . ' ' . $ordertoArray['shipping_address']['last_name'],
                'address' => $ordertoArray['shipping_address']['address1'],
                'city' => $ordertoArray['shipping_address']['city'],
                'phone' => $ordertoArray['shipping_address']['phone'],
                'landing_page' => $ordertoArray['order_status_url'],
                'notice' => $ordertoArray['note'],
                'product_number' => count($ordertoArray['line_items']),
                'final_price' => $ordertoArray['total_price'],
                // 'country_id' => Country::where('code', $ordertoArray['note_attributes'][0]['value'])->first()->id,
                // 'created_at' => $ordertoArray['created_at'],
                // 'updated_at' => $ordertoArray['created_at'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $order_id = DB::getPdo()->lastInsertId();
            foreach ($ordertoArray['line_items'] as $line) {
                DB::table('order_product_sku')->insert([
                    'product_sku_id' => '2',
                    // 'product_sku_id' => Country::where('code', $ordertoArray['line_items']['sku'])->first()->id,
                    'order_id' => $order_id,
                    'type' => 'Normal',
                    'quantity' => $line['quantity'],
                    'piece_price' => $line['price'],
                    'final_price_for_product' => $line['quantity'] * $line['price'],
                    // 'created_at' => $ordertoArray['created_at'],
                    // 'updated_at' => $ordertoArray['created_at'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        // });
        // return 'Done';
    }
}
