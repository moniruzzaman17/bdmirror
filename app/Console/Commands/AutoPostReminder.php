<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoPostReminderMail;
use App\Models\Citizen;

class AutoPostReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autopost:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send autopost reminder';

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
     * @return int
     */
    public function handle()
    {
        
        $complaints = Complaint::with('citizen')->where('is_autopost', 1)->get();
        $currentDatetime  = Carbon::now();
        
        foreach ($complaints as $key => $complaint) {
            $columnDatetime = Carbon::parse($complaint->created_at);
            
            $words = explode(' ', $complaint->details);
                $title = '';
                for ($i=0; $i < 9 ; $i++) { $title .=$words[$i]." "; } 
                $title.=" ....";

            if ($columnDatetime->diffInDays($currentDatetime, false) >= 5) {
                Mail::to([$complaint->citizen->email])->send(new AutoPostReminderMail($title,$complaint));
                echo "mail sent";
            }
            else{
                echo "not sent";
            }
        }
    }
}
