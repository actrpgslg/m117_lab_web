<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DayRecord;

class HomeController extends Controller
{
	function get_chinese_weekday($datetime){
	    $weekday = date('w', strtotime($datetime));
	    return '星期' . ['日', '一', '二', '三', '四', '五', '六'][$weekday];
	}
	public function TimeLineCheck($Array){
		for($i=0;$i<=count($Array);$i++){
			if($Array[$i]['HourEnd']==$Array[$i]['HourStart']){
				unset($Array[$i]);
			}
		}
		return $Array;
	}
	public function SplitterMonthArray($inputData,$Month,$status){
		if($status==5){
			$list= array(
				'Year'  	=> $inputData['Year'],
				'Month' 	=> $inputData['Month'],
				'Day'   	=> $inputData['Day'],
				'Weekday'   => $this->get_chinese_weekday($inputData['Year'].'-'.$Month.'-'.$inputData['DayEnd']),
				'HourStart' => $inputData['HourStart'],
				'YearEnd'   => $inputData['Year'],
				'MonthEnd'  => $inputData['MonthEnd'],
				'DayEnd'    => $inputData['DayEnd'],
				'WeekdayEnd'   => $this->get_chinese_weekday($inputData['YearEnd'].'-'.$Month.'-'.$inputData['DayEnd']),
				'HourEnd'   => $inputData['HourEnd'],
		        'Light' 	=> $inputData['Light'],
		        'Dark'  	=> $inputData['Dark'],
		        'Bool'  	=> $inputData['Bool'],
		        'IF'  		=> $inputData['IF']
		        ,'status'  		=> $status
	        );
		}
		return $list;
	}
	public function SplitterDayArray($inputData,$day,$status){
		if($status==1){
			$list= array(
				'Year'  	=> $inputData['Year'],
				'Month' 	=> $inputData['Month'],
				'MonthEnd'  => $inputData['Month'],
				'Weekday'   => $this->get_chinese_weekday($inputData['Year'].'-'.$inputData['Month'].'-'.$day),
				'Day'   	=> $day,
				'DayEnd'    => $day,
				'HourStart' => $inputData['HourStart'],
				'HourEnd'   => 24,
		        'Light' 	=> $inputData['Light'],
		        'Dark'  	=> $inputData['Dark'],
		        'Bool'  	=> $inputData['Bool'],
		        'IF'  		=> $inputData['IF']
		        ,'status'  		=> $status
	        );
		}else if($status==2){
			$list= array(
				'Year'  	=> $inputData['Year'],
				'Month' 	=> $inputData['Month'],
				'MonthEnd'  => $inputData['Month'],
				'Weekday'   => $this->get_chinese_weekday($inputData['Year'].'-'.$inputData['Month'].'-'.$day),
				'Day'   	=> $day,
				'DayEnd'    => $day,
				'HourStart' => 0,
				'HourEnd'   => 24,
		        'Light' 	=> $inputData['Light'],
		        'Dark'  	=> $inputData['Dark'],
		        'Bool'  	=> $inputData['Bool'],
		        'IF'  		=> $inputData['IF']
		        ,'status'  		=> $status
	        );
		}else if($status==3){
			
			$list= array(
				'Year'  	=> $inputData['Year'],
				'Month' 	=> $inputData['Month'],
				'MonthEnd'  => $inputData['Month'],
				'Weekday'   => $this->get_chinese_weekday($inputData['Year'].'-'.$inputData['Month'].'-'.$day),
				'Day'   	=> $day,
				'DayEnd'    => $day,
				'HourStart' => 0,
				'HourEnd'   => $inputData['HourEnd'],
		        'Light' 	=> $inputData['Light'],
		        'Dark'  	=> $inputData['Dark'],
		        'Bool'  	=> $inputData['Bool'],
		        'IF'  		=> $inputData['IF']
		        ,'status'  		=> $status
	        );
		}else if($status==4){
			$list= array(
				'Year'  	=> $inputData['Year'],
				'Month' 	=> $inputData['Month'],
				'MonthEnd'  => $inputData['Month'],
				'Weekday'   => $inputData['Weekday'],
				'Day'   	=> $inputData['Day'],
				'DayEnd'    => $inputData['DayEnd'],
				'HourStart' => $inputData['HourStart'],
				'HourEnd'   => $inputData['HourEnd'],
		        'Light' 	=> $inputData['Light'],
		        'Dark'  	=> $inputData['Dark'],
		        'Bool'  	=> $inputData['Bool'],
		        'IF'  		=> $inputData['IF']
		        ,'status'  		=> $status
	        );
		}
		return $list;
	}
	public function ArrayAdd($monthLast,$inputData,$if,$status){
		if($status==0){
			$list= array(
			'Year'  	  => intval(date("Y",strtotime($inputData->Date))),
			'Month' 	  => intval(date("m",strtotime($inputData->Date))),
			'Day'   	  => intval(date("d",strtotime($inputData->Date))),
			'Weekday'     => $this->get_chinese_weekday($inputData->Date),
			'HourStart'   => $inputData->Hour,
			
			'YearEnd'  	  => intval(date("Y",strtotime($inputData->Date))),
			'MonthEnd'    => intval(date("m",strtotime($inputData->Date))),
			'DayEnd'      => intval(date("d",strtotime($inputData->Date))),
			'WeekdayEnd'  => $this->get_chinese_weekday($inputData->Date),
			'HourEnd'     => $inputData->Hour,

	        'Light' => $inputData->Light,
	        'Dark'  => $inputData->Dark,
	        'Bool'  => $monthLast,
	        'IF'  =>$if
	        );
		}else if($status==1){
			$list= array(
			'Year'  	=> intval(date("Y",strtotime($inputData->Date))),
			'Month' 	=> intval(date("m",strtotime($inputData->Date))),
			'Day'   	=> intval(date("d",strtotime($inputData->Date))),
			'Weekday'   => $this->get_chinese_weekday($inputData->Date),
			'HourStart' => 0,

			'YearEnd'  	=> intval(date("Y",strtotime($inputData->Date))),
			'MonthEnd' => intval(date("m",strtotime($inputData->Date))),
			'DayEnd'    => intval(date("d",strtotime($inputData->Date))),
			'WeekdayEnd'   => $this->get_chinese_weekday($inputData->Date),
			'HourEnd'   => $inputData->Hour,

			'Light' 	=> $inputData->Light,
	        'Dark'  	=> $inputData->Dark,
	        'Bool'  	=> $monthLast,
	        'IF'  		=>$if
	        );
		}
		return $list;
	}
	public function SplitterDay($Array){
		$ArrayRecored=array();
		for($i=0;$i<=count($Array)-1;$i++){
			/*
			if($Array[$i]['Month']!=$Array[$i]['MonthEnd']){
				$MonthStart=$Array[$i]['Month'];
				$MonthEnd=$Array[$i]['MonthEnd'];
				$if=$Array[$i]['IF'];
				for($Month=$MonthStart;$Month<=$MonthEnd;$Month++){
					if($Month==$MonthStart){
						$list=$this->SplitterMonthArray($Array[$i],$Month,5);
					}else if($Month==$MonthEnd ){
						$list=$this->SplitterMonthArray($Array[$i],$MonthEnd,5);
					}else if ($Month!=$MonthStart && $Month!=$MonthEnd){
						$list=$this->SplitterMonthArray($Array[$i],$Month,5);
					}
					array_push($ArrayRecored,$list);
				}
			}
			*/
			if($Array[$i]['Day']!=$Array[$i]['DayEnd']){
				$dayStart=$Array[$i]['Day'];
				$dayEnd=$Array[$i]['DayEnd'];
				$if=$Array[$i]['IF'];
				for($day=$dayStart;$day<=$dayEnd;$day++){
					if($day==$dayStart){
						$list=$this->SplitterDayArray($Array[$i],$day,1);
					}else if($day==$dayEnd ){
						$list=$this->SplitterDayArray($Array[$i],$dayEnd,3);
					}else if ($day!=$dayStart && $day!=$dayEnd){
						$list=$this->SplitterDayArray($Array[$i],$day,2);
					}
					array_push($ArrayRecored,$list);
				}
			}else{
				$list=$this->SplitterDayArray($Array[$i],0,4);
				array_push($ArrayRecored,$list);
			}
		}
		
		return $ArrayRecored;
	}
	public function DayEnd($Array,$monthRecord){
		$i=count($Array)-1;
		if($monthRecord->Hour==0){
			$Array[$i]['HourEnd'] = 24;
		}else{
			$Array[$i]['HourEnd'] = $monthRecord->Hour;
		}
		$Array[$i]['DayEnd'] = intval(date("d",strtotime($monthRecord->Date)));
		$Array[$i]['MonthEnd'] = intval(date("m",strtotime($monthRecord->Date)));
		return $Array;                                                                               
	}
	public function DayArrayCheck($Array){
		for($i=0;$i<=count($Array)-1;$i++){
			if($Array[$i]['DayEnd']-$Array[$i]['Day']==1 && $Array[$i]['HourEnd']==24){
				$Array[$i]['DayEnd']=$Array[$i]['Day'];
			}
		}
		return $Array;
	}
	public function TimeLine($query){
		$monthArray=array();
		if($query[0]->Light >=$query[0]->Dark){
			$monthLast=1;
			$monthNow=1;
			$list=$this->ArrayAdd($monthLast,$query[0],'Light',0);
		}else{
			$monthLast=0;
			$monthNow=0;
			$list=$this->ArrayAdd($monthLast,$query[0],'Dark',0);
		}
		array_push($monthArray,$list);

		foreach ($query as $monthRecord) {
			if($monthRecord->Light >= $monthRecord->Dark){
				$monthNow=1;
				if($monthLast!=$monthNow){
					$monthArray=$this->DayEnd($monthArray,$monthRecord);

					$list=$this->ArrayAdd($monthLast,$monthRecord,'Light',0);
					array_push($monthArray,$list);
					$monthLast=$monthNow;
				}
			}else{
				$monthNow=0;
				if($monthLast!=$monthNow){
					$monthArray=$this->DayEnd($monthArray,$monthRecord);
					$list=$this->ArrayAdd($monthLast,$monthRecord,'Dark',0);
					array_push($monthArray,$list);
					$monthLast=$monthNow;
				}
			}
		}
		$monthArray=$this->DayEnd($monthArray,$monthRecord);
		$monthArray=$this->DayArrayCheck($monthArray);
		$monthArray=$this->SplitterDay($monthArray);
		//$monthArray=$this->TimeLineCheck($monthArray);

		return $monthArray;
	}



