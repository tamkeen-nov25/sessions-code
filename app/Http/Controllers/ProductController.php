<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function update(Product $product, UpdateProductRequest $request)
    {
        Gate::authorize('update', $product);
        return 4;
        // Gate::authorize('update', $product);
    }
}
