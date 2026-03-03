<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('article')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'article_id' => ['required', 'integer', 'exists:articles,id'],
        ]);

        Article::query()->findOrFail($data['article_id']);

        $cart = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'article_id' => $data['article_id'],
        ]);

        if ($cart->exists) {
            $cart->increment('quantity');
        } else {
            $cart->quantity = 1;
            $cart->save();
        }

        return back()->with('success', 'Article ajouté au panier.');
    }

    public function increment(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->increment('quantity');

        return back()->with('success', 'Quantité augmentée.');
    }

    public function decrement(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        if ($cart->quantity <= 1) {
            $cart->delete();

            return back()->with('success', 'Article retiré du panier.');
        }

        $cart->decrement('quantity');

        return back()->with('success', 'Quantité diminuée.');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Article retiré du panier.');
    }
}