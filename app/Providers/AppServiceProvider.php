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
use App\Models\Complaint;
use App\Models\Comment;
use App\Models\Notification;

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

            // citizen notification
            $notifications = Notification::where('citizen_id', $id)->orderBy('id', 'DESC')->get();
            $view->with('notifications', $notifications );
            // dd( $notifications);
            $notificationsCount = Notification::where('citizen_id', $id)->where('is_read', 0)->count();
            $view->with('notificationsCount', $notificationsCount);
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
            
            // authority notification
            $notifications = Notification::where('authority_id', $id)->orderBy('id', 'DESC')->get();
            $view->with('notifications', $notifications );
            // dd( $notifications);
            $notificationsCount = Notification::where('authority_id', $id)->where('is_read', 0)->count();
            $view->with('notificationsCount', $notificationsCount);
        }
        $divisions = Division::get();
        $view->with('divisions', $divisions );

        $globalComplaint = Complaint::with('medias','comments','comments.citizen','ratings','citizen','citizen.ratings','complaintdivision','complaintdistrict','complaintupazila')->where('visibility', 1)->where('is_published', 1)->orderBy('updated_at','DESC')->get();
        $view->with('globalComplaint', $globalComplaint );

      });
    }
}
