<!DOCTYPE html>
<html lang="en" style="{{ (!empty($contents->pagebackground)) ? $contents->pagebackground : '' }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : 'Page Template Builder | Innuban Software' }}</title>@if ( !empty($contents->seo_meta_data_title) )
        <meta class="metaTagTop" name="description" content="{{ $contents->seo_meta_data_description }}">
        <meta class="metaTagTop" name="keywords" content="{{ $contents->seo_meta_data_keywords }}">
        <meta class="metaTagTop" name="author" content="{{ $contents->seo_meta_data_author }}">@endif

<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <!-- NProgress -->
    <link href="{{ asset('admin/css/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('admin/css/green.css') }}" rel="stylesheet">

    <link href="{{ asset('editor/js/colorpicker/css/colorpicker.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('admin/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('admin/css/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/css/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{-- asset('assets/wysiwyg/css/froala_editor.min.css') --}}" rel="stylesheet">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css"
          rel="stylesheet"
          type="text/css"/>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet"/>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css"
          rel="stylesheet"/>


    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="{{ asset('editor/css/bootstrap-iconpicker.min.css') }}"/>


    <link href="{{ asset('admin/css/editor.css') }}" rel="stylesheet">


    <!-- CUSTOM CSS CODE -->
    @if ( !empty($contents->pagestyle) )
        <style><?php echo html_entity_decode( $contents->pagestyle ); ?></style>
@endif
<!-- //TRACKING CODE -->

</head>

<body class="nav-sm landing-page-editor">
<input type="hidden" id="hid_base_url" value="{{ url('/') }}"/>
<input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
<input type="hidden" id="hid_funnel_id" value="{{ $page->funnel_id }}"/>
<input type="hidden" id="hid_funnel_step_id" value="{{ $page->funnel_step_id }}"/>
<input type="hidden" id="hid_page_id" value="{{ $page->id }}"/>


@if ( !empty($data['stepProduct']) )
    <input type="hidden" id="hid_product_id" value="{{ $data['stepProduct']->id }}"/>
@endif

<div class="container body">
    <div class="main_container">
        <!--<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title" id="left_editor_setting" data-toggle="modal" data-target="#editorSettingModal">
                  <i class="fa fa-cog" aria-hidden="true"></i>
              </a>
            </div>

            <div class="clearfix"></div>


            <div class="profile clearfix">
              <div class="profile_pic">
                <i class="fa fa-cog" aria-hidden="true"></i>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div>


            <br />


            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>



          </div>
      </div>-->

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a href="{{ route('steps.show', array($page->funnel_id, $page->funnel_step_id)) }}">
                            <span><i class="glyphicon glyphicon-menu-left	Try it"></i></span>
                            <span style="font-size: 16px; vertical-align: super;">Back</span>
                        </a>
                    </div>

                    <div class="pull-left" style="padding: 15px; width: 89%">
                        <ul class="navbar-buttons" style="margin-bottom: 0px;">
                            <li>
                                <button class="btn btn-success" id="button_editor_save"><i class="fa fa-floppy-o"
                                                                                           aria-hidden="true"></i> Save
                                </button>
                            </li>
                            <li><a href="{{ route('pages.show', $page->id) }}" class="btn btn-primary"
                                   id="button_editor_save"> <i class="fa fa-eye" aria-hidden="true"></i> Preview </a>
                            </li>

                            <li class="pull-right">
                                <ul style="list-style-type: none; padding: 0px;">
                                    <!--<li style="display: inline-block">
                                        <button class="btn btn-success show-settings-product-list" id="button_manual_product" data-toggle="modal" data-target="#manualProductsModal">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Manual product
                                        </button>
                                    </li>-->
                                    <li style="display: inline-block">
                                        <!--<button class="btn btn-success" id="left_editor_setting" data-toggle="modal"
                                                data-target="#editorSettingModal">
                                            <i class="fa fa-cog" aria-hidden="true"></i> Settings
                                        </button>-->

                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown"><i class="fa fa-cogs"></i> &nbsp; Settings
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="show-tracking-modal" data-toggle="modal"
                                                       data-target="#funnelTrackingModal"><i
                                                                class="fa fa-bar-chart"></i> Tracking Code</a></li>
                                                <li><a href="#" class="show-seo-modal" data-toggle="modal"
                                                       data-target="#pageSeoMetaData"><i class="fa fa-globe"></i>
                                                        SEO Meta Data</a></li>
                                                <li><a href="#" class="show-css-modal" data-toggle="modal"
                                                       data-target="#customCssModal"><i class="fa fa-code"></i> Custom
                                                        CSS</a></li>
                                                <li><a href="#" class="show-background-modal" data-toggle="modal"
                                                       data-target="#pageBackgroundModal"><i
                                                                class="fa fa-paint-brush"></i> Background</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main"
             style="<?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?>">

            <div id="editor_panel">

                <!-- ALL the content place -->
                <div id="htmleditor">


                    @if ( !empty($contents->htmlbody) )
						<?php echo $contents->htmlbody ?>
                    @else
                        <form id="frm_htmleditor_container" class="validate-form" action="{{ $action }}" method="post"
                              data-parsley-validate="">

                            <input type="hidden" id="frm_csrf_token" name="frm_csrf_token" name="_token"
                                   value="{{ csrf_token() }}"/>
                            <input type="hidden" id="frm_hid_funnel_id" name="frm_hid_funnel_id"
                                   value="{{ $page->funnel_id }}"/>
                            <input type="hidden" id="frm_hid_funnel_step_id" name="frm_hid_funnel_step_id"
                                   value="{{ $page->funnel_step_id }}"/>
                            <input type="hidden" id="frm_hid_page_id" name="frm_hid_page_id" value="{{ $page->id }}"/>


                            @if( !empty($data['stepProduct']) )
                                <input type="hidden" id="product" name="product"
                                       value="{{ $data['stepProduct']->id }}"/>
                            @endif

                            <div class="editor-container element-type-main clearfix text-center">
                                <div class="lb-content-body" id="main-html-container">

                                    <button style="margin-top: 30px; width: 70%"
                                            class='add-inner-element btn btn-primary add-element' data-section-id='row'
                                            id='row_modal' alt='Add elements' data-toggle='modal'
                                            data-target='#rowModal'>ADD ROW
                                    </button>

                                    <!--<button style="margin-top: 30px; width: 70%" class='add-inner-element btn btn-primary add-element' data-section-id='row' id='row_modal' alt='Add Row' data-toggle='modal' data-target='#sectionModal'>ADD ROW</button>-->

                                </div>
                            </div>
                        </form>



                        <!-- MODAL
                        <div id="editorVideoModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Video</h4>
                                  </div>

                                  <div class="modal-body" id="editor_video_body">
                                  </div>
                                </div>
                            </div>
                        </div> -->
                    @endif
                </div>


            <!--<form id="frm_htmleditor_save" action="{{ route('pages.update', $page->id) }}" method="put">-->
                {!! Form::model($page, array('route' => ['pages.update', $page->id], 'id'=>'frm_htmleditor_save', 'method' => 'PUT')) !!}
                <input type="hidden" name="name" value="{{ $page->funnelStep->display_name }}"/>
                <textarea name="htmlbody" style="display: none"><?php echo $contents->htmlbody ?></textarea>
                <textarea name="pagestyle" id="textarea_pagestyle"
                          style="display: none"><?php echo ( ! empty( $contents->pagestyle ) ) ? $contents->pagestyle : '' ?></textarea>
                <textarea name="pagebackground" id="pagebackground"
                          style="display: none"><?php echo ( ! empty( $contents->pagebackground ) ) ? $contents->pagebackground : '' ?></textarea>
                <textarea name="tracking_header" class="no-display"
                          value="{{ (!empty($contents->tracking_header)) ? $contents->tracking_header : ''  }}"></textarea>
                <textarea name="tracking_footer" class="no-display"
                          value="{{ (!empty($contents->tracking_footer)) ? $contents->tracking_footer : ''  }}"></textarea>
                <!--<input type="hidden" name="tracking_header" /><input type="hidden" name="tracking_footer" />-->


                @if ( !empty($contents->page_background_image) )
                    <input type="hidden" name="page_background_image" value="{{ $contents->page_background_image }}"/>
                    <input type="hidden" name="page_background_image_position"
                           value="{{ $contents->page_background_image_position }}"/>
                    <input type="hidden" name="page_background_color" value="{{ $contents->page_background_color }}"/>
                @endif

                @if ( !empty($contents->seo_meta_data_title) )
                    <input type="hidden" name="seo_meta_data_title" value="{{ $contents->seo_meta_data_title }}"/>
                    <input type="hidden" name="seo_meta_data_description"
                           value="{{ $contents->seo_meta_data_description }}"/>
                    <input type="hidden" name="seo_meta_data_keywords" value="{{ $contents->seo_meta_data_keywords }}"/>
                    <input type="hidden" name="seo_meta_data_author" value="{{ $contents->seo_meta_data_author }}"/>
                @endif


                {!! Form::close() !!}
            </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <!--<footer>
          <div class="pull-right">
            Innuban Software
          </div>
          <div class="clearfix"></div>
      </footer>-->
        <!-- /footer content -->
    </div>
