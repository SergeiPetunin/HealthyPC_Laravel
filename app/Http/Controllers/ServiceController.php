<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\OrderService;
use App\Models\OrderServicePart;
use App\Models\ServiceRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    //---------------------- mainSite ---- Меню Services. Список услуг
    public function index()
    {
        $services = Service::orderBy('id','asc')->get();
        return view('services.index', compact('services'));
    }

    //---------------------- adminpanel ----- список услуг
    public function adminIndex()
    {
        $services = Service::orderBy('id','asc')->get();
        return view('services.index-admin', compact('services'));
    }

    //---------------------- adminpanel. Форма для ввода новой услуги
    public function create()
    {
        return view('services.create');
    }

    //---------------------- adminpanel. запись новой услуги в БД
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'warranty' => 'required'
        ]);
        
        Service::create($request->all());
        return redirect('/servicelist');
    }

    //---------------------- adminpanel. редактирование услуги
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    //---------------------- adminpanel. запись отредактированных данных в БД
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'warranty' => 'required'
        ]);

        $service->update($request->all());
        return redirect('/servicelist');
    }

    //---------------------- adminpanel. удаление услуги из БД
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect('/servicelist');
    }

    //---------------------- adminpanel ----- список ордеров на услуги
    public function serviceorderlist()
    {
        $serviceorders = OrderService::orderBy('id','desc')->get();
        return view('serviceorders.serviceorderlist', compact('serviceorders'));
    }

    //---------------------- adminpanel ----- строки ордера на услуги
    public function aserviceorderdetails(OrderService $orderservice)
    {
        $orderserviceparts = OrderServicePart::orderBy('id','desc')->where('order_id',$orderservice->id)->get();
        return view('serviceorders.serviceorderdetail',compact('orderserviceparts', 'orderservice'));
    }

    //---------------------- adminpanel ----- формирование ордера на услуги по заявке
    public function createServiceOrder(ServiceRequest $serviceRequest)
    {
        $services = Service::orderBy('id','asc')->get();
        $servicerequestslist = ServiceRequest::where('id',$serviceRequest->id)->get();
        return view('serviceorders.addneworder',compact('servicerequestslist','services'));
    }

    //---------------------- adminpanel ----- запись ордера на услуги в БД
    public function storeServiceOrder(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'service' => 'required'
        ]);

        $data = $request->all();
        $dataService = $request->service;
        $dataServiceID = $request->serviceID;

        if(isset($dataService)){
            $sumTotal = 0;
            foreach ($dataService as $key => $item) {
                $price = DB::table('services')->where('id',$dataServiceID[$key])->value('price');
                $sumTotal = $sumTotal + $price;
            }
            $data['totalPrice'] = $sumTotal;
            OrderService::create($data);

            $lastorder = DB::getPdo()->lastInsertId();
            foreach ($dataService as $key => $item){
                OrderServicePart::create(['order_id' => $lastorder, 'service_id' => $dataServiceID[$key] ]);
            }

            $serviceRequest->update(['status' => 1]); // в таблице service_request (заявки на услуги) ставим статус "выполнен"
        }
        return redirect('/servicerequests'); // переход на список заявок
    }

    

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }


}
