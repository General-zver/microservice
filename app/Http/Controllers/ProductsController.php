<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct() {

    }

    public function updateProduct() {

    }

    public function deleteProduct() {

    }

    public function getProducts(Request $request) {

        $products_query = Product::query();
        if ($request->has('sort')) {
            $products_query->orderBy($request->get('sort'), $request->get('direction', 'asc'));
        }

        $products = $products_query->get();


        return $products;
    }

    public function getProductsByCategory(Product $product) {

        return $product;
    }
}
