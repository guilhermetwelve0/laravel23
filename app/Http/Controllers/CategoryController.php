<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Auth;

class CategoryController extends Controller
{
    // ID do usuário bloqueado
    private $blockedUserId = 5;

    public function index(Request $request)
    {
        return view('category.list');
    }

    public function getCategories(Request $request)
    {
        // Se for o usuário bloqueado (ID 5), retorna apenas 1 registro
        if (Auth::id() == $this->blockedUserId) {
            $categories = CategoryModel::limit(1)->get(); // Apenas 1 categoria
        } else {
            $categories = CategoryModel::all(); // Todos os registros
        }

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para criar categorias.'
            ], 403);
        }

        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = new CategoryModel();
        $category->tenant_id = Auth::id(); 
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Categoria adicionada com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $category = CategoryModel::find($id);
        return response()->json($category);
    }

    public function update($id, Request $request)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json(['error' => 'Você não tem permissão para editar categorias.'], 403);
        }

        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = CategoryModel::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['message' => 'Categoria atualizada com sucesso!']);
    }

    public function destroy($id)
    {
        if (Auth::id() == $this->blockedUserId) {
            return response()->json(['error' => 'Você não tem permissão para excluir categorias.'], 403);
        }

        $category = CategoryModel::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso.']);
    }
}