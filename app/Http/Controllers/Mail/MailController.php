<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\Citizen;
use Auth;
// use Geocoder\Provider\GoogleMaps\GoogleMaps;
// use Geocoder\Query\GeocodeQuery;
// use Http\Client\Common\HttpMethodsClient;
// use Http\Discovery\HttpClientDiscovery;
// use Http\Discovery\MessageFactoryDiscovery;

class MailController extends Controller
{
    public function sendMail(){
        // Mail::to($user->email)->send(new WelcomeEmail($user));
        // Auth::guard('citizen')->user()->name;
        $url = request('url');
        $address = request('address');
        $citizen_id = request('citizen_id');
        $citizen = Citizen::with('helpinfo')->where('id', $citizen_id)->first();
        $emails = array();
        $mobiles = array();
        foreach ($citizen->helpinfo as $key => $help) {
            // array_push($emails, $help->email);
            // array_push($mobiles, $help->mobile);
            Mail::to([$help->email])->send(new WelcomeMail($url,$help->mobile,$address));
        }
        Citizen::where('id', $citizen_id)->update([
            'seeking_help' => 1
        ]);
        return true;

        // if (Mail::to(["moon199715@gmail.com","demo.dkkd@gmail.com"])->send(new WelcomeMail($this->getCurrentLocation()))) {
        //     echo "Mail Sent";
        // }
        // else{
        //     echo "Not Sent";
        // }
    }
    public function cancelHelp(){
        Citizen::where('id', request('citizen_id'))->update([
            'seeking_help' => 0
        ]);
        return true;
    }
}
