<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Picnic
 * 
 * @property int $id
 * @property string $name
 * @property string $place
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $bills
 * @property \Illuminate\Database\Eloquent\Collection $items
 *
 * @package App\Models
 */
class Picnic extends Model
{
	public $timestamps = false;

	protected $dates = [
		'start_time',
		'end_time'
	];

	protected $fillable = [
		'name',
		'place',
		'start_time',
		'end_time',
		'description'
	];

	public function bills()
	{
		return $this->hasMany(Bill::class);
	}

	public function items()
	{
		return $this->hasMany(Item::class);
	}

	public function members()
    {
        return $this->belongsToMany(User::class, 'user_picnic');
    }

    public function membersCount()
    {
        $members = $this->members()->get()->all();
        return count($members);
    }

    public function getMembersIds()
    {
        $items = $this->members()->get()->all();
        $ids = [];
        foreach ($items as $item){
            $ids[$item->id] = ['value' => $item->id];
        }
        return $ids;
    }

    public function getMembersNames()
    {
        $items = $this->members()->get()->all();
        $names = [];
        foreach ($items as $item){
            $names[$item->id] = $item->name;
        }
        return $names;
    }
}
