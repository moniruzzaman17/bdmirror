<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Citizen;
use App\Models\Authority;
use App\Models\Message;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
      view()->composer('*', function ($view) 
      {
        if (Auth::guard('citizen')->check()) {
            $id = Auth::guard('citizen')->user()->id;
            // Logged user's details
            $logedUser = Citizen::where('id',$id)->first();
            $view->with('logedUser', $logedUser );

            // total conversation
            $msgNotifications = Message::distinct()->select('sender_id','sender_type')->where('receiver_id', $id)->where('receiver_type','citizen')->orderBy('id', 'DESC')->get();
            $totalConversation =  count($msgNotifications);
            $view->with('totalConversation', $totalConversation );
        }
        if (Auth::guard('authority')->check()) {
            $id = Auth::guard('authority')->user()->id;
            // Logged user's details
            $logedUser = Authority::where('id', $id)->first();
            $view->with('logedUser', $logedUser );

            // total conversation
            $msgNotifications = Message::distinct()->select('sender_id','sender_type')->where('receiver_id', $id)->where('receiver_type','authority')->orderBy('id', 'DESC')->get();
            $totalConversation =  count($msgNotifications);
            $view->with('totalConversation', $totalConversation );
        }
        $divisions = Division::get();
        $view->with('divisions', $divisions );
      });
    }
}
