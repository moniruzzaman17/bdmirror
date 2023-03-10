<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Complaint;
use Carbon\Carbon;

class AutoPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Complaitn for auto post if condition true publish complaint automatically';

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
        $complaints = Complaint::where('is_autopost', 1)->get();
        $currentDatetime  = Carbon::now();
    
        foreach ($complaints as $key => $complaint) {
            $columnDatetime = Carbon::parse($complaint->created_at);
// dd($columnDatetime->diffInDays($currentDatetime, false));
            if ($columnDatetime->diffInDays($currentDatetime, false) >= 10) {
                Complaint::where('id', $complaint->id)->update([
                    'is_autopost' => 0,
                ]);
                echo "matched";
            }
            else{
                echo "not match";
            }
        }
    }
}
