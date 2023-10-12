<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Sheets;

class GoogleSheetController extends Controller
{
    public function index()
    {
        return view('google-sheet');
    }

    public function fetchData(Request $request)
    {
        $id = $this->getSpreadsheetIdFromLink($request->input('google_sheet_link'));

        // $lastRow = DB::table('header')
        //     ->select('lastRow')
        //     ->where('sheetID', $id)
        //     ->get();
        // dd($lastRow[0]->lastRow + 1);
        // $range = ($lastRow[0]->lastRow + 2) . ':999';
        // dd($range);

        $sheets = Sheets::spreadsheet($id)->sheet('Sheet1')->range('3:12')->get();
        $lines = $sheets->toArray();

        foreach ($lines as $line) {
            if ($line[1]) {
                DB::table('orders')->insert([
                    // 'ip' => $line[7],
                    // 'approximate_location' => $location->timezone . '-' . $location->countryName . '-' . $location->regionName . '-' . $location->cityName,
                    'name' => $line[6],
                    'address' => $line[9],
                    'city' => $line[8],
                    'phone' => $line[11],
                    // 'landing_page' => $line['order_status_url'],
                    // 'notice' => $line['note'],
                    // 'product_number' => count($line['line_items']), ----->> need call
                    // 'final_price' => $line['total_price'],
                    // 'country_id' => Country::where('code', $line['note_attributes'][0]['value'])->first()->id,
                    // 'created_at' => $line['created_at'],
                    // 'updated_at' => $line['created_at'],
                ]);
                $order_id = $line[2];
                $product_number = 1;
                $total_price = 0;
            }
            DB::table('order_product_sku')->insert([
                // 'product_sku_id' => '2',
                // 'product_sku_id' => Country::where('code', $ordertoArray['line_items']['sku'])->first()->id,
                'order_id' => $order_id,
                'type' => 'Normal',
                'quantity' => $line[18],
                'piece_price' => $line[17],
                'final_price_for_product' => $line[19],
                // 'created_at' => $ordertoArray['created_at'],
                // 'updated_at' => $ordertoArray['created_at'],
            ]);
            $total_price += $line[19];
            DB::table('orders')
                ->where('id', $order_id)
                ->update(['final_price' => $total_price, 'product_number' => $product_number++]);
            // $order = DB::table('orders')->find($order_id); ----------> ezzz
            // $order->final_price = $total_price;
            // $order->save();
        }
        // if (count($sheets) - 1 > -1) {
        //     DB::table('header')
        //         ->where('sheetID', $id)
        //         ->update(['lastRow' => $sheets[count($sheets) - 1][0]]);
        // }
        return 'Done';
    }

    // extract the id from the url
    private function getSpreadsheetIdFromLink($link)
    {
        preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $link, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }
}
