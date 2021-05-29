<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EnrolNum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enroll:number';

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
        $districts = DB::table('districts')->pluck('name');
        foreach($districts as $district){
                $count = DB::table('members')
                    ->where('district',$district)
                    ->count();
                DB::table('districts')
                    ->where('name',$district)
                    ->update(['enrollments'=>$count]);

        }
    }
}
