<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class PaymentUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sumOfTreasury = DB::table('treasury')->sum('amount');
        $sumPayable = $sumOfTreasury - 2000000;
        if($sumPayable > 0){
            //total number of districts with  agents in the system
            $allDistricts = DB::table('agents')->distinct('district')->pluck('district');
            $numDistrict = $allDistricts->count('district');
            $numAgent  = DB::table('agents')->where('role','Agent')->count();

            //district(s) with the highest number of enrollments
            $maxEnrol = DB::table('districts')->max('enrollments');
            $highDistrict = DB::table('districts')->where([['enrollments',$maxEnrol],['agents','>',0]])
                                                  ->pluck('name');

            $highnumDistrict = $highDistrict->count('name');

            //districts with low enrollment
            $lowDistrict = DB::table('districts')->where([['enrollments','not',$maxEnrol],['agents','>',0]])
            ->pluck('name');

            $highnum = 0;
            foreach($highDistrict as $district){
                $highAgent = DB::table('agents')->where([['district',$district],['role','Agent']])->count('name');

                //compute the sum of agents with high enrollment
                $highnum += $highAgent;
            }

            //check if all districts have equal enrollments
            if($numDistrict != $highnumDistrict){
                //standard agent salary per month
                $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+(1.75*$highnumDistrict)+$numAgent+$highnum);

                //payment description

                $adminPay = 1/2*$stdAgentSalary;
                $stdAgentH = 7/4*$stdAgentSalary;
                $highAgentH = 2*$stdAgentH;
                $highAgent = 2*$stdAgentSalary;
                //inserts into the payment table... hell yeah!!!!

                DB::table('payments')->updateOrInsert(['Role'=>'Administrator'],['Salary'=>$adminPay,'Number'=>1,'Total'=>$adminPay]);
                DB::table('payments')->updateOrInsert(['Role'=>'High-Agent-Head'],['Salary'=>$highAgentH, 'Number'=>$highnumDistrict,'Total'=>$highnumDistrict*$highAgentH]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent-Head'],['Salary'=>$stdAgentH,'Number'=>($numDistrict-$highnumDistrict),'Total'=>($numDistrict-$highnumDistrict)*$stdAgentH]);
                DB::table('payments')->updateOrInsert(['Role'=>'High-Agent'],['Salary'=>$highAgent,'Number'=>$highnum,'Total'=>$highAgent*$highnum]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent'],['Salary'=>$stdAgentSalary,'Number'=>($numAgent-$highnum),'Total'=>$stdAgentSalary*($numAgent-$highnum)]);

                //populating the agent table with the salaries
                $roles = DB::table('agents')->distinct('role')->pluck('role');
                foreach($roles as $role){
                    if(Str::is('Agent-Head',$role)){
                        foreach($highDistrict as $districts){
                            DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$highAgentH]);

                        }
                        foreach($lowDistrict as $districts){
                            DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$stdAgentH]);
                        }
                    }
                    else{
                        foreach($highDistrict as $districts){
                            DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$highAgent]);

                        }
                        foreach($lowDistrict as $districts){
                            DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$stdAgentSalary]);
                        }

                    }


                }
            }

            else{
                $stdAgentSalary = $sumPayable/(1/2+(7/4*$numDistrict)+$numAgent);
                $adminPay = 1/2*$stdAgentSalary;
                $stdAgentH = 7/4*$stdAgentSalary;

                 //remove previous records
                 DB::table('payments')->truncate();

                //insert into payment tables
                DB::table('payments')->updateOrInsert(['Role'=>'Administrator'],['Salary'=>$adminPay,'Number'=>1,'Total'=>$adminPay]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent-Head'],['Salary'=>$stdAgentH,'Number'=>$numDistrict,'Total'=>$numDistrict*$stdAgentH]);
                DB::table('payments')->updateOrInsert(['Role'=>'Agent'],['Salary'=>$stdAgentSalary,'Number'=>$numAgent,'Total'=>$stdAgentSalary*$numAgent]);

                //insert salaries into the agents table
                $roles = DB::table('agents')->distinct('role')->pluck('role');
                foreach($lowDistrict as $districts){
                    foreach($roles as $role){
                        if(Str::is('Agent-Head',$role)){

                                DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$stdAgentH]);

                        }
                        else{
                                DB::table('agents')->where([['role',$role],['district',$districts]])->update(['salary'=>$stdAgentSalary]);
                            }

                        }


                }


            }


        }
        else{
            DB::table('payments')->truncate();
            DB::table('agents')->update(['salary'=>0]);
        }

        //dumping payments to text fill for C server to read

        $districts = DB::table('districts')->pluck('name');
        $pay = DB::table('agents')->pluck('salary','name');

        $count = $pay->count();

        $pay = Arr::divide($pay->toArray());

        foreach($districts as $district){
            $names = DB::table('agents')->where('district',$district)->pluck('name');
            foreach($names as $name){
                $i = 0;
                while($i != $count){
                    if(Str::is($name,$pay[0][$i])){
                        Storage::append('payments/'.$district.'.txt',$pay[0][$i]."    ".$pay[1][$i]);

                    }
                    $i +=1;
                }
            }

        }

    }
}
