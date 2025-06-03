<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;


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
        try {
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
            $article->ab_price = round($validated['price'] * 100); //Euro zu Cent
            $article->ab_description = $validated['description'] ?? null;
            $article->ab_createdate = $validated['created_at'] ?? now();
            $article->ab_creator_id = Auth::id() ?? 1;

            $article->save(); //ID automatisch erstellt

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $destinationPath = public_path('articelimages');
                $image->move($destinationPath, $article->id . '.jpg');
            }
            /*
            //Redirect + Information
            return redirect()->route('articles')->with('success', 'Artikel erfolgreich gespeichert.');
            */
            return response("Erfolgreich", 200);
            } catch (ValidationException $e){
            return response("Fehler: " .implode(", ", $e->validator->errors()->all()), 400);
        } catch (\Exception $e) {
            return response("Fehler: " . $e->getMessage(), 500);
        }
    }

    //M3-Aufgabe7
    public function search(Request $request){
        $search = $request->query('search');

        $query = Article::query();
        // if length > 3 -> take 5 articles
        if(strlen($search) > 3){
            $query->where('ab_name', 'ILIKE', "%$search%");
            $articles = $query->limit(5)->get();
        }

        //if empty or < 3 characters -> return all articles
        $articles = $query->get();

        //has_image
        $articles = $articles->map(function ($item) {
            $item->has_image = file_exists(public_path('articelimages/' . $item->id . '.jpg'));
            return $item;
        });

        return response()->json([
            'success' => true,
            'count' => $articles->count(),
            'data' => $articles,
        ]);
    }

    //M3-Aufgabe8
    public function store2(Request $request){
        //Validierung
        $validated = $request->validate( [
            'name' => 'required|string|max:80',
            'price' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:100',
        ]);

        //Speicherung
        $article = new Article();
        $article->ab_name= $validated['name'];
        $article->ab_price= round($validated['price'] * 100);
        $article->ab_description= $validated['description'] ?? null;
        $article->ab_creator_id = Auth::id() ?? 1;
        $article->ab_createdate = now();
        $article->save();

        return response()->json([
            'success' => true,
            'data' => $article->id,
        ], 201); //Created
    }

}
