<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Charts;
use App\User;
use DB;
use App\Models\Treasury;
use App\Models\Member;
class chartController extends Controller
{
    //
     public function index()
    {
        $perc = DB::select(DB::raw("SELECT DATE_FORMAT(DateOfEnroll,'%M %Y') as month,COUNT(*) as total from members GROUP BY month"));


// SELECT  month(created_at) as month,COUNT(*) as total from members GROUP BY month (created_at)
            //DB::raw("COALESCE((LEAD(total)OVER(ORDER BY months DESC)-total)/total,0) Percent_Change")

     //   (val - LAG(val))/LAG(val)  OVER w AS 'lag diff']

 $value=array();
    $updatedvalue=array();
    $month=array();
    foreach($perc as $i)
    {
    array_push($value,$i->total);
    array_push($month,$i->month);
    }
    for($i=0;$i<count($value)-1;$i++){
        array_push($updatedvalue,(($value[$i+1]-$value[$i])/$value[$i]));
    }
    // return $month;
        $chart1 = Charts::create('bar', 'highcharts')
			      ->title("Percentage Change")
                  ->elementLabel("Percentage Change")
                  ->labels($month)
                  ->colors(['#008000', '#FFFF00','#800000'])
                  ->dimensions(1000, 500)
                  ->values($updatedvalue)
                  ->responsive(false);
			      //->groupByMonth(date('Y'), true);
        //return view('chart',compact('chart'));

//$users= DB::table('treasury')->pluck('amount')->get();
//treasury::where(\DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'),
    				//(\DB::raw("amount")))
$users = treasury::where(DB::raw("(DATE_FORMAT(received_on,'%Y'))"),date('Y'))->get();
        $chart= Charts::database($users, 'bar', 'chartjs')
			      ->title("Funding Per Month")
			      ->elementLabel("funds")
                  ->dimensions(1000, 500)
                  ->colors(['#008000', '#4B0082','#800000'])
                  ->responsive(false)
			      ->groupByMonth(date('Y'), true);
        return view('chart',compact('chart1','chart'));










    }
}
