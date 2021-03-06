<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cookie;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = Product::all();
        return view('pages.backend.product', ['product' => $product]);
    }

    public function create()
    {
        return view('pages.backend.productCreate');
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,svg|max:2000',
            'desc' => 'required',
            'list' => 'required',
        ]);

        $id = Product::max('id') + 1;

        if ($req->hasFile('image')) {
            $imagePath = $req->file('image');
            $fileName =  $id . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('storage/product'), $fileName);
        } else {
            $fileName =  'default.jpg';
        }

        $newprice = str_replace(',', '', $req->price);

        Product::create([
            'name' => $req->name,
            'slug' => Str::slug($req->name),
            'price' => $newprice,
            'image' => $fileName,
            'desc' => $req->desc,
            'list' => $req->list
        ]);

        return redirect('/product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('pages.backend.productEdit', ['product' => $product]);
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->save();
        return redirect('/product');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/product');
    }

    public function addProduct($id)
    {
        // Quick Usage with the Product Model Association & User session binding
        $product = Product::find($id); // assuming you have a Product model with id, name, description & price
        // dd($product->price);
        // $rowId = 456; // generate a unique() row ID
        $userID = Auth::user()->id; // the user ID to bind the cart contents

        // $id = '2';
        // $name = 'asd';
        // $price = '2000';
        $qty = '1';
        // dd($id, $name, $price);

        // add the product to cart
        // \Cart::session($userID)->add(array(
        //     'id' => $id,
        //     'name' => $name,
        //     'price' => $price,
        //     'quantity' => 4,
        // ));
        \Cart::session($userID)->add(array(
            'id' => $id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $qty,
            'associatedModel' => $product
        ));
        return redirect('/shop');
    }
    public function cart()
    {
        // View Cart
        $items = \Cart::session(Auth::user()->id)->getContent();
        $product = $items->count();
        $subtotal = \Cart::getSubTotal();
        $tax = $subtotal * 10 / 100;
        $total = \Cart::getTotal() - $tax;
        return view('pages.cart', [
            'items' => $items, 'product' => $product, 'subtotal' => $subtotal,
            'total' => $total, 'tax' => $tax
        ]);
    }
    public function removeProduct($id)
    {
        \Cart::session(Auth::user()->id)->remove($id);
        return redirect('/cart');
    }
    public function clearCart()
    {
        \Cart::clear();
        \Cart::session(Auth::user()->id)->clear();
        return redirect('/cart');
    }
}
