<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function getMyBills()
    {
        $user = request()->user();
        $payStatus = request()->query('status');

            switch ($payStatus){
                case 'paid':
                    $bills = $user->bills()->where('is_paid', '=', true)->get()->all();
                    break;
                case 'nonpaid':
                    $bills = $user->bills()->where('is_paid', '=', false)->get()->all();
                    break;
                default:
                    $bills = $user->bills()->get()->all();
            }

        return view('front.bills')->with(compact('bills'));
    }

    public function getMyFriends()
    {
        $user = request()->user();
        $friendStatus = request()->query('status');

        switch ($friendStatus){
            case 'confirmed':
                $friends = $user->getConfirmedFriends();
                break;
            default:
                $friends = $user->myFriends()->get()->all();
        }

        return view('front.friends')->with(compact('friends'));
    }

    public function getCurrentUser()
    {
        $user = request()->user();
    }

    public function getUserById($id)
    {
        $user = User::find($id);
    }
}
