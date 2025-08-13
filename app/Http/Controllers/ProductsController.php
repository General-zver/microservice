<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function createProduct(ProductRequest $request) {
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

    public function updateProduct($product, UpdateProductRequest $request) {

        try {
            $product_entity = Product::find($product);
            if (!$product_entity instanceof Product) {
                return response([
                    'result' => 'error',
                    'reason' => 'Product not found.',
                ],404);
            }
            DB::beginTransaction();
            $product_entity->update($request->all());
            return response([
                'result' => 'success',
                'message'=> "Product {$product_entity->product_name} successfully updated!"
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response([
                'result' => 'error',
                'reason' => $th->getMessage(),
            ], 400);
        }
    }

    public function deleteProduct($product) {
        $product_entity = Product::find($product);
        if ($product_entity instanceof Product) {
            $product_entity->delete();
            return response()->json([
                'result' => 'success',
                'message' => 'Product successfully deleted!',
            ]);
        } else {
            return response()->json([
                'result' => 'error',
                'mesage' => 'Product not found.',
            ],404);
        }

    }

    public function getProducts(Request $request) {

        $products_query = Product::query();
        if ($request->has('sort')) {
            $products_query->orderBy($request->get('sort'), $request->get('direction', 'asc'));
        }

        if ($request->has('filter') && in_array($request->get('filter')['filter_field'], ['category', 'availability'])) {
            $products_query->where($request->get('filter')['filter_field'], $request->get('filter')['filter_field_value']);
        }

        $products = $products_query->get();


        return response()->json([
            'products' => $products
        ],200);
    }

    public function getProductsByCategory(Product $product) {

        return $product;
    }
}