</div>


<!-- ===================================================== MODALS ========================================================== -->

<!-- MAIN MODAL -->
<div id="mainModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>

                <div class="modal-header-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        @foreach ($widgets as $key => $widget)
                            <li role="presentation" class="<?php echo ( $key == 0 ) ? 'active' : ''; ?>">
                                <a href="#tab_{{ $widget }}" id="{{ $widget }}-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">{{ ucfirst($widget) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- ROW MODAL
<div id="sectionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Row</h4>
            </div>

            <div class="modal-body" id="row_body">
            </div>
        </div>
    </div>
</div> -->

<!-- ROW MODAL -->
<div id="rowModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Row</h4>
            </div>

            <div class="modal-body" id="row_body">
            </div>
        </div>
    </div>
</div>

<!-- GRID MODAL -->
<div id="gridModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Grids</h4>
            </div>

            <div class="modal-body" id="grid_body">
            </div>
        </div>
    </div>
</div>

<!-- ELEMENT MODAL -->
<div id="elementModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elements</h4>

                <div class="modal-header-tab">
                    <ul>
                        <li data-filter-type="all">All</li>
                        <li data-filter-type="general">General</li>
                        <li data-filter-type="image">Image</li>
                        <li data-filter-type="video">Video</li>
                        <li data-filter-type="forms">Forms</li>
                        <li data-filter-type="order">Order</li>
                        <li data-filter-type="product">Product</li>
                    </ul>
                </div>
            </div>

            <div class="modal-body" id="element_body">
            </div>
        </div>
    </div>
</div>

<!-- ELEMENT SETTINGS MODAL -->
<div id="elementSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="settings_body">
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT SETTINGS MODAL -->
<div id="productModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="product_body">
            </div>
        </div>
    </div>
</div>


<!-- ELEMENT SETTINGS MODAL -->
<div id="editorSettingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Page settings</h4>
            </div>

            <form id="frm_page_settings" class="form-horizontal">
                <div class="modal-body" id="page_settings_body">
                    <div class="form-group clearfix">
                        <label class="control-label col-sm-3" for="alt_text">Background color:</label>
                        <div class="col-sm-9">
                            <input type="text" name="page_bg_color" value="" class="form-control color-settings"/>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label class="control-label col-sm-3" for="text_color">Padding:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="page_setting_padding" type="range" value="0"
                                   min="0" max="50">
                            <span class="range-slider__value description-padding-setting">0px</span>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_page_settings" class="btn btn-primary"> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="orderAddressDetailsSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Info</h4>
            </div>

            <div class="modal-body" id="order_address_details_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderAddressDetailsSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_address_details_tab_settings" id="order-address-details-settings-tab"
                               role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_address_details_tab_advance" role="tab"
                               id="order-address-details-advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_address_details_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_address_details_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_address_details_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_address_details_setting_align"
                                                id="order_address_details_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_address_details_header_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_address_details_header_color"
                                               name="order_address_details_header_color" placeholder="Successful color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_address_details_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label"
                                                           for="order_address_details_padding_top">Padding
                                                        Top:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_padding_top"
                                                           name="order_address_details_padding_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_padding_right">Padding
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_padding_right"
                                                           name="order_address_details_padding_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_padding_bottom">Padding
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_padding_bottom"
                                                           name="order_address_details_padding_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_padding_left">Padding
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_padding_left"
                                                           name="order_address_details_padding_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="order_address_details_margin_top">Margin
                                                        Top:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_margin_top"
                                                           name="order_address_details_margin_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_margin_right">Margin
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_margin_right"
                                                           name="order_address_details_margin_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_margin_bottom">Margin
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_margin_bottom"
                                                           name="order_address_details_margin_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label"
                                                           for="order_address_details_margin_left">Margin
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_address_details_margin_left"
                                                           name="order_address_details_margin_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_address_details_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="orderActionSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Info</h4>
            </div>

            <div class="modal-body" id="order_action_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_action_tab_settings" id="order-action-settings-tab" role="tab"
                               data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_action_tab_advance" role="tab" id="order-action-advance-tab"
                               data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_action_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_action_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_action_button_text">Button
                                        text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_action_button_text"
                                               name="order_action_button_text"
                                               placeholder="Button Text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_print_button_text">Print Button
                                        text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_print_button_text"
                                               name="order_print_button_text"
                                               placeholder="Print Button Text" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_action_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_action_setting_align" id="order_action_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_button_bg_color">Button BG
                                            Color:</label>
                                        <input type="text" class="form-control" id="order_button_bg_color"
                                               name="order_button_bg_color"
                                               placeholder="Button BG Color" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_button_color">Button Text Color:</label>
                                        <input type="text" class="form-control" id="order_button_color"
                                               name="order_button_color"
                                               placeholder="Button Text Color" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_print_button_bg_color">Print Button BG
                                            Color:</label>
                                        <input type="text" class="form-control" id="order_print_button_bg_color"
                                               name="order_print_button_bg_color"
                                               placeholder="Button BG Color" value=""/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="order_print_button_text_color">Print Button
                                            Text Color:</label>
                                        <input type="text" class="form-control" id="order_print_button_text_color"
                                               name="order_print_button_text_color"
                                               placeholder="Button Text Color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_action_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="order_action_padding_top">Padding
                                                        Top:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_padding_top"
                                                           name="order_action_padding_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_padding_right">Padding
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_padding_right"
                                                           name="order_action_padding_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_padding_bottom">Padding
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_padding_bottom"
                                                           name="order_action_padding_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_padding_left">Padding
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_padding_left"
                                                           name="order_action_padding_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="order_action_margin_top">Margin
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="order_action_margin_top"
                                                           name="order_action_margin_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_margin_right">Margin
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_margin_right"
                                                           name="order_action_margin_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_margin_bottom">Margin
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_margin_bottom"
                                                           name="order_action_margin_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_action_margin_left">Margin
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_action_margin_left"
                                                           name="order_action_margin_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_action_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="orderInfoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Info</h4>
            </div>

            <div class="modal-body" id="order_info_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="orderInfoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#order_info_tab_settings" id="order-info-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#order_info_tab_advance" role="tab" id="order-info--advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_order_info_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="order_info_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_successful_message">Order
                                        Successful Message:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="order_successful_message"
                                               name="order_successful_message"
                                               placeholder="Order Successful Message" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="order_info_setting_align">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="order_info_setting_align" id="order_info_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="order_successful_message_color">Text
                                        Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings"
                                               id="order_successful_message_color"
                                               name="order_successful_message_color" placeholder="Successful color"
                                               value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="order_info_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="order_info_padding_top">Padding
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="order_info_padding_top"
                                                           name="order_info_padding_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_padding_right">Padding
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_info_padding_right"
                                                           name="order_info_padding_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_padding_bottom">Padding
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_info_padding_bottom"
                                                           name="order_info_padding_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_padding_left">Padding
                                                        Left:</label>
                                                    <input type="text" class="form-control" id="order_info_padding_left"
                                                           name="order_info_padding_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="order_info_margin_top">Margin
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="order_info_margin_top"
                                                           name="order_info_margin_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_margin_right">Margin
                                                        Right:</label>
                                                    <input type="text" class="form-control" id="order_info_margin_right"
                                                           name="order_info_margin_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_margin_bottom">Margin
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="order_info_margin_bottom"
                                                           name="order_info_margin_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="order_info_margin_left">Margin
                                                        Left:</label>
                                                    <input type="text" class="form-control" id="order_info_margin_left"
                                                           name="order_info_margin_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="order_info_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="productDescriptionModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="product_price_body">

                <form id="frm_product_description_settings" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="alt_text">Align:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="select_product_description_align_option"
                                    id="select_product_price_align_option">
                                <option value="">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="alt_text">Text color:</label>
                        <div class="col-sm-9">
                            <input type="text" name="description_color" value="" class="form-control color-settings"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="text_color">Padding:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="description_setting_padding" type="range"
                                   value="0px" min="8" max="50">
                            <span class="range-slider__value description-padding-setting">0</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="text_color">Font Size:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="description_font_size" type="range" value="15"
                                   min="10" max="50">
                            <span class="range-slider__value description-fontsize-value">15px</span>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_save_product_description_setting" class="btn btn-primary"> Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- PRODUCT PRICE SETTINGS MODAL -->
<div id="productPriceSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product</h4>
            </div>

            <div class="modal-body" id="product_price_body">

                <form id="frm_product_price_settings" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="alt_text">Align:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="select_product_price_align_option"
                                    id="select_product_price_align_option">
                                <option value="">Center</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="alt_text">Display price as:</label>
                        <div class="col-sm-9">
                            <input type="text" name="price_as" value="" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="alt_text">Price text color:</label>
                        <div class="col-sm-9">
                            <input type="text" name="price_color" value="" class="form-control color-settings"/>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-6">
                            <label class="control-label" for="text_color">Padding Top:</label>
                            <input class="form-control" name="price_setting_padding" type="text" placeholder="0px">
                        </div>

                        <div class="col-md-6">
                            <label class="control-label" for="text_color">Font Size:</label>
                            <input class="form-control" name="price_font_size" type="text" placeholder="0px">
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="control-label col-sm-3" for="text_color">Padding:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="price_setting_padding" type="range" value="0px"
                                   min="0px" max="50">
                            <span class="range-slider__value price-padding-setting">0</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="text_color">Font Size:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="price_font_size" type="range" value="0px" min="0px"
                                   max="50">
                            <span class="range-slider__value price-setting-value">0</span>
                        </div>
                    </div>-->

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_save_product_price_setting" class="btn btn-primary"> Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- ELEMENT PRODUCT VARIENTS SETTINGS MODAL -->
<div id="productVarientSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Varients</h4>
            </div>

            <div class="modal-body" id="product_varients_body">

                <form id="frm_product_varients_settings" class="form-horizontal">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Align:</label>
                                <select class="form-control" name="select_product_varient_align_option"
                                        id="select_product_varient_align_option">
                                    <option value="">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-3" for="text_color">Padding:</label>
                        <div class="col-sm-9 range-slider">
                            <input class="range-slider__range" name="varient_setting_padding" type="range" value="15px"
                                   min="8" max="50">
                            <span class="range-slider__value varients-padding-setting">0</span>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_save_product_varients_setting" class="btn btn-primary"> Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- MANUAL PRODUCTS FOR SETTINGS MODAL -->
<div id="manualProductsSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product</h4>
            </div>

            <div class="modal-body" id="manual_product_settings_body" style="max-height: 500px; overflow: auto">
            </div>
        </div>
    </div>
</div>

<!-- MANUAL PRODUCTS MODAL -->
<div id="manualProductsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product</h4>
            </div>

            <div class="modal-body" id="manual_product_body" style="max-height: 500px; overflow: auto">
            </div>
        </div>
    </div>
</div>


<!-- MANUAL PRODUCTS SETTINGS MODAL -->
<div id="manualProductSettingsModal" class="modal fade" role="dialog" style="z-index: 99999">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Manual Product Settings</h4>
            </div>

            <div class="modal-body" id="manual_product_settings_body" data-product-id="">

                <form id="frm_manual_product_settings" class="form-horizontal">


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Display price as:</label>
                                <input type="text" name="price_as" value="" class="form-control"/>
                            </div>

                            <div class="col-md-6">
                                <label for="">Price text color:</label>
                                <input type="text" name="price_color" value="" class="form-control color-settings"/>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group text-right">
                        <button id="btn_save_manual_product_choose_setting" class="btn btn-primary"> Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- SINGLE IMAGE SETTINGS MODAL -->
<div id="singleImgaeSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Image Settings</h4>
            </div>

            <div class="modal-body" id="single_image_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab" aria-expanded="false">Advance</a>
                        </li>
                    </ul>


                    <div id="myTabContent" class="tab-content">
                        <form id="frm_single_image_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_path" name="path" aria-describedby="basic-addon2"
                                                   value=""/>
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o"
                                                                                                 aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="alt_text">ALT Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alt_text" name="alt_text"
                                               placeholder="Enter ALT text" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="width">Width:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control" id="image_gallery_width"
                                               name="image_gallery_width" placeholder="Enter width" value="10">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="height">Height:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control" id="image_gallery_height"
                                               name="image_gallery_height" placeholder="Enter width" value="100">

                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tab_themes" aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="image_padding_top">Padding
                                                    Top:</label>
                                                <input type="text" class="form-control" id="image_padding_top"
                                                       name="image_padding_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_padding_right">Padding
                                                    Right:</label>
                                                <input type="text" class="form-control" id="image_padding_right"
                                                       name="image_padding_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_padding_bottom">Padding
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="image_padding_bottom"
                                                       name="image_padding_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_padding_left">Padding
                                                    Left:</label>
                                                <input type="text" class="form-control" id="image_padding_left"
                                                       name="image_padding_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="image_margin_top">Margin Top:</label>
                                                <input type="text" class="form-control" id="image_margin_top"
                                                       name="image_margin_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_margin_right">Margin
                                                    Right:</label>
                                                <input type="text" class="form-control" id="image_margin_right"
                                                       name="image_margin_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_margin_bottom">Margin
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="image_margin_bottom"
                                                       name="image_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_margin_left">Margin
                                                    Left:</label>
                                                <input type="text" class="form-control" id="image_margin_left"
                                                       name="image_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="image_border_style">Border
                                                    Style:</label>
                                                <select class="form-control" name="image_border_style"
                                                        id="image_border_style">
                                                    <option value="none">None</option>
                                                    <option value="dotted">Dotted</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="double">Double</option>
                                                    <option value="groove">Groove</option>
                                                    <option value="ridge">Ridge</option>
                                                    <option value="inset">Inset</option>
                                                    <option value="outset">Outset</option>
                                                    <option value="hidden">Hidden</option>
                                                </select>
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_border_color">Border
                                                    Color:</label>
                                                <input type="text" class="form-control" id="image_border_color"
                                                       name="image_border_color"
                                                       placeholder="Border color" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="image_border_size">Border
                                                    Size:</label>
                                                <input type="text" class="form-control" id="image_border_size"
                                                       name="image_border_size"
                                                       placeholder="Border size" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="image_border_radius">Border
                                                    Radius:</label>
                                                <input type="text" class="form-control" id="image_border_radius"
                                                       name="image_border_radius"
                                                       placeholder="Border radius" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li>
                                                <label for="image_shadow_type">Shadow type:</label>
                                                <select class="form-control" name="image_shadow_type"
                                                        id="image_shadow_type">
                                                    <option value="outset">Outset</option>
                                                    <option value="inset">Inset</option>
                                                </select>
                                            </li>
                                            <li class="clearfix">
                                                <label class="control-label" for="image_shadow_x_offset">Shadow X
                                                    Offset:</label>
                                                <input type="text" class="form-control" id="image_shadow_x_offset"
                                                       name="image_shadow_x_offset"
                                                       placeholder="Border color" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="image_shadow_y_offset">Shadow Y
                                                    Offset:</label>
                                                <input type="text" class="form-control" id="image_shadow_y_offset"
                                                       name="image_shadow_y_offset"
                                                       placeholder="Border color" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="image_shadow_blur">Shadow
                                                    Blur:</label>
                                                <input type="text" class="form-control" id="image_shadow_blur"
                                                       name="image_shadow_blur"
                                                       placeholder="Shadow size" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="image_shadow_color">Shadow
                                                    Color</label>
                                                <input type="text" class="form-control" id="image_shadow_color"
                                                       name="image_shadow_color"
                                                       placeholder="Border radius" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="single_image_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SOCIAL SHARE SETTINGS MODAL -->
<div id="socialShareSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="social_share_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_settings" id="settings-tab" role="tab" data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_themes" role="tab" id="themes-tab" data-toggle="tab" aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_social_share_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="social_url">Share URL:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_url" name="social_url"
                                               placeholder="Enter social URL" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="twitter_title">Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="social_share_title"
                                               name="social_share_title" placeholder="Enter title" value=""/>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_themes" aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="social_share_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PRICE TABLE SETTINGS MODAL -->
<div id="pricingSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pricing Table</h4>
            </div>

            <div class="modal-body" id="pricing_table_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="pricingTableTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#pricing_settings_tab_settings" id="pricing-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#pricing_tab_themes" role="tab" id="pricing-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <form id="frm_pricing_table_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="pricing_settings_tab_settings"
                                 aria-labelledby="settings-tab">

                                <div class="form-group">
                                    <!--<label class="control-label col-sm-3" for="bg_color">Video Embed:</label>-->
                                    <textarea name="pricing_table_html" id="pricing_table_html"
                                              class="form-control html-editor"></textarea>
                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="pricing_tab_themes"
                                 aria-labelledby="home-tab">
                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                    stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg
                                    carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                    synth. Cosby sweater eu banh mi, qui irure terr.</p>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="pricing_table_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SELECTBOX SETTINGS MODAL -->
<div id="selectSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="select_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="selectBoxTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#selectbox_tab_settings" id="selectbox-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#selectbox_tab_themes" role="tab" id="selectbox-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="selectbox_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_select_box_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Embed:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="select_options" id="select_options">
                                            <option value="">No Set</option>
                                            <option value="all_countries">All Countries</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="selectbox_tab_themes" aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="select_box_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ICON LIST SETTINGS MODAL
<div id="iconListSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="icon_list_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_list_tab_settings" id="icon-list-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_list_tab_themes" role="tab" id="icon-list-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <form id="frm_icon_list_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_list_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">text Align:</label>
                                    <div class="col-sm-9">
                                        <select name="alignment_type" id="alignment_type" class="form-control">
                                            <option value="center">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Icon:</label>
                                    <div class="col-sm-9">
                                        <div class="icon-package-list">
                                            <ul class="icons"></ul>
                                            <input type="hidden" name="hid_icon_list_class" id="hid_icon_class"/>
                                            <input type="hidden" name="hid_icon_list_code" id="hid_icon_code"/>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_list_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="list-icon-items">
                                    <div class="row">
                                        <textarea class="html-editor" rows="5" name="icon_list_text"
                                                  id="icon_list_text"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_list_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<div id="iconListSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="icon_list_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconListTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_list_tab_settings" id="icon-list-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_list_tab_themes" role="tab" id="icon-list-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <form id="frm_icon_list_settings" class="form-horizontal">
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_list_tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="repeat-icon-list">
                                <!--<div class="form-group">
                                        <div class="row clearfix">
                                            <div class="col-md-2">
                                                <button type="button" id="{{ time() }}" class="btn btn-default btn-block btn-lg iconpicker"
                                                        data-iconset="fontawesome" data-icon="fa-check" data-rows="5" data-cols="10" data-selected-class="btn-normal-success"
                                                        role="iconpicker"></button>
                                            </div>

                                            <div class="col-md-10">
                                                <input type="text" name="list_text[]" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>

                                <button type="button" id="icon_list_add_item"
                                        class="btn btn-normal-success btn-success pull-right"><i class="fa fa-plus"
                                                                                                 aria-hidden="true"></i>
                                    Add more
                                </button>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_list_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="list-icon-items">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="icon_list_color">Icon
                                                Color:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="icon_list_color"
                                                       name="icon_list_color"
                                                       placeholder="Enter Icon Color" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_list_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- VIDEO SETTINGS MODAL -->
<div id="embedVideoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="embed_video_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="videoSettingsTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#video_tab_settings" id="video-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#video_tab_themes" role="tab" id="video-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="video_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_embed_video_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Type:</label>
                                    <div class="col-sm-9">
                                        <select name="video_type" id="video_type" class="form-control">
                                            <option value="youtube">Youtube</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Video Embed:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_embed" name="video_embed"
                                               placeholder="Enter video html" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Autoplay:</label>
                                    <div class="col-sm-9">
                                        <select name="video_autoplay" id="video_autoplay" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Controls:</label>
                                    <div class="col-sm-9">
                                        <select name="video_controls" id="video_controls" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Branding:</label>
                                    <div class="col-sm-9">
                                        <select name="video_branding" id="video_branding" class="form-control">
                                            <option value="on">On</option>
                                            <option value="off">Off</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Width:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_width" name="video_width"
                                               placeholder="Enter video html" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Height:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_height" name="video_height"
                                               placeholder="Enter video html" value=""/>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="video_tab_themes" aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="embed_video_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ICON SETTINGS MODAL -->
<div id="iconSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="icon_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="iconSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#icon_tab_settings" id="icon-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#icon_tab_themes" role="tab" id="icon-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_icon_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="icon_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">text Align:</label>
                                    <div class="col-sm-9">
                                        <select name="alignment_type" id="alignment_type" class="form-control">
                                            <option value="center">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="icon_color">Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="icon_color"
                                               name="icon_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Icon:</label>
                                    <div class="col-sm-9">
                                        <div class="icon-package-list">
                                            <ul class="icons"></ul>
                                            <input type="hidden" name="hid_icon_class" id="hid_icon_class"/>
                                            <input type="hidden" name="hid_icon_code" id="hid_icon_code"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="icon_tab_themes" aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="icon_padding_top">Padding
                                                    Top:</label>
                                                <input type="text" class="form-control" id="icon_padding_top"
                                                       name="icon_padding_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_padding_right">Padding
                                                    Right:</label>
                                                <input type="text" class="form-control" id="icon_padding_right"
                                                       name="icon_padding_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_padding_bottom">Padding
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="icon_padding_bottom"
                                                       name="icon_padding_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_padding_left">Padding
                                                    Left:</label>
                                                <input type="text" class="form-control" id="icon_padding_left"
                                                       name="icon_padding_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="icon_margin_top">Margin
                                                    Top:</label>
                                                <input type="text" class="form-control" id="icon_margin_top"
                                                       name="icon_margin_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_margin_right">Margin
                                                    Right:</label>
                                                <input type="text" class="form-control" id="icon_margin_right"
                                                       name="icon_margin_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_margin_bottom">Margin
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="icon_margin_bottom"
                                                       name="icon_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_margin_left">Margin
                                                    Left:</label>
                                                <input type="text" class="form-control" id="icon_margin_left"
                                                       name="icon_margin_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="icon_border_style">Border
                                                    Style:</label>
                                                <select class="form-control" name="icon_border_style"
                                                        id="icon_border_style">
                                                    <option value="none">None</option>
                                                    <option value="dotted">Dotted</option>
                                                    <option value="dashed">Dashed</option>
                                                    <option value="solid">Solid</option>
                                                    <option value="double">Double</option>
                                                    <option value="groove">Groove</option>
                                                    <option value="ridge">Ridge</option>
                                                    <option value="inset">Inset</option>
                                                    <option value="outset">Outset</option>
                                                    <option value="hidden">Hidden</option>
                                                </select>
                                            </li>
                                            <li>
                                                <label class="control-label" for="icon_border_color">Border
                                                    Color:</label>
                                                <input type="text" class="form-control" id="icon_border_color"
                                                       name="icon_border_color"
                                                       placeholder="Enter width" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="icon_border_size">Border
                                                    Size:</label>
                                                <input type="text" class="form-control" id="icon_border_size"
                                                       name="icon_border_size"
                                                       placeholder="Enter width" value="">
                                            </li>

                                            <li>
                                                <label class="control-label" for="icon_border_radius">Border
                                                    Radius:</label>
                                                <input type="text" class="form-control" id="icon_border_radius"
                                                       name="icon_border_radius"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="icon_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SEPERATOR SETTINGS MODAL -->
<div id="seperatorSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="seperator_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="seperatorSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#seperator_tab_settings" id="seperator-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#seperator_tab_themes" role="tab" id="seperator-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_seperator_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="seperator_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seperator_color">Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="seperator_color"
                                               name="seperator_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="hid_seperator_margin">Margin:</label>
                                    <div class="col-sm-9 range-slider">
                                        <!--<input id="seperator_margin" type="text" data-slider-min="1000" data-slider-max="10000000" data-slider-step="5" />
                                        <input type="hidden" class="form-control" id="hid_seperator_margin" name="hid_seperator_margin" value="5" />-->
                                        <input class="range-slider__range" type="range" value="15px" min="0" max="50">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="seperator_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="seperator_padding_top">Padding
                                                    Top:</label>
                                                <input type="text" class="form-control" id="seperator_padding_top"
                                                       name="seperator_padding_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_padding_right">Padding
                                                    Right:</label>
                                                <input type="text" class="form-control" id="seperator_padding_right"
                                                       name="seperator_padding_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_padding_bottom">Padding
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="seperator_padding_bottom"
                                                       name="seperator_padding_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_padding_left">Padding
                                                    Left:</label>
                                                <input type="text" class="form-control" id="seperator_padding_left"
                                                       name="seperator_padding_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="seperator_margin_top">Margin
                                                    Top:</label>
                                                <input type="text" class="form-control" id="seperator_margin_top"
                                                       name="seperator_margin_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_margin_right">Margin
                                                    Right:</label>
                                                <input type="text" class="form-control" id="seperator_margin_right"
                                                       name="seperator_margin_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_margin_bottom">Margin
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="seperator_margin_bottom"
                                                       name="seperator_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="seperator_margin_left">Margin
                                                    Left:</label>
                                                <input type="text" class="form-control" id="seperator_margin_left"
                                                       name="seperator_margin_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="seperator_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PARAGRAPH SETTINGS MODAL -->
<div id="paragraphSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="paragraph_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="paragraphSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#paragraph_tab_settings" id="paragraph-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#paragraph_tab_themes" role="tab" id="paragraph-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_paragraph_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="paragraph_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label" for="paragraph_text">Paragraph Text:</label>
                                    <textarea class="html-editor" id="paragraph_text" rows="5"
                                              name="paragraph_text"></textarea>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-6">
                                        <label class="control-label" for="text_color">Text Color:</label>
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="control-label" for="bg_color">Background Color:</label>
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="paragraph_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="paragraph_padding_top">Padding
                                                    Top:</label>
                                                <input type="text" class="form-control" id="paragraph_padding_top"
                                                       name="paragraph_padding_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_padding_right">Padding
                                                    Right:</label>
                                                <input type="text" class="form-control" id="paragraph_padding_right"
                                                       name="paragraph_padding_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_padding_bottom">Padding
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="paragraph_padding_bottom"
                                                       name="paragraph_padding_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_padding_left">Padding
                                                    Left:</label>
                                                <input type="text" class="form-control" id="paragraph_padding_left"
                                                       name="paragraph_padding_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="paragraph_margin_top">Margin
                                                    Top:</label>
                                                <input type="text" class="form-control" id="paragraph_margin_top"
                                                       name="paragraph_margin_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_margin_right">Margin
                                                    Right:</label>
                                                <input type="text" class="form-control" id="paragraph_margin_right"
                                                       name="paragraph_margin_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_margin_bottom">Margin
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="paragraph_margin_bottom"
                                                       name="paragraph_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="paragraph_margin_left">Margin
                                                    Left:</label>
                                                <input type="text" class="form-control" id="paragraph_margin_left"
                                                       name="paragraph_margin_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="paragraph_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- SUB HEADLINE SETTINGS MODAL -->
<div id="subHeadlineSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="sub-headlinesettings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="subHeadlineTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#sub_headline_tab_settings" id="sub-headline-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#sub_headline_tab_themes" role="tab" id="sub-headline-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_sub_headline_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="sub_headline_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="sub_headline_text">Headline Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="sub_headline_text"
                                               name="sub_headline_text" placeholder="Enter headline text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="sub_headline_setting_align" id="sub_headline_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="sub_headline_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="sub_headline_padding_top">Padding
                                                        Top:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_padding_top"
                                                           name="sub_headline_padding_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_padding_right">Padding
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_padding_right"
                                                           name="sub_headline_padding_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_padding_bottom">Padding
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_padding_bottom"
                                                           name="sub_headline_padding_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_padding_left">Padding
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_padding_left"
                                                           name="sub_headline_padding_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="sub_headline_margin_top">Margin
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="sub_headline_margin_top"
                                                           name="sub_headline_margin_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_margin_right">Margin
                                                        Right:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_margin_right"
                                                           name="sub_headline_margin_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_margin_bottom">Margin
                                                        Bottom:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_margin_bottom"
                                                           name="sub_headline_margin_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="sub_headline_margin_left">Margin
                                                        Left:</label>
                                                    <input type="text" class="form-control"
                                                           id="sub_headline_margin_left"
                                                           name="sub_headline_margin_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="sub_headline_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HEADLINE SETTINGS MODAL -->
<div id="headlineSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="headline_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="headlineSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#headline_tab_settings" id="headline-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#headline_tab_themes" role="tab" id="headline-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_headline_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="headline_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Headline Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="headline_text" name="headline_text"
                                               placeholder="Enter headline text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Alignment:</label>
                                    <div class="col-sm-9">
                                        <select name="headline_setting_align" id="headline_setting_align"
                                                class="form-control">
                                            <option value="">Center</option>
                                            <option value="left"> Left</option>
                                            <option value="right"> Right</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="headline_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="headline_padding_top">Padding
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="headline_padding_top"
                                                           name="headline_padding_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_padding_right">Padding
                                                        Right:</label>
                                                    <input type="text" class="form-control" id="headline_padding_right"
                                                           name="headline_padding_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_padding_bottom">Padding
                                                        Bottom:</label>
                                                    <input type="text" class="form-control" id="headline_padding_bottom"
                                                           name="headline_padding_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_padding_left">Padding
                                                        Left:</label>
                                                    <input type="text" class="form-control" id="headline_padding_left"
                                                           name="headline_padding_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-md-12">
                                            <ul class="inline-list-settings">
                                                <li class="clearfix">
                                                    <label class="control-label" for="headline_margin_top">Margin
                                                        Top:</label>
                                                    <input type="text" class="form-control" id="headline_margin_top"
                                                           name="headline_margin_top"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_margin_right">Margin
                                                        Right:</label>
                                                    <input type="text" class="form-control" id="headline_margin_right"
                                                           name="headline_margin_right"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_margin_bottom">Margin
                                                        Bottom:</label>
                                                    <input type="text" class="form-control" id="headline_margin_bottom"
                                                           name="headline_margin_bottom"
                                                           placeholder="Enter width" value="">
                                                </li>
                                                <li>
                                                    <label class="control-label" for="headline_margin_left">Margin
                                                        Left:</label>
                                                    <input type="text" class="form-control" id="headline_margin_left"
                                                           name="headline_margin_left"
                                                           placeholder="Enter width" value="">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="headline_setting_save"> Save</button>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- GRID 1 SETTINGS MODAL -->
<div id="gridOneSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Settings</h4>
            </div>

            <div class="modal-body" id="grid_one_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="gOneTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#gone_tab_settings" id="gone-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#gone_tab_themes" role="tab" id="gone-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="gone_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="grid_one_row_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="gone_tab_themes" aria-labelledby="home-tab">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="text_color">Padding:</label>
                                <div class="col-sm-9 range-slider">
                                    <input class="range-slider__range" name="grid1_setting_padding" type="range"
                                           value="15px" min="0" max="50">
                                    <span class="range-slider__value">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="grid_one_setting_save"> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- GRID 2 SETTINGS MODAL -->
<div id="gridTwoSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Grid</h4>
            </div>

            <div class="modal-body" id="grid_one_settings_body">
                <form id="grid_two_row_settings" class="form-horizontal">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="hgTwoSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#gtwo_tab_settings" id="gtwo-settings-tab" role="tab" data-toggle="tab"
                                   aria-expanded="true">Settings</a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#gtwo_tab_themes" role="tab" id="gtwo-themes-tab" data-toggle="tab"
                                   aria-expanded="false">Themes</a>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="gtwo_tab_settings"
                                 aria-labelledby="home-tab">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="gtwo_tab_themes" aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Padding :</label>
                                    <div class="col-sm-9 range-slider">
                                        <input class="range-slider__range" name="grid2_setting_padding" type="range"
                                               value="15px" min="0" max="50">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="grid_two_setting_save"> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ROW SETTINGS MODAL -->
<div id="rowSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Row Settings</h4>
            </div>

            <div class="modal-body" id="row_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="rowSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#row_tab_settings" id="row-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#row_tab_themes" role="tab" id="row-themes-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_row_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="row_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Row Type:</label>
                                    <div class="col-sm-9">
                                        <select name="row_type" id="row_type" class="form-control">
                                            <option value="">Medium</option>
                                            <option value="small">Small</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Background Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="row_setting_image_path" name="row_setting_image_path"
                                                   aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o"
                                                                                                 aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="row_background_image_position">Background
                                        Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">


                                        <select name="row_background_image_position"
                                                id="row_background_image_position" class="form-control">
                                            <option value="bgCover">Full Center Fit</option>
                                            <option value="bgCover100">Fill 100% Width</option>
                                            <option value="bgNoRepeat">No Repeat</option>
                                            <option value="bgRepeat">Repeat</option>
                                            <option value="bgRepeatX">Repeat Hortizontally</option>
                                            <option value="bgRepeatY">Repeat Vertically</option>
                                            <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                            <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="row_tab_themes" aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Padding:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="row_setting_padding"
                                               name="row_setting_padding" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!--<label class="control-label col-sm-3" for="text_color">Margin:</label>
                                    <div class="col-sm-9 range-slider">
                                        <input id="seperator_margin" type="text" data-slider-min="1000" data-slider-max="10000000" data-slider-step="5" />
                                        <input type="hidden" class="form-control" id="hid_seperator_margin" name="hid_seperator_margin" value="5" />
                                        <input class="range-slider__range" name="row_setting_margin" type="range" value="15px" min="0" max="50">
                                        <span class="range-slider__value">0</span>
                                    </div>-->
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="row_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- BUTTON SETTINGS MODAL -->
<div id="buttonSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Button</h4>
            </div>

            <div class="modal-body" id="button_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="buttonSettingsTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#button_tab_settings" id="button-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#button_tab_themes" role="tab" id="button-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#button_tab_advance" role="tab" id="button-advance-tab" data-toggle="tab"
                               aria-expanded="false">Advance</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_button_settings" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="button_tab_settings"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_action">Button Action:</label>
                                    <div class="col-sm-9">
                                        <select name="button_action" class="form-control" id="button_action">
                                            <option value="">No Action</option>
                                            <option value="next_step">Go to next step</option>
                                            <option value="open_video">Open video</option>
                                            <option value="add_to_cart">Add to Cart</option>
                                            <option value="submit"> Submit</option>
                                            @if ( !empty( $data['products'] ) )
                                                @foreach ($data['products'] as $key => $product)
                                                    <option value="product_{{ $product->id }}">1
                                                        Click {{ $data['type']->name }} - {{ $product->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" name="step_next_url" value=""/>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none" id="video_url_textbox">
                                    <label class="control-label col-sm-3" for="button_text">Video URL:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="video_url" name="video_url"
                                               placeholder="Enter video URL" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">Button Text:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="button_text" name="button_text"
                                               placeholder="Enter button text" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_text">Button Type:</label>
                                    <div class="col-sm-9">
                                        <select name="button_type" id="button_type" class="form-control">
                                            <option value="">Default</option>
                                            <option value="full"> Full Width</option>
                                            <option value="large">Large</option>
                                            <option value="full_large">Full width and larges</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="button_style">Button Style:</label>
                                    <div class="col-sm-9">
                                        <select name="button_style" id="button_style" class="form-control">
                                            <option value="">Default</option>
                                            <option value="transparent"> Transparent</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Font Size:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="button_font_size"
                                               name="button_font_size" placeholder="Font Size" value=""/>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Text Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="bg_color">Background Color:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="bg_color"
                                               name="bg_color" placeholder="Enter background color" value=""/>
                                    </div>
                                </div>


                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="button_tab_themes"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="text_color">Icon Pack:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control color-settings" id="text_color"
                                               name="text_color" placeholder="Enter text color" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="button_tab_advance"
                                 aria-labelledby="home-tab">
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="button_padding_top">Padding
                                                    Top:</label>
                                                <input type="text" class="form-control" id="button_padding_top"
                                                       name="button_padding_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_padding_right">Padding
                                                    Right:</label>
                                                <input type="text" class="form-control" id="button_padding_right"
                                                       name="button_padding_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_padding_bottom">Padding
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="button_padding_bottom"
                                                       name="button_padding_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_padding_left">Padding
                                                    Left:</label>
                                                <input type="text" class="form-control" id="button_padding_left"
                                                       name="button_padding_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <ul class="inline-list-settings">
                                            <li class="clearfix">
                                                <label class="control-label" for="button_margin_top">Margin Top:</label>
                                                <input type="text" class="form-control" id="button_margin_top"
                                                       name="button_margin_top"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_margin_right">Margin
                                                    Right:</label>
                                                <input type="text" class="form-control" id="button_margin_right"
                                                       name="button_margin_right"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_margin_bottom">Margin
                                                    Bottom:</label>
                                                <input type="text" class="form-control" id="button_margin_bottom"
                                                       name="button_margin_bottom"
                                                       placeholder="Enter width" value="">
                                            </li>
                                            <li>
                                                <label class="control-label" for="button_margin_left">Margin
                                                    Left:</label>
                                                <input type="text" class="form-control" id="button_margin_left"
                                                       name="button_margin_left"
                                                       placeholder="Enter width" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="button_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- TEXT BLOCk SETTINGS -->
<div id="textBlockSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Text Block</h4>
            </div>

            <div class="modal-body" id="text_block_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="textblocSettingTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#text_block_tab_settings" id="text-block-settings-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#text_block_tab_themes" role="tab" id="text-block-themes-tab" data-toggle="tab"
                               aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="text_block_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_text_block_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label" for="textblock_headline_text">Headline Text:</label>
                                    <input type="text" class="form-control" id="textblock_headline_text"
                                           name="textblock_headline_text" placeholder="Enter headline text" value=""/>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label" for="headline_text_color">Headline Text
                                                Color:</label>
                                            <input type="text" class="form-control color-settings jscolor"
                                                   id="headline_text_color" name="headline_text_color"
                                                   placeholder="Enter text color" value=""/>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="control-label" for="headline_bg_color">Headline Bg
                                                Color:</label>
                                            <input type="text" class="form-control color-settings jscolor"
                                                   id="headline_bg_color" name="headline_bg_color"
                                                   placeholder="headline BG color" value=""/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="sub_headline_text">Sub Headline Text:</label>
                                    <br/>
                                    <textarea class="html-editor" id="text_clock_html_editor" rows="5"
                                              name="sub_headline_text"></textarea>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="text_block_tab_themes"
                             aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="text_block_setting_save"> Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- DATE COUNTDOWN SETTINGS MODAL -->
<div id="dateCountdownSettingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Date Countdown</h4>
            </div>

            <div class="modal-body" id="date_countdown_settings_body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="dateCountdownTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#date_countdown_tab_settings" id="date-countdown-settings-tab" role="tab"
                               data-toggle="tab" aria-expanded="true">Settings</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#date_countdown_tab_themes" role="tab" id="date-countdown-themes-tab"
                               data-toggle="tab" aria-expanded="false">Themes</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="date_countdown_tab_settings"
                             aria-labelledby="home-tab">

                            <form id="frm_date_countdown_settings" class="form-horizontal">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="end_date">End Date:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datetimepicker date" id="end_date"
                                               name="end_date" placeholder="Enter date" value=""/>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label col-sm-3" for="text_color">End Time:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datetimepicker time" id="end_time"
                                               name="end_time" placeholder="Enter time" value=""/>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="date_countdown_tab_themes"
                             aria-labelledby="home-tab">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                                aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan
                                helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="date_countdown_setting_save"> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Image Gallery -->
<div id="imageGalleryModal" class="modal fade" role="dialog" style="z-index: 999999 !important">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">
                    Image Gallery

                    <div class="pull-right">
                        <form id="frm_gallery_image_upload" action="{{ route('ajaxImageUpload') }}"
                              enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="file" name="image" class="form-control" style="display: none;">

                            <ul class="image-gallery-option-buttons">
                                <li>
                                    <button type="button" class="btn btn-primary" id="upload_image_to_gallery"> Upload
                                        Image
                                    </button>
                                </li>
                                <li>
                                    <button class="btn btn-success" id="add_image_from_gallery"> Add Image</button>
                                </li>
                                <li>
                                    <button type="button" class="close btn"><i class="fa fa-window-close"
                                                                               aria-hidden="true"></i></button>
                                </li>
                            </ul>

                        </form>


                    </div>
                </h4>
            </div>

            <div class="modal-body">
				<?php if ( ! empty( $images ) ) { ?>
                <ul class="gallery-container clearfix">
					<?php foreach ( $images as $image ) { ?>
                    <li class="gallery-item">
                        <img src="{{ asset('frontend/img/' . basename($image) ) }}"/>
                    </li>
					<?php } ?>
                </ul>
				<?php } ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- MODAL FOR TRACKING CODE -->
<!-- Modal -->
<div id="funnelTrackingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i
                            class="fa fa-bar-chart"></i> &nbsp; Tracking Code</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="dateCountdownTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tracking_header_code" id="tab_tracking_header_code" role="tab"
                               data-toggle="tab" aria-expanded="true">HEADER CODE</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tracking_footer_code" role="tab" id="tab_tracking_footer_code"
                               data-toggle="tab" aria-expanded="false">FOOTER CODE</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_tracking_code" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tracking_header_code"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <textarea class="form-control" rows="10" name="tracking_header_code"
                                              placeholder="Add HTML/JavaScript here...">@if ( !empty($contents->tracking_header) )<?php print_r( $contents->tracking_header ) ?>@endif</textarea>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="tracking_footer_code"
                                 aria-labelledby="home-tab">
                                <textarea class="form-control" rows="10" name="tracking_footer_code"
                                          placeholder="Add HTML/JavaScript here...">@if ( !empty($contents->tracking_footer) )<?php print_r( $contents->tracking_footer ) ?>@endif</textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_tracking_code"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL FOR TRACKING CODE -->


<!-- MODAL FOR CUSTOM CSS -->
<div id="customCssModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-code"></i> &nbsp; Custom CSS</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_add_page_custom_css_code" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="page_custom_css_code"
                                 aria-labelledby="home-tab">
                                <div class="form-group">
                                    <textarea class="form-control" rows="10" name="page_custom_css_code"
                                              placeholder="Add custom CSS here...">@if ( !empty($contents->pagestyle) )<?php print_r( $contents->pagestyle ) ?>@endif</textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_page_custom_css_code"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL FOR CUSTOM CSS -->


<!-- MODAL PAGE BACKGROUND -->
<div id="pageBackgroundModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-paint-brush"></i> &nbsp; Background</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_page_background" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="headline_text">Image:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group gallery-open" data-toggle="modal"
                                             data-target="#imageGalleryModal">
                                            <input type="text" class="form-control" placeholder="Image path"
                                                   id="image_path" name="path" aria-describedby="basic-addon2"
                                                   value="{{ (!empty($contents->page_background_image)) ? $contents->page_background_image : '' }}"/>
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-picture-o"
                                                                                                 aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_background_image_position">Image
                                        Position: </label>
                                    <div class="col-sm-9 clearfix">

                                        @if ( !empty($contents->page_background_image_position) )
                                            <select name="page_background_image_position"
                                                    id="page_background_image_position" class="form-control">
                                                <option value="bgCover" {{ ($contents->page_background_image_position == 'bgCover') ? 'selected' : '' }}>
                                                    Full Center Fit
                                                </option>
                                                <option value="bgCover100" {{ ($contents->page_background_image_position == 'bgCover100') ? 'selected' : '' }}>
                                                    Fill 100% Width
                                                </option>
                                                <option value="bgNoRepeat" {{ ($contents->page_background_image_position == 'bgNoRepeat') ? 'selected' : '' }}>
                                                    No Repeat
                                                </option>
                                                <option value="bgRepeat" {{ ($contents->page_background_image_position == 'bgRepeat') ? 'selected' : '' }}>
                                                    Repeat
                                                </option>
                                                <option value="bgRepeatX" {{ ($contents->page_background_image_position == 'bgRepeatX') ? 'selected' : '' }}>
                                                    Repeat Hortizontally
                                                </option>
                                                <option value="bgRepeatY" {{ ($contents->page_background_image_position == 'bgRepeatY') ? 'selected' : '' }}>
                                                    Repeat Vertically
                                                </option>
                                                <option value="bgRepeatXTop" {{ ($contents->page_background_image_position == 'bgRepeatXTop') ? 'selected' : '' }}>
                                                    Repeat Hortizontally - Top
                                                </option>
                                                <option value="bgRepeatXBottom" {{ ($contents->page_background_image_position == 'bgRepeatXBottom') ? 'selected' : '' }}>
                                                    Repeat Hortizontally - Bottom
                                                </option>
                                            </select>
                                        @else
                                            <select name="page_background_image_position"
                                                    id="page_background_image_position" class="form-control">
                                                <option value="bgCover">Full Center Fit</option>
                                                <option value="bgCover100">Fill 100% Width</option>
                                                <option value="bgNoRepeat">No Repeat</option>
                                                <option value="bgRepeat">Repeat</option>
                                                <option value="bgRepeatX">Repeat Hortizontally</option>
                                                <option value="bgRepeatY">Repeat Vertically</option>
                                                <option value="bgRepeatXTop">Repeat Hortizontally - Top</option>
                                                <option value="bgRepeatXBottom">Repeat Hortizontally - Bottom</option>
                                            </select>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="page_background_bg_color">Background
                                        Color:</label>
                                    <div class="col-sm-9 clearfix">

                                        <input type="text" class="form-control" id="page_background_bg_color"
                                               name="page_background_bg_color" placeholder="Enter width"
                                               value="{{ (!empty($contents->page_background_color)) ? $contents->page_background_color : '' }}">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_page_background"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL PAGE BACKGROUND -->


<!-- MODAL SEO META DATA -->
<div id="pageSeoMetaData" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-globe"></i> &nbsp; SEO Meta Data</h4>
            </div>
            <div class="modal-body">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <div id="myTabContent" class="tab-content">
                        <form id="frm_seo_meta_data" class="form-horizontal">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_settings"
                                 aria-labelledby="home-tab">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seo_meta_data_title">Title:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_title"
                                               name="seo_meta_data_title" placeholder="Web Browser Title"
                                               value="{{ (!empty($contents->seo_meta_data_title)) ? $contents->seo_meta_data_title : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3"
                                           for="seo_meta_data_description">Description:</label>
                                    <div class="col-sm-9 clearfix">
                                        <textarea class="form-control" name="seo_meta_data_description" rows="5"
                                                  placeholder="Page description...">{{ (!empty($contents->seo_meta_data_description)) ? $contents->seo_meta_data_description : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seo_meta_data_keywords">Keywords:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_keywords"
                                               name="seo_meta_data_keywords" placeholder="Keyword, Keyword2"
                                               value="{{ (!empty($contents->seo_meta_data_keywords)) ? $contents->seo_meta_data_keywords : '' }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="seo_meta_data_author">Author:</label>
                                    <div class="col-sm-9 clearfix">
                                        <input type="text" class="form-control" id="seo_meta_data_author"
                                               name="seo_meta_data_author" placeholder="Your Name..."
                                               value="{{ (!empty($contents->seo_meta_data_author)) ? $contents->seo_meta_data_author : '' }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="add_seo_meta_data"> Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--// MODAL SEO META DATA -->


<!-- jQuery -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<!-- Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!-- FastClick -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="{{ asset('admin/js/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('admin/js/nprogress.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{-- asset('assets/wysiwyg/js/froala_editor.min.js') --}}"></script>

<!-- Include Editor JS files. -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>

<script src="{{ asset('assets/jsyml/js-yaml.min.js') }}"></script>

<script src="{{ asset('editor/js/colorpicker/js/colorpicker.js') }}"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="{{ asset('editor/js/bootstrap-iconpicker-iconset-all.min.js') }}"></script>
<script src="{{ asset('editor/js/bootstrap-iconpicker.min.js') }}"></script>

<script src="{{ asset('js/editor.js') }}"></script>


<script>
    $(document).ready(function () {
        $(".ld-element").draggable();
    });
</script>
</body>
</html>