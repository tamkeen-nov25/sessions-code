<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
#[UseFactory(ProductFactory::class)]
class Product extends Model
{
    use HasTranslations,HasFactory;
    
    public $translatable = ['name'];
    protected $fillable = ['name','price'];




}
