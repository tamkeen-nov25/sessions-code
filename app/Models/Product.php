<?php

namespace App\Models;

use App\Policies\ProductPolicy;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
#[UseFactory(ProductFactory::class)]
#[UsePolicy(ProductPolicy::class)]

class Product extends Model
{
    use HasTranslations,HasFactory;
    
    public $translatable = ['name'];
    protected $fillable = ['name','price','user_id'];




}
