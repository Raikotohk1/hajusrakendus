<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecordsController extends Controller
{
    public function index()
    {
        $responseData = Http::get('https://hajusrakendus.ta22maarma.itmajakas.ee/api/records')->json();

        return view('records.index', ['products' => $responseData]);
    }
}

