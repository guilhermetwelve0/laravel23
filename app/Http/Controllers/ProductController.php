<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    // ID do usuário bloqueado
    private $blockedUserId = 5;

    public function index(Request $request)
    {
        $category = CategoryModel::all()->pluck('category_name', 'id');
        return view('product.list', compact('category'));
    }

    public function store(Request $request)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para criar produtos.'
            ], 403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'product_code' => 'required|string|max:255',
            'name_product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $validated['tenant_id'] = Auth::id();

        ProductModel::create($validated);

        return response()->json(['message' => 'Produto adicionado com sucesso!']);
    }

    public function fetchProducts()
    {
        // Se for o usuário bloqueado, retornar apenas 1 produto
        if (Auth::id() == $this->blockedUserId) {
            $products = ProductModel::with('category')->limit(1)->get();
        } else {
            $products = ProductModel::with('category')->get();
        }

        return response()->json($products);
    }

    public function edit($id)
    {
        $product = ProductModel::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json([
                'error' => 'Você não tem permissão para editar produtos.'
            ], 403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'product_code' => 'required|string|max:255' . $id,
            'name_product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $product = ProductModel::findOrFail($id);
        $product->update($validated);

        return response()->json(['message' => 'Produto atualizado com sucesso!']);
    }

    public function destroy($id)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json([
                'error' => 'Você não tem permissão para excluir produtos.'
            ], 403);
        }

        $product = ProductModel::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produto excluído com sucesso!']);
    }
}
