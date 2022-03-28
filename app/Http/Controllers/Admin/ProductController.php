<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Allergen;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $allergens = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('archived', 0)->where('deleted', 0)->with('allergens')->orderBy('category', 'ASC')->get();

        return view('admin.products', compact('products') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allergens = Allergen::all();

        return view('admin.add-product', compact('allergens') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if ( $request->hasFile('image') && $request->file('image')->isValid()  ) {
            $filepath = storage_path('app/public/image');
            $timestamp = time();
            $filename = $timestamp . "-" .$request->file('image')->getClientOriginalName();
        }


        $product = Product::create([
            'title' => $request->title,
            'about' => $request->about,
            'price' => $request->price,
            'image' => $filename,
            'category' => $request->category,
        ]);

        $product->allergens()->sync( $request->get('allergens') ? : [] );

        $img = Image::make( $request->file('image') );
        $img->resize(580, 300);
        $img->save ( storage_path().'/app/public/image/'.$filename, 100 );

        return redirect()->route('products.index')->withStatus('Produkt bol úspešne pridaný.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $allergens = $this->allergens;

        return view('admin.delete-product', compact('product', 'allergens') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $allergens = Allergen::all();

        return view('admin.edit-product', compact('allergens', 'product',) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ( $request->hasFile('image') && $request->file('image')->isValid()  ) {
            $filepath = storage_path('app/public/image');
            $timestamp = time();
            $filename = $timestamp . "-" .$request->file('image')->getClientOriginalName();

            if ( Storage::exists('public/image/' . $product->image ) ) {
                Storage::delete('public/image/' . $product->image);
            }

            $img = Image::make( $request->file('image') );
            $img->resize(580, 300);
            $img->save ( storage_path().'/app/public/image/'.$filename, 100 );
        }

        if ( !$request->hasFile('image') ) {
            $filename = $product->image;
        }

        $product->update([
            'title' => $request->title,
            'about' => $request->about,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $filename,
        ]);

        $product->allergens()->sync( $request->get('allergens') ? : [] );

        return redirect()->route('products.index')->withStatus('Produkt bol úspešne aktualizovaný.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ( Storage::exists('public/image/' . $product->image ) ) {
            Storage::delete('public/image/' . $product->image);
        }

        // $product->delete();
        $product->update([
            'deleted' => 1,
            'image' => null,
        ]);

        return redirect()->route('products.index')->withStatus('Produkt bol úspešne zmazaný.');
    }

    public function archive(Request $request, Product $product)
    {
        if ( $request->status == 0 || $request->status == 1 ) {

            $product->update([
                'archived' => $request->status
            ]);

            if ( $request->status == 0 ) {
                return redirect()->route('products.archived')->withStatus('Produkt bol úspešne odstránený z archívu.');
            } else {
                return redirect()->route('products.index')->withStatus('Produkt bol úspešne archivovaný.');
            }

        } else {
            return redirect()->route('products.index')->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

    }

    public function archived_products()
    {
        $products = Product::where('archived', 1)->where('deleted', 0)->with('allergens')->orderBy('category', 'ASC')->get();

        return view('admin.archived-products', compact('products') );
    }
}


