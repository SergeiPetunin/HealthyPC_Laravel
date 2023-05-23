<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\OrderService;
use App\Models\OrderServicePart;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    //mainSite->account ----- список ордеров на услуги (в кабинете пользователя)
    public function index()
    {
        $serviceorders = OrderService::orderBy('id','desc')->where('user_id', Auth::user()->id)->get();// по убыванию id
        return view('serviceorders.index', compact('serviceorders'));
    }

    //mainSite->account ----- строки ордера на услуги (в кабинете пользователя)
    public function details($id)
    {
        $orderserviceparts = OrderServicePart::where('order_id', $id)->get();
        return view('serviceorders.detail', compact('orderserviceparts','id'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function show(OrderService $orderService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderService $orderService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderService $orderService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderService  $orderService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderService $orderService)
    {
        //
    }
}
