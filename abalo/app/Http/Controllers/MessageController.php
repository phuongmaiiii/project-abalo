<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Response;

class MessageController extends Controller
{
    public function viewStatic(){
        return view('ajax.3-ajax1-static');
    }
    public function viewPeriodic(){
        return view('ajax.3-ajax2-periodic');
    }
    public function getMessage()
    {
        $path = public_path('static/message.json');
        if (!File::exists($path)) {
            return response()->json(['message' => 'Datei nicht gefunden'], 404);
        }

        $content = File::get($path);
        return response($content, 200)->header('Content-Type', 'application/json');
    }


}
