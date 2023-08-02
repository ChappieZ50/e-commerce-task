<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::query()->where('id',$id)->first();
        if(empty($product)){
            return response()->json(['message' => 'Ürün Bulunamadı'],404);
        }
        return new ProductResource($product);
    }

    public function index(): AnonymousResourceCollection
    {
        $products = Product::query()->orderByDesc('id')->get();

        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $product = Product::query()->create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'price'       => $request->get('price'),
            'image'       => $imageName
        ]);

        return new ProductResource($product);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::query()->where('id',$id)->delete();
        return response()->json(['message' => 'Ürün Başarıyla Silindi','status' => 200]);
    }
}
