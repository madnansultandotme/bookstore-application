<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;
        $cartItems = $cart ? $cart->items()->with('book')->get() : collect();
        $total = $cart ? $cart->getTotalPrice() : 0;

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Book $book)
    {
        $cart = auth()->user()->cart;

        if (!$cart) {
            $cart = auth()->user()->cart()->create();
        }

        $cartItem = $cart->items()->where('book_id', $book->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
