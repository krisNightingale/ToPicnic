<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $responsible_id
 * @property int $picnic_id
 * @property int $users_amount
 * 
 * @property \App\Models\User $user
 * @property \App\Models\Picnic $picnic
 * @property \Illuminate\Database\Eloquent\Collection $bills
 *
 * @package App\Models
 */
class Item extends Model
{
	public $timestamps = false;

	protected $casts = [
		'price' => 'float',
		'responsible_id' => 'int',
		'picnic_id' => 'int',
		'users_amount' => 'int'
	];

	protected $fillable = [
		'name',
		'price',
		'responsible_id',
		'picnic_id',
		'users_amount'
	];

	public function responsible()
	{
		return $this->belongsTo(User::class, 'responsible_id');
	}

	public function picnic()
	{
		return $this->belongsTo(Picnic::class);
	}

	public function bills()
	{
		return $this->hasMany(Bill::class);
	}

	public function getResponsibleNickname()
    {
        return $this->responsible()->get()->first()->nickname;
    }

    public function getResponsible()
    {
        return $this->responsible()->get()->first();
    }
}
