<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * 
 * @property int $id
 * @property int $payer_id
 * @property float $amount
 * @property bool $is_paid
 * @property int $picnic_id
 * @property int $item_id
 * 
 * @property \App\Models\Picnic $picnic
 * @property \App\Models\Item $item
 *
 * @package App\Models
 */
class Bill extends Model
{
	public $timestamps = false;

	protected $casts = [
		'payer_id' => 'int',
		'amount' => 'float',
		'is_paid' => 'bool',
		'picnic_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'payer_id',
		'amount',
		'is_paid',
		'picnic_id',
		'item_id'
	];

	public function picnic()
	{
		return $this->belongsTo(Picnic::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function payer()
    {
        return $this->belongsTo(User::class);
    }

    public function getItemName()
    {
        return $this->item()->get()->first()->name;
    }

    public function getItemPrice()
    {
        return $this->item()->get()->first()->price;
    }

    public function getPayerNickname()
    {
        return $this->payer()->get()->first()->nickname;
    }

    public function getPayer()
    {
        return $this->payer()->get()->first();
    }

    public function getResponsible()
    {
        return $this->item()->get()->first()->getResponsible();
    }
}
