<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    public function index(Request $request){
        // Suchbegriff aus URL holen
        $search = $request->query('search');

        // Artikel aus DB holen, falls Suche aktiv ist → WHERE LIKE (case insensitive)
        $query = Article::query();
        if ($search) {
            $query->where('ab_name', 'ILIKE', "%$search%");
        }
        $articles = $query->get();

        //Navbar-Categories
        $categories= ArticleCategory::select(['id', 'ab_name'])->get();

        return view('articles.index', compact('articles', 'categories'));
    }
    public function store(Request $request){
        //Validate Data
        $validated = $request->validate([
            'name' => 'required|string|max:80',
            'price' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:100',
            'created_at' => 'nullable|date_format:Y-m-d\TH:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //Article in DB speichern
        $article = new Article();
        $article->ab_name = $validated['name'];
        $article->ab_price = round($validated['price'] * 100);
        $article->ab_description = $validated['description'] ?? null;
        $article->ab_createdate = $validated['created_at'] ?? now();
        $article->ab_creator_id = Auth::id()??1;

        $article->save(); //ID automatisch erstellt

        if($request->hasFile('image')){
            $image = $request->file('image');
            $destinationPath = public_path('articelimages');
            $image->move($destinationPath, $article->id.'.jpg');
        }
        //Redirect + Information
        return redirect()->route('articles')->with('success', 'Artikel erfolgreich gespeichert.');
    }

}
