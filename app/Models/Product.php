<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
  protected $fillable = [
    'name',
    'description',
    'price',
    'image',
    'is_sold'
];



public function user()
{
    return $this->belongsTo(User::class, 'admin_id');
}


}
?>