	public function index(){
		$datetime=date("Y-m-d");
		$datemonth=date("Y-m");
		//$datemonth='2017-11';
		$nows=DayRecord::offset(0)->limit(72)->orderBy('Date','desc')->get();

		$monthRecords=DayRecord::selectRaw(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d') as 'Date', hour(`Date`) as 'Hour', ROUND(AVG(`light`))as 'Light', ROUND(AVG(`dark`)) as 'Dark'"))->whereRaw(DB::raw("DATE_FORMAT(`Date`,'%Y-%m')='$datemonth'"))->groupBy(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d'),hour(`Date`)"))->get();
		$monthArray=$this->TimeLine($monthRecords);

		$dayRecord=DayRecord::selectRaw(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d') as 'Date', hour(`Date`) as 'Hour', ROUND(AVG(`temp`)) as 'Temp', ROUND(AVG(`hum`)) as 'Hum', ROUND(AVG(`light`))as 'Light', ROUND(AVG(`dark`)) as 'Dark',ROUND(AVG(`sound`)) as 'Sound',ROUND(AVG(`air_quality`)) as 'Air'"))->whereRaw(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d')='$datetime'"))->groupBy(DB::raw('hour(`Date`)'))->get();

		$data=array('dayrecords' => $dayRecord,'Nows' => $nows,'monthRecords' =>$monthArray);

		return view('home.index',$data);
	}
	public function TimeLineChar(){
		$dateYear=date("Y");
		$monthRecords=DayRecord::selectRaw(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d') as 'Date', hour(`Date`) as 'Hour', ROUND(AVG(`temp`)) as 'Temp', ROUND(AVG(`hum`)) as 'Hum', ROUND(AVG(`light`))as 'Light', ROUND(AVG(`dark`)) as 'Dark',ROUND(AVG(`sound`)) as 'Sound',ROUND(AVG(`air_quality`)) as 'Air'"))->whereRaw(DB::raw("DATE_FORMAT(`Date`,'%Y')='$dateYear'"))->groupBy(DB::raw("DATE_FORMAT(`Date`,'%Y-%m-%d'),hour(`Date`)"))->get();

		$monthArray=$this->TimeLine($monthRecords);
		//return $monthArray;
		$data=array('monthRecords' =>$monthArray);
		return view('home.TimeLineChar',$data);
	}
}
