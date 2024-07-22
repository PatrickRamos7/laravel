<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function search($query)
    {
        $books = Book::where('name', 'like', "%$query%")
                     ->orWhere('isbn', 'like', "%$query%")
                     ->get();
        return response()->json($books);
    }

    public function addToCart(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        $cart = Session::get('cart', []);

        $index = array_search($book->book_id, array_column($cart, 'book_id'));

        if ($index !== false) {
            $cart[$index]['quantity'] += $request->quantity;
        } else {
            $cart[] = [
                'book_id' => $book->book_id,
                'name' => $book->name,
                'isbn' => $book->isbn,
                'current_price' => $book->current_price,
                'quantity' => $request->quantity,
                'stock' => $book->stock
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['message' => 'Book added to cart', 'cart' => $cart]);
    }

    public function getCart()
    {
        $cart = Session::get('cart', []);
        return response()->json($cart);
    }

    public function removeFromCart($index)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Re-index the array
            Session::put('cart', $cart);
        }
        return response()->json($cart);
    }

    public function updateCartItemQuantity(Request $request)
    {
        $cart = Session::get('cart', []);
        $bookId = $request->book_id;
        $quantity = $request->quantity;

        $index = array_search($bookId, array_column($cart, 'book_id'));

        if ($index !== false) {
            $cart[$index]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return response()->json($cart);
    }
}