<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageTemplate;
use App\Models\BaseUrl;

class PageTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        $pageTemplate = PageTemplate::find($id);
        if( !$pageTemplate )
        {
            return redirect()->route('dashboard')->with('error', 'Template not found.');
        }

        /*$content = $page_template->content;
        $imgSrc  = asset(BaseUrl::getPageTemplateUrl());
        $content = str_replace("{[img_src]}", $imgSrc, $content);*/

        $contents = json_decode( $pageTemplate->content );
        //$contents = $html->htmlbody;

        return view('layouts/page_template_view', ['contents'=>$contents, 'page' => $pageTemplate]);
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
