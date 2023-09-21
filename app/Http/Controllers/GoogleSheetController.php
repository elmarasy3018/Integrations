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

        // Sheets::spreadsheet($id)->sheet('Sheet1')->range('A4')->update([['3', 'name3', 'mail3']]);
        // $values = Sheets::range('')->all();
        // $values = Sheets::spreadsheet($id)->sheet('Sheet1')->range('V2:V10')->update([['3']]);
        // dd($values);

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

        $table = '<table>';
        if ($data) {
            foreach ($data as $row) {
                $table .= '<tr>';
                foreach ($row as $cell) {
                    $table .= '<td class="py-2 px-4 border border-gray-200">' . $cell . '</td>';
                }
                $table .= '</tr>';
            }
            $table .= '</table>';
        } else {
            $table = 'No data';
        }

        return view('google-sheet', ['table' => $table]);
    }

    private function getSpreadsheetIdFromLink($link)
    {
        preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $link, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }
}
