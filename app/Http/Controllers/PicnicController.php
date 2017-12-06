<?php

namespace App\Http\Controllers;

use App\Models\Picnic;

class PicnicController extends Controller
{
    public function getMyPicnicList(){
        $user = request()->user();
        $picnics = $user->picnics()->get()->all();

        return view('front.dashboard')->with(compact('picnics'));
    }

    public function addPicnic()
    {
        return view('front.add-picnic');
    }

    public function createPicnic()
    {

    }

    public function getItems($id)
    {
        $picnic = Picnic::find($id);
        $items = $picnic->items()->get()->all();

        return view('front.picnic')->with(compact('picnic','items'));
    }

    public function getBills($id)
    {
        $picnic = Picnic::find($id);
        $bills = $picnic->bills()->get()->all();

        return view('front.picnic-bills')->with(compact('picnic','bills'));
    }

    public function getMembers($id)
    {
        $picnic = Picnic::find($id);
        $members = $picnic->members()->get()->all();

        return view('front.members')->with(compact('picnic', 'members'));
    }

    public function addMember($id)
    {
        $picnic = Picnic::find($id);
        return view('front.add-member')->with(compact('picnic'));
    }

    public function createMember()
    {

    }

    public function addItem($id)
    {
        $picnic = Picnic::find($id);
        return view('front.add-item')->with(compact('picnic'));
    }

    public function createItem()
    {

    }
}
