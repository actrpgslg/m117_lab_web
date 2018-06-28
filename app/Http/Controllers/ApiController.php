<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DayRecord;
use Excel;

class ApiController extends Controller
{
    public function All(){
    	ini_set('memory_limit', '2048M');
    	set_time_limit(0);

        $All=DayRecord::orderBy('Date','desc');
    	Excel::create('環境資料', function ($excel) use ($All) {
	        $excel->sheet('Sheet', function ($sheet) use ($All) {
	            $sheet->appendRow(array(
	                'id',
	                'date',
	                'device',
	                'temp' ,
	                'hum',
	                'light',
	                'dark',
	                'sound',
	            ));

	            foreach ($All->cursor() as $row){
	                $sheet->appendRow(array(
	                    $row->id,
	                    $row->Date,
	                    $row->device,
	                    $row->temp,
	                    $row->hum,
	                    $row->light,
	                    $row->dark,
	                    $row->sound,
	                    $row->air_quality
	                ));
	            }
	        });

	    })->download('csv');
	}
	public function Year(){

	}
}
