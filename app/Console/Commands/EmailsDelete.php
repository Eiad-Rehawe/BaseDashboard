<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EmailsDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete un verifired regestered accounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now();
        $daysToAdd = 7;
        $date = $date->addDays($daysToAdd);
       $users= DB::table('users')->where('created_at','<',$date)->where('email_verified_at',null)->delete();
      
        return 'success';
    }
}
