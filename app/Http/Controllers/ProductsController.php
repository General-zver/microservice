<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function createProduct(Request $request) {
        $data = $request->all();
        DB::beginTransaction();
        try {
            Product::create($data);
            DB::commit();
            return response([
                'result' => 'success',
                'message'=> "Product {$data['product_name']} successfully created!"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response([
                'result' => 'error',
                'reason' => $th->getMessage(),
            ],400);
        }

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
