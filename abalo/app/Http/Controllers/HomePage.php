<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\View\View;


class HomePage extends Controller
{
    private function getCategories()
    {
        return ArticleCategory::select(['id', 'ab_name'])->get();
    }
    public function index(): View
    {
        return view('homepage', ['categories' => $this->getCategories()]);
    }

    public function newArticles(): View
    {
        return view('articles.newarticle', ['categories' => $this->getCategories()]);
    }


}
