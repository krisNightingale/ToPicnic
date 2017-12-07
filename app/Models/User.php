<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $password
 * 
 * @property \App\Models\Friend $friend
 * @property \Illuminate\Database\Eloquent\Collection $items
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

	public $timestamps = false;

	protected $fillable = [
		'name',
		'nickname',
		'email',
		'password'
	];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Which users are my friends (in my friend-list)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function myFriends()
	{
		return $this->belongsToMany(User::class, 'friends', 'initiator_id','consented_id');
	}

    /**
     * Whose friend am I (in which user's friend-lists am I)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function amFriend()
    {
        return $this->belongsToMany(User::class, 'friends', 'consented_id', 'initiator_id');
    }

    public function getConfirmedFriends()
    {
        $confirmedFriends = [];
        $friends = $this->myFriends()->get()->all();
        foreach ($friends as $friend){
            if ($this->isConfirmedFriend($friend->id)){
                $confirmedFriends[] = $friend;
            }
        }
        return $confirmedFriends;
    }

    public function isConfirmedFriend($friend_id)
    {
        $myFriend = $this->myFriends()->where('consented_id', '=', $friend_id)->get()->first();
        $amFriend = DB::table('friends')->where('initiator_id', '=', $friend_id)
            ->where('consented_id', '=', $this->id)
            ->get()->first();
        if ($myFriend && $amFriend) {
            return true;
        }
        return false;
    }

    public function isFriend($user_id)
    {
        $isFriend = DB::table('friends')->where('initiator_id', '=', request()->user()->id)
            ->where('consented_id', '=', $user_id)
            ->get()->first();
        if ($isFriend){
            return true;
        }
        return false;
    }

	public function items()
	{
		return $this->hasMany(Item::class, 'responsible_id');
	}

	public function subscribedOnItem($id)
    {
        $itemId = $this->bills()->where('item_id', '=', $id)->first();
        if ($itemId){
            return true;
        }
        return false;
    }

	public function bills()
    {
        return $this->hasMany(Bill::class, 'payer_id');
    }

    public function picnics()
    {
        return $this->belongsToMany(Picnic::class, 'user_picnic');
    }

    public function getMyFriendsIds()
    {
        $items = $this->myFriends()->get()->all();
        $ids = [];
        foreach ($items as $item){
            $ids[$item->id] = ['value' => $item->id];
        }
        return $ids;
    }

    public function getMyFriendsNames()
    {
        $items = $this->myFriends()->get()->all();
        $names = [];
        foreach ($items as $item){
            $names[$item->id] = $item->name;
        }
        return $names;
    }
}
