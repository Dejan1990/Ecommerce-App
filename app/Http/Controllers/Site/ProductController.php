<?php

namespace App\Http\Controllers\Site;

//use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Contracts\AttributeContract;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;
    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        //dd($product, $attributes);
        return view('site.pages.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        //dd($request->all()); ovo koristiti cesto za razne provere

        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);
        //See how I am passing a unique shopping cart row id using the uniqid() method. For every row you have to pass the unique id otherwise it will be overwritten.

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
