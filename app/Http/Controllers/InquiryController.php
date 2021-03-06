<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PublishInquiryRequest;
use App\User;
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
        
        // get user id index array
        $users = array();
        $arr = User::all();
        foreach ($arr as $user) {
            $users[$user->id] = $user;
        }
        
        $allInquiries = array();
        
        if(Auth::user()->user_type == "SUPER_ADMIN") {
            $allInquiries = Inquiry::all();
        } else {
            $allInquiries = Inquiry::where('owner', Auth::id())->get();
        }
        
        //print_r($allInquiries);
        
        return View('inquiries.listing', compact('allInquiries', 'users'));
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
        $inquiry = Inquiry::find($id);
        return view('inquiries.edit')->with('inquiry',$inquiry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublishInquiryRequest $requestData, $id)
    {
        $inquiry = Inquiry::find($id);

        //Update Query
        $inquiry->name= $requestData['name'];
        $inquiry->email= $requestData['email'];
        $inquiry->phone= $requestData['phone'];
        if(isset($requestData['ref_add']) && $requestData['ref_add'] != 0) {
            $inquiry->ref= 1;
        } else {
            $inquiry->ref= 0;
        }
        $inquiry->save();

        //Redirecting to index() method of BookController class
        return redirect()->route('inquiries.index');
    }
    
    public function update_ajax(Request $requestData)
    {
        if (Auth::check()) {
            if(isset($requestData['type']) && $requestData['type'] == "UPDATE_REF") {
                $inqid = $requestData['inqid'];
                $state = $requestData['state'];
                if($state == "true") {
                    $state = 1;
                } else {
                    $state = 0;
                }
                $inquiry = Inquiry::find($inqid);;
                $inquiry->ref = $state;
                $inquiry->save();
                return response()->json(['success' => true]);
            } else if(isset($requestData['type']) && $requestData['type'] == "UPDATE_COMMENT") {
                $inqid = $requestData['inqid'];
                $comment = $requestData['comment'];
                $inquiry = Inquiry::find($inqid);;
                $inquiry->comment = $comment;
                $inquiry->save();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Unknown Request']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'UnAuthentic Request']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inquiry::find($id)->delete();

        //Redirecting to index() method
        return redirect()->route('inquiries.index');
    }
}
