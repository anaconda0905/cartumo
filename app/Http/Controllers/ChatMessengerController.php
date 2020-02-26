<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ChatMessenger;
use View;

class ChatMessengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**/
        // /print_r($_POST); die;

        $chatMessenger = new ChatMessenger;
        $chatMessenger->message_from = $request->input('from');
        //$chatMessenger->message_to = $request->input('to');
        $chatMessenger->message_to = 0;
        $chatMessenger->message_text = $request->input('message');
        //$chatMessenger->is_ip = !boolval($request->input('is_user'));
        $chatMessenger->is_ip = !boolval($request->input('is_user'));
        $chatMessenger->unread_show = false;
        $chatMessenger->type = 0;
        $chatMessenger->status = true;
        $chatMessenger->conversation = $request->input('from') . ',' . 0;

        if ( $chatMessenger->save() ) {
            die(
                json_encode(
                    array(
                        'status'    => 'success',                        
                    )
                )
            );
        } else {
            die(
                json_encode(
                    array(
                        'status'    => 'error',                        
                    )
                )
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $chatMessenger = ChatMessenger::where('conversation', $id . ',' . 0)
                                      ->get();  
                                      
        //mark as read all
        foreach ( $chatMessenger as $message ) {
            $message->status = true;
            $message->unread_show = true;
            $message->save();
        }
        
        echo json_encode(
            array(
                'status'    => 'success',
                'html'      => View::make('messenger.list', array('messenger' => $chatMessenger))->render()
            )
        );
    }


    public function getUnreadMessage(Request $request, $id) {

        $chatMessenger = ChatMessenger::where('type', 1)
                                      ->where('conversation', $id . ',' . 0)
                                      ->where('unread_show', 0)
                                      ->get();        

        //mark as read all
        foreach ( $chatMessenger as $message ) {
            $message->unread_show = true;
            $message->save();
        }
        
        echo json_encode(
            array(
                'status'    => 'success',
                'html'      => View::make('messenger.list', array('messenger' => $chatMessenger))->render()
            )
        );
    }


    public function updateMessageStatus(Request $request, $id) {

        $chatMessenger = ChatMessenger::where('type', 1)
                                      ->where('conversation', $id . ',' . 0)
                                      ->where('status', 0)
                                      ->get();

        //mark as read all
        foreach ( $chatMessenger as $message ) {
            $message->status = true;
            $message->save();
        }
        
        echo json_encode(
            array(
                'status'    => 'success',
            )
        );
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
