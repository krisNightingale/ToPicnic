<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Item;
use App\Models\Picnic;

class PicnicController extends Controller
{
    public function getMyPicnicList(){
        $user = request()->user();
        $picnics = $user->picnics()->orderBy('start_time', 'asc')->get()->all();

        return view('front.dashboard')->with(compact('picnics'));
    }

    public function addPicnic()
    {
        $user = request()->user();
        $membersIds = $user->getMyFriendsIds();
        $membersNames = $user->getMyFriendsNames();

        return view('front.add-picnic')->with(compact( 'membersIds', 'membersNames'));
    }

    public function createPicnic()
    {
        $this->validate(request(), [
            'name' => 'required',
            'start_time' => 'required',
        ]);
        $picnic = Picnic::create(request()->all());
        $picnic->members()->attach(request()->user()->id, ['confirmed' => true]);

        $members = request()->get('members');
        for ($i = 0; $i < count($members); $i++){
            if ($members[$i] != 0)
                $picnic->members()->attach($members[$i]);
        }
        return redirect('/picnic/'.$picnic->id);
    }

    public function editPicnic($id)
    {
        $picnic = Picnic::findOrFail($id);
        return view('front.edit-picnic')->with(compact('picnic'));
    }

    public function updatePicnic($id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'start_time' => 'required',
        ]);
        $picnic = Picnic::findOrFail($id);
        $picnic->update(request()->all());

        return redirect('/picnic/'.$picnic->id);
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
        $user = request()->user();
        $membersIds = $user->getMyFriendsIds();
        $membersNames = $user->getMyFriendsNames();

        return view('front.add-member')->with(compact('picnic', 'membersIds', 'membersNames'));
    }

    public function createMember($id)
    {
        $picnic = Picnic::find($id);
        $members = request()->get('members');

        for ($i = 0; $i < count($members); $i++){
            if (($members[$i] != 0) && (!$picnic->hasMember($members[$i])))
                $picnic->members()->attach($members[$i]);
        }
        return redirect('/picnic/'.$id.'/members')->with('flash_message', 'Member added!');
    }

    public function addItem($id)
    {
        $picnic = Picnic::find($id);

        return view('front.add-item')->with(compact('picnic'));
    }

    public function createItem($id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'price' => 'required'
        ]);

        $item = Item::create([
            'name' => request('name'),
            'price' => request('price'),
            'responsible_id' => request()->user()->id,
            'picnic_id' => $id,
        ]);

        Bill::create([
            'payer_id' => request()->user()->id,
            'amount' => request('price'),
            'is_paid' => true,
            'picnic_id' => $id,
            'item_id' => $item->id,
        ]);

        return redirect('picnic/'.$id)->with('flash_message', 'Item added!');
    }
}
