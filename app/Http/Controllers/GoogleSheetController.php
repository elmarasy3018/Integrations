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

        $sheets = Sheets::spreadsheet($id)->sheet('Sheet1')->get();
        // dd($sheets);
        // $header = $sheets->pull(0);
        // $posts = Sheets::collection($header, $sheets);
        // $posts = $posts->take(5000);

        $data = $sheets->toArray();

        // dd($sheets[count($sheets) - 1][0]);
        // if (count($sheets) - 1 > -1) {
        //     DB::table('header')
        //         ->where('sheetID', $id)
        //         ->update(['lastRow' => $sheets[count($sheets) - 1][0]]);
        // }

        if ($data) {
            foreach ($data as $row) {
                // dd($row);
                DB::insert('insert into google (order_id, customer_id, product_id, user_id) values(?,?,?,?)', [$row[1], $row[5], $row[13], -1]);
            }
            // DB::select('select * from google where active = ?', [1]);
            $db = DB::select('select distinct order_id, user_id from google');

            foreach ($db as $row) {
                $order = DB::select('select * from google where order_id = ? AND user_id = ?', [$row->order_id, $row->user_id]);
                dd($order);
            }
        } else {
            $table = 'No data';
        }
        return view('google-sheet', ['table' => $table]);
    }

    // extract the id from the url
    private function getSpreadsheetIdFromLink($link)
    {
        preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $link, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }
}
