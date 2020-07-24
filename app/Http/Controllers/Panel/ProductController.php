<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\PanelProduct;
use App\Scopes\AvailableScope;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth')->except(['index', 'show']);
    //     $this->middleware('auth');
    // }

    public function index() 
    {
        $products = PanelProduct::without('images')->get();

        return view('products.index')->with([
            'products' => $products
        ]);  
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        // $rules = [
        //     'title' => ['required', 'max:255'], 
        //     'description' => ['required', 'max:1000'], 
        //     'price' => ['required', 'min:1'], 
        //     'stock' => ['required', 'min:0'], 
        //     'status' => ['required', 'in:available,unavailable']
        // ];
        // request()->validate($rules);

        // if (request()->stock == 0 && request()->status == 'available') {
        //     // session()->put('error', 'If available must have stock');
        //     // session()->flash('error', 'If available must have stock');

        //     return redirect()
        //         ->back()
        //         ->withInput(request()->all())
        //         ->withErrors("If available must have stock");
        // }
        // session()->forget('error');

        $product = PanelProduct::create($request->validated());

        // session()->flash('success', "New product with id {$product->id} was created");

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was created");
            // ->with(['success' => "New product with id {$product->id} was created"]);

    }

    public function show(PanelProduct $product) 
    {
        // $product = Product::where('id', '=', $product)->get();
        // $product = Product::where('id', $product)->first();
        // $product = Product::find($product);
        // $product = Product::findOrFail($product);

        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit($product)
    {
        $product = PanelProduct::findOrFail($product);
        
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was updated");
    }

    public function destroy($product)
    {
        $product = PanelProduct::findOrFail($product);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was removed");
    }
}
