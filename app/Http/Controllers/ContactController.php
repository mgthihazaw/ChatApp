<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = User::where('id','!=',auth()->user()->id)->get();

        return response()->json(['contacts' => $contacts],200);
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
    public function getMessages($id){
        $messages= Message::where('from',$id)->where('to' ,auth()->user()->id)->orWhere('to',$id)->where('from' ,auth()->user()->id)->get();
        
        
         
        return response()->json($messages);
    }
    public function sendMessage(Request $request){
        $message= Message::create([
           'from' => auth()->user()->id,
           'to' => $request->contact_id,
           'text' => $request->text,

        ]);

        broadcast(new MessageEvent($message));

        return response()->json($message);
    }
}
