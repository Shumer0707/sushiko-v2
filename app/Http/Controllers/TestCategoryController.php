<?php

namespace App\Http\Controllers;

use App\Models\Category;

class TestCategoryController extends Controller
{
    public function index()
    {
        // Получаем все категории с переводами
        $categories = Category::with([ 'translation'])->get();

        // Для проверки выведем в JSON
        return response()->json($categories);
    }
}
