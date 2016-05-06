<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PublishInquiryRequest;
use App\Inquiry;
use Auth;

class InquiryController extends Controller {
    
    public function __construct() {
        // for authentication (optional)
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$allInquiries = Inquiry::all();
        $allInquiries = Inquiry::where('owner', Auth::id())->get();
        return View('inquiries.listing', compact('allInquiries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublishInquiryRequest $requestData)
    {
        $inquiry = new Inquiry;
        $inquiry->name= $requestData['name'];
        $inquiry->email= $requestData['email'];
        $inquiry->phone= $requestData['phone'];
        if(isset($requestData['ref_add']) && $requestData['ref_add'] != 0) {
            $inquiry->ref= 1;
        } else {
            $inquiry->ref= 0;
        }
        $inquiry->owner= Auth::id();
        $inquiry->save();

        //Send control to index() method where it'll redirect to bookList.blade.php
        return redirect()->route('inquiries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
