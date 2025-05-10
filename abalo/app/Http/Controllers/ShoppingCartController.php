<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;

class ShoppingCartController extends Controller
{
    public function addArticle(Request $request) {
        $ab_article_id = $request['ab_article_id'];
        try{
            if(!$ab_article_id){
                return response()->json(['error'=>'Article ID not provided'], 400);
            }
            $cart = ShoppingCart::firstOrCreate(
                ['ab_creator_id' => '1'],
                ['ab_createdate' => now()]
            );

            ShoppingCartItem::updateOrCreate(
                ['ab_shoppingcart_id' => $cart->id,
                 'ab_article_id' => $ab_article_id],
                 ['ab_createdate' => now()]

            );
            return response()->json(['success'=>true]);
        } catch (\Exception $e) {
            return response()->json(['error'=>$e->getMessage()], 500);;
        }
    }

    public function removeArticle($shoppingcartid, $articleid){
        $item = ShoppingCartItem::where('ab_shoppingcart_id', $shoppingcartid)->where('ab_article_id', $articleid)->first();

        if($item){
           $item->delete();
        }
        return response()->json(['success'=>true]);
    }

    public function getCart(){
        $userID = '1';
        $cart = ShoppingCart::where('ab_creator_id', $userID)->first();

        if(!$cart){
            return response()->json(['items'=>[]]);
        }
        $items = ShoppingCartItem::with('article')->where('ab_shoppingcart_id', $cart->id)->get();

        return response()->json(['items'=>$items, 'shoppingcartid'=>$cart->id]);
    }
}
