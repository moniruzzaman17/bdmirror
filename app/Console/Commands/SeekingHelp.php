<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Citizen;
use Illuminate\Support\Facades\Http;
class SeekingHelp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:help';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending autoamted help mail';

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
        echo $this->getCurrentLocation();
        // $citizenforhelp = Citizen::where('seeking_help', 1)->get();
        
        // $url = request('url');
        // $address = request('address');
        // $citizen_id = request('citizen_id');
        // $citizen = Citizen::with('helpinfo')->where('id', $citizen_id)->first();
        // $emails = array();
        // $mobiles = array();

        // foreach ($citizen->helpinfo as $key => $help) {
        //     // array_push($emails, $help->email);
        //     // array_push($mobiles, $help->mobile);
        //     Mail::to([$help->email])->send(new WelcomeMail($url,$help->mobile,$address));
        // }
        // Citizen::where('id', $citizen_id)->update([
        //     'seeking_help' => 1
        // ]);
        // return true;
    }
    public function getCurrentLocation()
        {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => 'current+location',
                'key' => env('AIzaSyCHKJ5ggeSmrqD2nX95OzGUOrJl6eT-y0M')
            ]);

            $data = $response->json();

            $latitude = $data['results'][0]['geometry']['location']['lat'];
            $longitude = $data['results'][0]['geometry']['location']['lng'];

            return $latitude.$longitude;
        }
}
