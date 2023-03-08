<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    // public function index()
    // {
    //     return view('map.index');
    // }
    
    public function index(Request $request)
    {
        
        $location = "Jagannath University";

        $response1 = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $location,
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ]);

        $data1 = $response1->json();

        if ($data1['status'] == 'OK') {
            $latitude = $data1['results'][0]['geometry']['location']['lat'];
            $longitude = $data1['results'][0]['geometry']['location']['lng'];
            
            // Use the latitude and longitude to perform additional actions
            // (e.g. finding the nearest police station)
        } else {
            // Handle error response from the Geocoding API
        }

        // $latitude = $request->input('latitude');
        // $longitude = $request->input('longitude');

        $response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json', [
            'location' => $latitude . ',' . $longitude,
            'radius' => 5000,
            'type' => 'police',
            'key' => env('GOOGLE_MAPS_API_KEY'),
        ]);

        $data = $response->json();
// dd($data);
        $policeStations = collect($data['results'])->map(function ($result) {
            return [
                'name' => $result['name'],
                'vicinity' => $result['vicinity'],
                'latitude' => $result['geometry']['location']['lat'],
                'longitude' => $result['geometry']['location']['lng'],
            ];
        });

        return view('map.index', ['policeStations' => $policeStations]);
    }
}
