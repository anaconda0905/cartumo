<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    private $widgets = array(

            'section'   => array(
                array(
                    'title'         => 'Section',
                    'description'   => 'Main container section',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_big_section',
                    'visibility'    => 'all',
                    'class'         => array()
                ),
            ),

            'row'   => array(
                array(
                    'title'         => 'Full',
                    'description'   => '100% width section',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_big_row',
                    'visibility'    => 'all',
                    'class'         => array()
                ),
                array(
                    'title'         => 'Medium',
                    'description'   => '1170px size section',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_medium_row',
                    'visibility'    => 'all',
                    'class'         => array()
                ),
                array(
                    'title'         => 'Small',
                    'description'   => '970px size section',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_small_row',
                    'visibility'    => 'all',
                    'class'         => array()
                ),
                /*array(
                    'title'         => 'Header Row',
                    'description'   => 'Header row',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_header_row',
                    'class'         => array()
                ),*/

                array(
                    'title'         => 'Page Seperator',
                    'description'   => 'Separate page vertically',
                    'icon'          => 'fa fa-bars',
                    'id'            => 'section_page_seperator',
                    'data-filter'   => 'general',
                    'visibility'    => 'all',
                    'class'         => array()
                ),
            ),

            'grid'  => array(

                    array(
                        'title'         => 'Grid 1',
                        'description'   => 'Place grid 1',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid1',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 2',
                        'description'   => 'Place grid 2',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid2',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 3',
                        'description'   => 'Place grid 3',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid3',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 4',
                        'description'   => 'Place grid 4',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid4',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 1/5',
                        'description'   => 'Place grid 1/5',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid1_5',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 1/4',
                        'description'   => 'Place grid 1/4',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid1_4',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Grid 1/3',
                        'description'   => 'Place grid 1/3',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid1_3',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Right Sidebar Small',
                        'description'   => 'Right Sidebar Small',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_right_sidebar_small',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Right Sidebar Big',
                        'description'   => 'Right Sidebar Big',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_right_sidebar_big',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                ),

                'element'  => array(

                    array(
                        'title'         => 'Grid 1',
                        'description'   => 'Place grid 1',
                        'icon'          => 'grid1_icon.png',
                        'id'            => 'section_grid_grid1',
                        'data-filter'   => 'grid',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 2',
                        'description'   => 'Place grid 2',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid2',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 3',
                        'description'   => 'Place grid 3',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid3',
                        'data-filter'   => 'grid',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 4',
                        'description'   => 'Place grid 4',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_grid_grid4',
                        'data-filter'   => 'grid',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Right Sidebar Small',
                        'description'   => 'Right Sidebar Small',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_right_sidebar_small',
                        'data-filter'   => 'grid',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Right Sidebar Big',
                        'description'   => 'Right Sidebar Big',
                        'icon'          => 'fa fa-columns',
                        'id'            => 'section_right_sidebar_big',
                        'data-filter'   => 'grid',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
	                array(
		                'title'         => 'Grid 1/5',
		                'description'   => 'Place grid 1/5',
		                'icon'          => 'fa fa-columns',
		                'id'            => 'section_grid_grid1_5',
                    'visibility'    => 'all',
		                'class'         => array()
	                ),
	                array(
		                'title'         => 'Grid 1/4',
		                'description'   => 'Place grid 1/4',
		                'icon'          => 'fa fa-columns',
		                'id'            => 'section_grid_grid1_4',
                    'visibility'    => 'all',
		                'class'         => array()
	                ),
	                array(
		                'title'         => 'Grid 1/3',
		                'description'   => 'Place grid 1/3',
		                'icon'          => 'fa fa-columns',
		                'id'            => 'section_grid_grid1_3',
                    'visibility'    => 'all',
		                'class'         => array()
	                ),


                    array(
                        'title'         => 'Text Block',
                        'description'   => 'A block of text',
                        'icon'          => 'fa fa-outdent',
                        'id'            => 'elements_text_block',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'HTML Block',
                        'description'   => 'Custom HTML for the page',
                        'icon'          => 'fa fa-code',
                        'id'            => 'elements_html_block',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Headline',
                        'description'   => 'A block of headline',
                        'icon'          => 'fa fa-header',
                        'id'            => 'elements_headline',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Sub Headline',
                        'description'   => 'A block of sub headline',
                        'icon'          => 'fa fa-font',
                        'id'            => 'elements_sub_headline',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Paragraph',
                        'description'   => 'A block of paragraph',
                        'icon'          => 'fa fa-paragraph',
                        'id'            => 'elements_paragraph',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Icon',
                        'description'   => 'Icons from library',
                        'icon'          => 'fa fa-star',
                        'id'            => 'elements_icon',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Separator',
                        'description'   => 'Horizontal separator line',
                        'icon'          => 'fa fa-minus',
                        'id'            => 'elements_horizontal_seperator_line',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Separator with Text',
                        'description'   => 'Horizontal seperator with heading',
                        'icon'          => 'elements_horizontal_seperator_text_icon.png',
                        'id'            => 'elements_horizontal_seperator_text',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Single Image',
                        'description'   => 'Single Image Block',
                        'icon'          => 'fa fa-photo',
                        'id'            => 'elements_single_image',
                        'data-filter'   => 'image',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Icon List',
                        'description'   => 'List of items with icon',
                        'icon'          => 'fa fa-star-o',
                        'id'            => 'elements_icon_list',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Image List',
                        'description'   => 'List of items with image',
                        'icon'          => 'fa fa-star-o',
                        'id'            => 'elements_image_list',
                        'data-filter'   => 'image',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Icon Text',
                        'description'   => 'Text with Icon',
                        'icon'          => 'fa fa-star-o',
                        'id'            => 'elements_icon_text',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Button',
                        'description'   => 'Button Block',
                        'icon'          => 'fa fa-stop',
                        'id'            => 'elements_button',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    /*array(
                        'title'         => 'Advance Button',
                        'description'   => 'Advance Button',
                        'icon'          => 'fa fa-stop',
                        'id'            => 'elements_advance_button',
                        'data-filter'   => 'general',
                        'class'         => array()
                    ),*/

                    array(
                        'title'         => 'FAQ',
                        'description'   => 'Faq block',
                        'icon'          => 'fa fa-question',
                        'id'            => 'elements_faq_block',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Empty Container',
                        'description'   => 'Empty Container',
                        'icon'          => 'fa fa-stop',
                        'id'            => 'elements_empty_container',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Space',
                        'description'   => 'Empty Space',
                        'icon'          => 'fa fa-stop',
                        'id'            => 'elements_empty_space',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    /*array(
                        'title'         => 'FAQ',
                        'description'   => 'Faq block',
                        'icon'          => 'fa fa-question',
                        'id'            => 'elements_faq_block',
                        'data-filter'   => 'general',
                        'class'         => array()
                    ),*/

                    array(
                        'title'         => 'Image Text Block',
                        'description'   => 'Text Block with image',
                        'icon'          => 'fa fa-stop',
                        'id'            => 'elements_image_text_block',
                        'data-filter'   => 'image',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Menu Block',
                        'description'   => 'Menu image',
                        'icon'          => 'fa fa-align',
                        'id'            => 'elements_menu_block',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Testimonial',
                        'description'   => 'Testimonial',
                        'icon'          => 'fa fa-star',
                        'id'            => 'elements_testimonial',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Image Inside Tab',
                        'description'   => 'Place Image Inside Tab',
                        'icon'          => 'fa fa-header',
                        'id'            => 'elements_image_inside_tab',
                        'data-filter'   => 'image',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Order 2 Step',
                        'description'   => 'Order in step wise Block',
                        'icon'          => 'elements_order_2_step_icon.png',
                        'id'            => 'elements_order_2_step',
                        'data-filter'   => 'order',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Stepped Contact Form',
                        'description'   => 'Stepped Contact information form',
                        'icon'          => 'fa fa-id-card-o',
                        'id'            => 'elements_contact_info_form',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Stepped Shipping Form',
                        'description'   => 'Contact Shipping info form',
                        'icon'          => 'fa fa-id-card-o',
                        'id'            => 'elements_stepd_shipping_info_form',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Stepped Billing Form',
                        'description'   => 'Billing info form',
                        'icon'          => 'fa fa-id-card-o',
                        'id'            => 'elements_stepd_billing_info_form',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Stepped Payment Form',
                        'description'   => 'Payment info form',
                        'icon'          => 'fa fa-id-card-o',
                        'id'            => 'elements_stepd_payment_info_form',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Customer Information',
                        'description'   => 'Contact information, email only',
                        'icon'          => 'fa fa-address-book',
                        'id'            => 'elements_customer_information_icon',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Shipping Address',
                        'description'   => 'Shipping address Form',
                        'icon'          => 'fa fa-address-card',
                        'id'            => 'elements_shipping_address',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Billing Address',
                        'description'   => 'Billing address Form',
                        'icon'          => 'fa fa-address-card',
                        'id'            => 'elements_billing_address',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Payment Method',
                        'description'   => 'Payment method Form',
                        'icon'          => 'fa fa-credit-card',
                        'id'            => 'elements_payment_method',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Card/PayPal Payment',
                        'description'   => 'Payment using both Card and Paypal',
                        'icon'          => 'fa fa-cc-paypal',
                        'id'            => 'elements_paypal_payment_method',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),


                    array(
                        'title'         => 'Shipping Method',
                        'description'   => 'Shipping method Form',
                        'icon'          => 'fa fa-truck',
                        'id'            => 'elements_shipping_method',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),


                    array(
                        'title'         => 'Discount',
                        'description'   => 'Coupon system',
                        'icon'          => 'fa fa-star',
                        'id'            => 'elements_coupon_system',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Cart',
                        'description'   => 'Product cart',
                        'icon'          => 'fa fa-cart-arrow-down',
                        'id'            => 'elements_product_cart',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order,confirmation',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Cart Without Shipping',
                        'description'   => 'Product cart without shipping details',
                        'icon'          => 'fa fa-cart-arrow-down',
                        'id'            => 'elements_step_product_cart',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order,confirmation',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Shipping Form',
                        'description'   => 'Shipping information Form',
                        'icon'          => 'fa fa-address-card',
                        'id'            => 'elements_shipping_form',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Card Details Form',
                        'description'   => 'Card details form',
                        'icon'          => 'fa fa-address-card',
                        'id'            => 'elements_card_details',
                        'data-filter'   => 'forms',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    /*array(
                        'title'         => 'Product Selection',
                        'description'   => 'Product selection',
                        'icon'          => 'fa fa-cubes',
                        'id'            => 'elements_product_selection',
                        'data-filter'   => 'product',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Purchased',
                        'description'   => 'Product list of purchased',
                        'icon'          => 'fa fa-cubes',
                        'id'            => 'elements_product_purchased',
                        'data-filter'   => 'product',
                        'class'         => array()
                    ),*/


                    /*array(
                        'title'         => 'Order Form Type 1',
                        'description'   => 'Type 1 order form',
                        'icon'          => 'elements_order_form_one_icon.png',
                        'id'            => 'elements_order_form_one',
                        'class'         => array()
                    ),*/

                    array(
                        'title'         => 'Date Countdown',
                        'description'   => 'Date countdown',
                        'icon'          => 'fa fa-calendar',
                        'id'            => 'elements_date_countdown',
                        'data-filter'   => 'general',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Embed Video',
                        'description'   => 'Embed video',
                        'icon'          => 'fa fa-youtube-play',
                        'id'            => 'elements_embed_video',
                        'data-filter'   => 'video',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Select Box',
                        'description'   => 'Dropdown box',
                        'icon'          => 'fa fa-square-o',
                        'id'            => 'elements_select_box',
                        'data-filter'   => 'forms',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Text Field',
                        'description'   => 'Input text field',
                        'icon'          => 'fa fa-square-o',
                        'id'            => 'elements_input_field',
                        'data-filter'   => 'forms',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    /*array(
                        'title'         => 'Textarea',
                        'description'   => 'Textarea',
                        'icon'          => 'fa fa-square-o',
                        'id'            => 'elements_textarea',
                        'data-filter'   => 'forms',
                        'class'         => array()
                    ),*/

                    /*array(
                        'title'         => 'Pricing Table',
                        'description'   => 'Pricing table',
                        'icon'          => 'fa fa-th-large',
                        'id'            => 'elements_pricing_table',
                        'data-filter'   => 'general',
                        'class'         => array()
                    ),*/

                    array(
                        'title'         => 'Social Share Button',
                        'description'   => 'Advance Social share button',
                        'icon'          => 'elements_social_share_button.png',
                        'id'            => 'elements_social_share_button',
                        'data-filter'   => 'social',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Social Share',
                        'description'   => 'Social share icons',
                        'icon'          => 'elements_social_share_icon.png',
                        'id'            => 'elements_social_share',
                        'data-filter'   => 'social',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 1',
                        'description'   => 'Place grid 1',
                        'icon'          => 'grid1_icon.png',
                        'id'            => 'product_grid_grid1',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 2',
                        'description'   => 'Place grid 2',
                        'icon'          => 'grid2_icon.png',
                        'id'            => 'product_grid_grid2',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Image',
                        'description'   => 'Product\'s main image',
                        'icon'          => 'fa fa-file-image-o',
                        'id'            => 'section_product_main_image',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Title',
                        'description'   => 'Title for the poduct',
                        'icon'          => 'fa fa-text-width',
                        'id'            => 'section_product_title',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Description',
                        'description'   => 'Description for the poduct',
                        'icon'          => 'fa fa-newspaper-o',
                        'id'            => 'section_product_description',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product varients',
                        'description'   => 'Options for product',
                        'icon'          => 'fa fa-building',
                        'id'            => 'section_product_varients',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Price',
                        'description'   => 'Price for product',
                        'icon'          => 'fa fa-money',
                        'id'            => 'section_product_price',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Availability',
                        'description'   => 'Product availability status',
                        'icon'          => 'fa fa-cube',
                        'id'            => 'section_product_availability',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    /*array(
                        'title'         => 'Product Add',
                        'description'   => 'Advertise a product',
                        'icon'          => 'fa fa-cube',
                        'id'            => 'section_product_add',
                        'data-filter'   => 'product',
                        'class'         => array()
                    ),*/





                    array(
                        'title'         => 'Order Info',
                        'description'   => 'Information of the order',
                        'icon'          => 'fa fa-file-text',
                        'id'            => 'section_order_info',
                        'data-filter'   => 'order',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Order Acton',
                        'description'   => 'Actions of the order',
                        'icon'          => 'fa fa-file-text',
                        'id'            => 'section_order_action',
                        'data-filter'   => 'order',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Order Address Details',
                        'description'   => 'Address details of the order',
                        'icon'          => 'fa fa-file-text',
                        'id'            => 'section_order_address_details',
                        'data-filter'   => 'order',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),
                    array(
                        'title'         => 'Order Bump',
                        'description'   => 'Order Bump',
                        'icon'          => 'fa fa-money',
                        'id'            => 'section_order_bump',
                        'data-filter'   => 'order',
                        'visibility'    => 'order',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Quantity',
                        'description'   => 'Product\'s quantity',
                        'icon'          => 'fa fa-sort-numeric-asc',
                        'id'            => 'section_product_quantity',
                        'data-filter'   => 'product',
                        'visibility'    => 'product,upsell,downsell',
                        'class'         => array()
                    ),
                ),

                'product'   => array(
                    array(
                        'title'         => 'Grid 1',
                        'description'   => 'Place grid 1',
                        'icon'          => 'grid1_icon.png',
                        'id'            => 'product_grid_grid1',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Grid 2',
                        'description'   => 'Place grid 2',
                        'icon'          => 'grid2_icon.png',
                        'id'            => 'product_grid_grid2',
                        'visibility'    => 'all',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Image',
                        'description'   => 'Product\'s main image',
                        'icon'          => 'product_main_image.png',
                        'id'            => 'section_product_main_image',
                        'data-filter'   => 'image',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Title',
                        'description'   => 'Title for the product',
                        'icon'          => 'product_title.png',
                        'id'            => 'section_product_title',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Description',
                        'description'   => 'Description for the product',
                        'icon'          => 'product_description.png',
                        'id'            => 'section_product_description',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product variants',
                        'description'   => 'Options for product',
                        'icon'          => 'product_varients.png',
                        'id'            => 'section_product_varients',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),

                    array(
                        'title'         => 'Product Price',
                        'description'   => 'Price for product',
                        'icon'          => 'product_price.png',
                        'id'            => 'section_product_price',
                        'visibility'    => 'product,order,upsell,downsell',
                        'class'         => array()
                    ),
                ),

    );

    public function getWidgets() {
        return $this->widgets;
    }

    public function getWidget($name) {
        return $this->widgets[$name];
    }

    public function getWidgetNames() {

        $widgetNames = array();

        foreach ( $this->widgets as $key=>$widget ) {
            $widgetNames[] = $key;
        }

        return $widgetNames;
    }
}
