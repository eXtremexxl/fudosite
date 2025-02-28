<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishRating extends Model
{
    protected $fillable = ['user_id', 'dish_id', 'rating'];
}