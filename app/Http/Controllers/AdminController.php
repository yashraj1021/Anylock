<?php

namespace App\Http\Controllers;

use App\Http\Service\AdminService;
use App\Http\Service\DatabaseHelper;
use App\Locker;
use App\LockerRental;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewAdminDashboard(){

        $lockerCount = Locker::count();
        $lockerRentalCount = LockerRental::count();
        $userCount = User::count();

        return view("admin.dashboard", compact('lockerRentalCount', 'userCount', 'lockerCount'));
    }

    public function viewAllUsers(){
        $users = User::all();
        return view("admin.manageUsers", compact("users"));
    }

    public function setUserAdmin(Request $request){
        $user = User::find($request->user_id);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect(route("allUsers"))->with(['alert' => 'success', 'alertMessage' => $user->name."'s admin status has been updated."]);
    }

    public function viewAllLockers(){
        $rentals = LockerRental::all();
        return view("admin.rentals", compact("rentals"));
    }

    public function viewAdminPendingLockerRentalPage(){

        $pendingRentals = LockerRental::where("status", "pending")->with("locker")->get();

        return view("admin.pendingRentals", compact("pendingRentals"));
    }

    public function confirmLockerRental(Request $request){

        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->confirmRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental confirmed!"]);
    }

    public function cancelLockerRental(Request $request){
        $rental = LockerRental::where("id", $request->rental_id)->get()->first();
        $rental->cancelRental();

        return redirect()->back()->with(["alert" => "success", "alertMessage"=>"Locker rental cancelled!"]);
    }

    public function expiry_list() {
        $expired = AdminService::get_expiry_list('expired');
        $expiring = AdminService::get_expiry_list('expiring');
        return view('admin.expiry', compact('expired', 'expiring'));
    }

    public function location_list(){
        $locations = AdminService::get_locations();
        $lockers = AdminService::get_lockers();

        return view('admin.lockerIssues', compact('locations', 'lockers'));
    }

    public function update_status(Request $request) {
        $route = Route::current();
        if (empty($request))
            return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => 'Error trying to delete the submission.']);

        $status = "";

        if($request->broken)
        {
            $status = "broken";
        }
        else if($request->fixed)
        {
            $status = "available";
        }
        $updateReturn = AdminService::update_locker_status($request->locker_id, $status);

        if($updateReturn)
        {
            return redirect()->back()->with(['alert' => 'success', 'alertMessage' => 'The locker status has been updated.']);
        }

        return redirect()->back()->with(['alert' => 'danger', 'alertMessage' => "The locker status did not update. Please try again."]);
    }
}