<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->adminProducts($request->get('admin_id'));

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'desc' => 'required',
            'image_url' => 'required|mimes:jpg,jpeg,svg,png',
        ]);
        
        $product = $request->all();
        $file = $request->file('image_url');
        $ext = $file->extension();
        $dateTime = date('Ymd_his');
        $newName = 'image_'.$dateTime.'.'.$ext;

        $newName = $file->storeAs("image_files", $newName);

        $product['user_id'] = Auth::user()->id;
        $product['image_url'] = $newName;
        Product::create($product);

        return redirect('admin/products')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate(request(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
            'image_url' => 'required|mimes:jpg,jpeg,svg,png',
        ]);
        
        if (request()->file('image_url')) {
            Storage::delete($product->image);
            $file = $request->file('image_url');

            $ext = $file->getClientOriginalExtension();
            $dateTime = date('Ymd_his');
            $newName = 'image_'.$dateTime.'.'.$ext;
    
            $newName = $file->storeAs("image_files", $newName);

        } else {
            $newName = $product->image;
        }

        $attr = $request->all();
        $attr['image_url'] = $newName;

        $product->update($attr);

        return redirect('admin/products')->with('success', 'Produk berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        Storage::delete($product->image_url);

        $product->delete();

        return redirect('admin/products')->with('success', 'Produk berhasil di hapus');

    }
}
