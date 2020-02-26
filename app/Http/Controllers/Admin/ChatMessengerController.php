<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ChatMessenger;

use Auth;
use View;

class ChatMessengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $chatMessenger = ChatMessenger::where('type', 0)
                                      ->orderBy('created_at', 'desc')                                      
                                      ->get();

        $chat_users = array();
        foreach ( $chatMessenger as $message ) {

            $chat_users[$message->message_from] = array(
                'id'        => $message->id,
                'user_id'   => $message->message_from,
                'is_ip'     => $message->is_ip
            );
        }    
        
        //echo '<pre>'; print_r($chat_users); die;

        return view('admin.messenger.list', ['chatUsers' => $chat_users]);
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
        $chatMessenger = new ChatMessenger;
        $chatMessenger->message_from = 0;
        //$chatMessenger->message_to = $request->input('to');
        $chatMessenger->message_to = $request->input('to');
        $chatMessenger->message_text = $request->input('message');
        $chatMessenger->is_ip = false;
        $chatMessenger->unread_show = false;
        $chatMessenger->type = 1;
        $chatMessenger->status = false;
        $chatMessenger->conversation = $request->input('to') . ',' . 0;

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
    public function show($id)
    {
        //
    }


    public function updateMessageStatus(Request $request, $id) {

        $chatMessenger = ChatMessenger::where('type', 0)
                                      ->where('conversation', $request->input('user') . ',' . 0)
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


    public function getUnreadMessage(Request $request, $id) {

        //echo 'conversation', $id . ',' . 0;

        $chatMessages = ChatMessenger::where('type', 0)
                                      ->where('conversation', $request->input('user') . ',' . 0)
                                      ->where('unread_show', 0)
                                      ->get();

        //echo $chatMessages; die;

        //mar as read all
        foreach ( $chatMessages as $message ) {
            $message->unread_show = true;
            $message->save();
        }

        echo json_encode(
            array(
                'status'    => 'success',
                'html'      => View::make('admin.messenger.messages', array('messages' => $chatMessages))->render()
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


    public function getUserMessages(Request $request, $user_id, $message_id) {

        $chatMessenger = ChatMessenger::find($message_id);

        //echo 'conversation' . $user_id . ',' . 0;

        //get auth user's messages
        if ( !$chatMessenger->is_ip ) {

            $chatMessages = ChatMessenger::where('conversation', $user_id . ',' . 0)
                                         ->get();

            //echo $chatMessages; die;

           //mark as read all
            foreach ( $chatMessages as $message ) {
                $message->status = true;
                $message->unread_show = true;
                $message->save();
            }

            echo json_encode(
                array(
                    'status'    => 'success',
                    'html'      => View::make('admin.messenger.messages', array('messages' => $chatMessages))->render()
                )
            );
        } else {
            $chatMessages = ChatMessenger::where('conversation', $user_id . ',' . 0)
                                         ->get();

            //echo $chatMessages; die;

           //mark as read all
            foreach ( $chatMessages as $message ) {
                $message->status = true;
                $message->unread_show = true;
                $message->save();
            }

            echo json_encode(
                array(
                    'status'    => 'success',
                    'html'      => View::make('admin.messenger.messages', array('messages' => $chatMessages))->render()
                )
            );
        }
    }
}
