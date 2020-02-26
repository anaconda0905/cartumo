<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UserMarketplace;
use App\Funnel;
use View;

class UserMarketPlaceController extends Controller
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
        $data['userMarketplaces'] = UserMarketplace::orderBy('id', 'desc')->paginate(25);

        return view('admin.user.marketplace.list')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request = NULL)
    {   
        //$funnel_name = $request->input('keyword');

        //ajax call with action
        if ( empty($request->input('action')) ) {
            if ( empty($funnel_name) )
                $data['funnels'] = Funnel::orderBy('name', 'asc')
                                        ->paginate(50);
            else 
                $data['funnels'] = Funnel::where('funnels.name', 'like', '%' . $funnel_name . '%')
                                        ->orderBy('name', 'asc')
                                        ->paginate(50);     

            return view('admin.user.marketplace.create')->withData($data);
        } else {

            $funnels = Funnel::where('user_id', '!=', $request->input('user_id'))->orderBy('name', 'asc')->get();
            $data = array();

            $marketplaceFunnels = UserMarketplace::where('user_id', $request->input('user_id'))->get();

            foreach ( $funnels as $funnel ) {
                $userMarketplace = UserMarketplace::where('user_id', $request->input('user_id'))->get();                  
                $flag = false;

                foreach ( $userMarketplace as $marketplace ) {  
                    if ( $marketplace->funnel_id == $funnel->id ) {
                        $flag = true;
                        break;
                    }
                }

                if ( !$flag ) {
                    $data['funnels'][] = $funnel;
                }
            }   
            
            //echo '<pre>'; print_r($data); die;

            die(
                json_encode(
                    array(
                        'status'        => 'success', 
                        'html'          => View::make('admin.user.marketplace.funnel_list', array('funnels' => $data['funnels']))->render(),                 
                        'marketplace'   => View::make('admin.user.marketplace.user_funnel_list', array('funnels' => $marketplaceFunnels))->render()
                    )
                )
            );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( $request->input('action') == 'add' ) {
            
            $userMarketplace = new UserMarketplace;
            $userMarketplace->funnel_id = $request->input('funnel_id');
            $userMarketplace->user_id = $request->input('user_id');
            $userMarketplace->status = true;
            
            if ( $userMarketplace->save() ) {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['funnels'] = UserMarketplace::where('user_id', $request->input('user_id'))
                                ->orderBy('id', 'desc')
                                ->get();

        die(
            json_encode(
                array(
                    'status'    => 'success', 
                    'html'      => View::make('admin.user.marketplace.user_funnel_list', array('funnels' => $data['funnels']))->render()                 
                )
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
    public function destroy(Request $request, $id)
    {
        $userMarketplace = UserMarketplace::find($request->input('marketplace_id'));

        if ( $userMarketplace->delete() ) {

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



    public function getPartialFunnelList($funnel_name = '') {
        
        
    }
}
