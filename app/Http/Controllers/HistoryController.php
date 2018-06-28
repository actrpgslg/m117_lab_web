<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DayRecord;
class HistoryController extends Controller
{
    public function index(){
    	return view('history.index');
    }
}
