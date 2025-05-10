<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'ab_shoppingcart';
    protected $fillable = ['ab_creator_id', 'ab_createdate'];
    public $timestamps = false;

    //one to many
    public function items(){
        return $this->hasMany(ShoppingCartItem::class, 'ab_shoppingcart_id');
    }
}
