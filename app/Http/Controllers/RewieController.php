<?php

namespace App\Http\Controllers;

use App\Models\Rewie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RewieController extends Controller
{

    //Добавление отзыва о продукте (table rewiews)
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:1000',
        ]);
        //productid название поля в форме файл resources\views\catalog\productdetails.blade.php
        $product = Product::where('id',$request->productid)->first();
        if(trim($request->body)!="") {
            Rewie::create([
                'body' => $request->body,
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
        }
        return redirect('/show/'.$product->id);//возврат на просмотр инф-ции по продукту
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rewie  $rewie
     * @return \Illuminate\Http\Response
     */
    public function show(Rewie $rewie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rewie  $rewie
     * @return \Illuminate\Http\Response
     */
    public function edit(Rewie $rewie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rewie  $rewie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rewie $rewie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rewie  $rewie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rewie $rewie)
    {
        //
    }
}
