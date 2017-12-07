<?php

namespace App\Http\Controllers;


use App\Models\Bill;
use App\Models\Item;

class BillController extends Controller
{
    public function subscribeOnItem($id)
    {
        $item = Item::find($id);
        $item->users_amount = $item->users_amount + 1;
        $item->update();
        $pricePerUser = $item->price / $item->users_amount;

        Bill::where('item_id', '=', $id)->update(['amount' => $pricePerUser]);
        
        Bill::create([
            'payer_id' => request()->user()->id,
            'amount' => $pricePerUser,
            'is_paid' => false,
            'picnic_id' => $item->picnic_id,
            'item_id' => $item->id,
        ]);

        return redirect('picnic/'.$item->picnic_id);
    }


    public function unsubscribeFromItem($id)
    {
        $item = Item::find($id);
        $user = request()->user();
        $bill = Bill::where('item_id', '=', $id)->where('payer_id', '=', $user->id)->get()->first();
        if (!$bill->is_paid) {
            $item->users_amount = $item->users_amount - 1;
            $item->update();
            $pricePerUser = $item->price / $item->users_amount;

            Bill::where('item_id', '=', $id)->update(['amount' => $pricePerUser]);

            $bill->delete();
        }
        return redirect('picnic/'.$item->picnic_id);
    }

    public function setPaid($id)
    {
        $bill = Bill::findOrFail($id);
        if (!$bill->is_paid) {
            $bill->is_paid = true;
            $bill->update();
        }
        return redirect()->back();
    }
}
