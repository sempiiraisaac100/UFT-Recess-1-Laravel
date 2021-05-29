<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\User;
use DB;
use App\Models\Treasury;

class charts2 extends Controller
{
    public function period(Request $request){
        // $labels=[];
        $static=$request->input('period');
        // return $static;
if($static==2){
    $labels=["First Sixth","Second Sixth"," Third sixth","Forth Sixth","Fifth Sixth","Sixth Sixth"];
    $funding=[];
    // $i=1;
$funds=treasury::all()->pluck('amount');

$i=2;
while($i<13){
    $new=0;
$new=$funds[$i-1]+$funds[$i-2];
array_push($funding,$new);
$i=$i+2;

}
// return $funding;

}

if($static==3){
    $labels=["First Quarter","Second Quarter"," Third Quarter","Forth Quarter"];
    $funding=[];
    // $i=1;
$funds=treasury::all()->pluck('amount');

$i=3;
while($i<13){
    $new=0;
$new=$funds[$i-1]+$funds[$i-2]+$funds[$i-3];
array_push($funding,$new);
$i=$i+3;

}
 // return $funding;

}
if($static==4){
    $labels=["First Third","Second Third"," Third Third"];
    $funding=[];
    // $i=1;
$funds=treasury::all()->pluck('amount');

$i=4;
while($i<13){
    $new=0;
$new=$funds[$i-1]+$funds[$i-2]+$funds[$i-3]+$funds[$i-4];
array_push($funding,$new);
$i=$i+4;

}


}
if($static==6){
    $labels=["First Half","Second Half",];
    $funding=[];
    // $i=1;
$funds=treasury::all()->pluck('amount');

$i=6;
while($i<13){
    $new=0;
$new=$funds[$i-1]+$funds[$i-2]+$funds[$i-3]+$funds[$i-4]+$funds[$i-5]+$funds[$i-6];
array_push($funding,$new);
$i=$i+6;

}


}
// print_r($labels);
//   return $funding;



        $cha = Charts::create('bar','chartjs')
        ->title('Funding Per Month')
        ->elementLabel("Fundings")
        ->labels($labels)
        ->Values($funding)
        ->colors(['#008000', '#000000','#800000'])
        ->Dimensions(1000,500)
        ->Responsive(false);
        return view('period', compact('cha'));



    }
}
