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
        return view('front.user')->with(compact('user'));
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        return view('front.user')->with(compact('user'));
    }

    public function getMyDebtors()
    {
        $user = request()->user();
        $items = $user->items()->get()->all();
        $debtorsBills = [];
        foreach ($items as $item){
            $bills = $item->bills()->get()->all();
            foreach ($bills as $bill){
                if ($bill->payer_id !== $user->id){
                    $debtorsBills[] = $bill;
                }
            }
        }

        return view('front.debtors')->with(['bills' => $debtorsBills]);
    }

    public function getAll()
    {
        $users = User::get()->all();
        return view('front.users')->with(compact('users'));
    }

    public function editCurrentUser()
    {
        $user = request()->user();
        return view('front.edit-user')->with(compact('user'));
    }

    public function updateCurrentUser()
    {
        $this->validate(request(), [
            'name' => 'required',
            'nickname' => 'required',
            'email' => 'required',
        ]);
        $userId = request()->user()->id;
        $user = User::findOrFail($userId);
        $user->update(request()->all());

        return redirect('/user/me');
    }

    public function addToFriends($user_id)
    {
        $user = request()->user();
        $someUser = User::findOrFail($user_id);

        if (!$user->isFriend($someUser->id)){
            $user->myFriends()->attach($someUser->id);
        }

        return redirect()->back();
    }

    public function deleteFromFriends($user_id)
    {
        $user = request()->user();
        $someUser = User::findOrFail($user_id);

        if ($user->isFriend($someUser->id)){
            $user->myFriends()->detach($someUser->id);
        }

        return redirect()->back();
    }
}
