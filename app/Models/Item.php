<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use softDeletes, hasFactory;

    protected $fillable = ['name', 'price', 'description', 'stock_quantity'];

}
