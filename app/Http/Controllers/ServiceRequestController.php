<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    //---------------------- mainSite ---- Запись в БД из формы Contact
    public function store(Request $request)
    {
        $request->validate([
            'clientName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required|max:1000',
        ]);
        $data = $request->all();
        //Если незарегистрированный пользователь, то автоматически присваиваем id=5
        // (специально завели в базе для роли guest)
        if(Auth::guest()) {
            $data['user_id'] = 5;
        }else{
            $data['user_id'] = Auth::user()->id;
        }

        ServiceRequest::create($data);
        return redirect('/contact')->with('success', 'Message added. You will be contacted!');
    }

    //---------------------- adminpanel ----- список заявок на услуги
    public function index()
    {
        $servicerequestslist = ServiceRequest::orderBy('id','desc')->get();
        return view('services.servicereq', compact('servicerequestslist'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
        $servicerequestslist = ServiceRequest::where('id', $serviceRequest->id)->get();
        return view('services.servicereqedit', compact('servicerequestslist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
        $request->validate([
            'status' => 'required',
        ]);

        $serviceRequest->update($request->all());
        return redirect('/servicerequests');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        //
    }


}
