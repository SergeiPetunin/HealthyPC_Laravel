<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //---------------------- adminpanel ----- список ордеров на товары
    public function adminOrder()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('orders.admin-orders', compact('orders'));
    }

    //---------------------- adminpanel ----- строки ордера на товары
    public function admindetails(Order $order)
    {
        $orderparts = OrderPart::where('order_id', $order->id)->get();
        return view('orders.order-details', compact('orderparts', 'order'));
    }

    //---------------------- mainSite->account ----- список ордеров на товары (в кабинете пользователя)
    public function index()
    {
        $orders = Order::orderBy('id','desc')->where('user_id', Auth::user()->id)->get();// по убыванию id
        return view('orders.index', compact('orders'));
    }

    //---------------------- mainSite->account ----- строки ордера на товары (в кабинете пользователя)
    public function details(Order $order)
    {
        // $orderparts = OrderPart::get();
        $orderparts = OrderPart::where('order_id', $order->id)->get();
        return view('orders.detail', compact('orderparts', 'order'));
    }

    //---------------------- mainSite ---- Формирование ордера из корзины
    public function store(Request $request)
    {
        $request->validate([
            'clientName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $data = $request->all();
        //Если незарегистрированный пользователь, то автоматически присваиваем id=5
        // (специально завели в базе для роли guest)
        if (Auth::guest()) {
            $data['user_id'] = 5;
        }else{
            $data['user_id'] = Auth::user()->id;
        }

        Order::create($data); // создали "шапочку" ордера в Order

        $lastorder = DB::getPdo()->lastInsertId(); // номер ордера (последний в Order)
        $cartItems = \Cart::getContent(); // достали данные из корзины
        // в цикле формируем строки ордера в OrderPart
        foreach($cartItems as $item) {
            OrderPart::create(['order_id' => $lastorder,'product_id' => $item->id,'amount' =>$item->quantity]);
        }

        \Cart::clear(); // очистили корзину

        return redirect('/catalog')->with('success', 'Your order has been successfully placed!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
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

}
