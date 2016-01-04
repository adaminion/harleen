<?php

namespace App\Http\Controllers;

use Storage;
use Excel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DatabaseController extends Controller
{
    public function index()
    {
        $path = 'C:/Users/Adam/Desktop/Storage Center/Archive/Arsip Sumberdaya/2011/Data Source/';
        $source2011 = Storage::disk('2011')->files();
        Excel::load($path . $source2011[0], function($reader) {
            $reader->get();
        });
        return view('database.index');
    }
}
