<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ImportExcelController extends Controller
{
    function index() {
        $data = DB::table('prices')->orderBy('created_at', 'DESC')->get();
    }
}
