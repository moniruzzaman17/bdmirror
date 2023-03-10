<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Complaint;
use Carbon\Carbon;

class CheckComplaintSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complaint:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command always check for complaint which need to publish in scheduled time';

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
        $complaints = Complaint::whereNotNull('publish_datetime')->get();
        $now = Carbon::now();
        foreach ($complaints as $key => $complaint) {
        // dd($complaint->publish_datetime);
            if ($complaint->publish_datetime <= $now) {
                Complaint::where('id', $complaint->id)->update([
                    'visibility' => 1,
                ]);
            }
            else{
                echo "not match";
            }
        }
        // return $complaints;
    }
}
