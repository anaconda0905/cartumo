<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use Dompdf\Exception;
use Illuminate\Http\Request;

use App\Models\Funnel;
use App\Models\Order;
use App\Models\Page;
use App\Models\OrderDetail;
use App\Models\PageVisitor;
use App\Models\OrderCustomer;

use Carbon\Carbon;

use Auth;
use DB;

class DashboardController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$data    = array();
		$monthes = array(
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"october",
			"November",
			"December"
		);

		$data['total_funnels'] = Funnel::where( 'user_id', Auth::id() )->count();
		$orders                = Order::where( 'user_id', Auth::id() )->orderBy( 'id', 'desc' )->get();
		$data['total_orders']  = $orders->count();
		//$data['total_visitors'] = PageVisitor::all()->groupBy('ip_address')->count();

		//DB::enableQueryLog();

		//get customers
		$customers        = array();
		$recent_customers = array();

		foreach ( $orders as $k => $order ) {
			$orderDetails = OrderDetail::where( 'order_id', $order->id )->first();
			$details      = json_decode( $orderDetails->details )->order;
			//echo '<pre>'; print_r($details);

			if ( ! empty( $details->info ) ) {
				$customers[] = $details->info->customer->email;
			} else {
				if ( ! empty( $details->shopify ) ) {
					$customers[] = $details->shopify->customer->email;
				}
			}


			$orderCustomer = OrderCustomer::where( 'order_id', $order->id )
			                              ->first();
			if ( ! empty( $orderCustomer ) ) {
				$recent_customers[] = array(
					'email' => $orderCustomer->email,
					'name'  => $orderCustomer->customer_name
				);
			}
		}


		//die;

		$data['customers']              = array_unique( $customers );
		$data['recent_customers']       = $recent_customers;
		$data['top_customers']          = $this->getTopCustomers();
		$data['top_products']           = $this->getTopProducts();
		$data['top_products_sell_rank'] = $this->getProductTypeSellPercentages();

		$data['total_visitors'] = PageVisitor::select( 'page_visitors.ip_address' )
		                                     ->join( 'pages', 'pages.id', 'page_visitors.page_id' )
		                                     ->join( 'funnels', 'funnels.id', 'pages.funnel_id' )
		                                     ->where( 'funnels.user_id', Auth::id() )
		                                     ->groupBy( 'page_visitors.ip_address' )
		                                     ->get()->count();

		//dd(DB::getQueryLog()); die;

		//Total Sales
		$sales = Order::select( 'id', 'amount', 'created_at' )
					  ->where( 'user_id', Auth::user()->id )
		              ->get();

		$data['total_sales'] = 0.00;
		$total_sales         = 0.0;
		foreach ( $sales as $sale ) {

			$total_sales += $sale->amount;
		}

		//$data['total_sales'] = $total_sales;
		$data['total_sales'] = number_format( $total_sales, 2 );

		/*$salesOrders = DB::select(
			"SELECT DATE_FORMAT(`created_at`,'%Y-%m') AS `created_at` FROM `orders` WHERE `user_id`=? GROUP BY DATE_FORMAT(created_at,'%Y-%m')",
			[ Auth::id() ]
		);*/

		/*$dateS       = Carbon::now()->startOfMonth()->subMonth( 6 );
		$dateE       = Carbon::now()->startOfMonth();*/
		/*$salesOrders = DB::table( 'orders' )
		                 ->where( [ 'user_id' => Auth::id() ] )
		                 ->where( 'created_at', '>=', Carbon::now()->startOfMonth() )
						 ->get();*/

		/*$salesOrders = DB::table( 'orders' )
						 ->select(DB::raw("SUM(`amount`) AS `total`") )
		                 ->where( 'user_id', Auth::id() )
						 ->where( 'created_at', '>=', Carbon::now()->startOfMonth() )
						 ->groupBy(DB::raw('DATE(created_at)'))
						 ->get();*/

		$salesOrders = DB::table( 'orders' )
						 ->select(DB::raw("SUM(`amount`) AS `total`, DATE(created_at) AS date") )
		                 ->where( 'user_id', Auth::id() )
						 ->where( 'created_at', '>=', Carbon::now()->startOfMonth() )
						 ->groupBy(DB::raw('DATE(created_at)'))
		                 ->get();

		//echo '<pre>'; print_r($salesOrders); die;


		$order_counts = [];
		$orderArray   = [];
		$orderSales   = [];

		$total_sales_amount = array();
		foreach ( $salesOrders as $key => $order ) {
			$total_sales_amount[ date( 'd', strtotime( $order->date ) ) ] = $order->total;
		}

		//echo '<pre>'; print_r($total_sales_amount); die;

		$sales_chart_data = array();

		//echo date("t"); die;

		foreach ( range( 0, intval( date( "t" ) ) ) as $k => $date_day ) {

			if ( $date_day < 10 ) {
				$date_day = '0' . $date_day;
			}

			if ( empty( $total_sales_amount[ $date_day ] ) ) {
				$sales_chart_data[ $date_day ] = 0;
			} else {
				$sales_chart_data[ $date_day ] = floatval( $total_sales_amount[ $date_day ] );
			}

			//echo $date_day . '<br>';
		}

		//echo intVal(date('m')) - 6; die;
		//$sales_chart_data = array_slice( $sales_chart_data, intVal( date( 'm' ) ), intVal( date( 'm' ) ) - 5 );
		//$sales_chart_data = array_splice( $sales_chart_data, 0, 8 );
		//echo '<pre>'; print_r($sales_chart_data); die;

		//echo '<pre>'; print_r($sales_chart_data); die;
		$last_six_months = array();
		for ( $j = 6; $j >= 0; $j -- ) {
			$last_six_months[] = date( "F", strtotime( " -$j month" ) );
		}

		$data['monthes']          = $last_six_months;
		$data['orders_by_months'] = $sales_chart_data;
		$data['top_funnels']      = $this->getTopSalesFunnels();

		//echo '<pre>'; print_r($last_six_months);
		//echo '<pre>'; print_r($data['orders_by_months']); die;

		//echo '<pre>'; print_r($data['monthes']); die;
		//echo '<pre>'; print_r($sales_chart_data); die;
		//echo '<pre>'; print_r($last_six_months_sales); die;

		return view( 'dashboard' )->withData( $data );
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
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}


	/*private function getTopSalesFunnels() {

		$funnels = Funnel::where( 'user_id', Auth::id() )->get();

		foreach ( $funnels as $funnel ) {

			$total_sales = 0.00;
			$funnelPages = Page::where( 'funnel_id', $funnel->id )->get();
			foreach ( $funnelPages as $funnel_page ) {

				$orderDetails = OrderDetail::select( 'details' )->where( 'order_id', $funnel_page->id )->first();
				//print_r($orderDetails->details); die;

				$order_details = json_decode( $orderDetails );
				if ( ! empty( $order_details->details ) ) {
					$json_details = json_decode( $order_details->details );
					$details      = $json_details->order;

					if ( ! empty( $details->info ) ) {
						$total_sales += floatVal( $details->info->total_amount );
					} else {
						if ( ! empty( $details->shopify ) ) {
							$total_sales += floatVal( $details->shopify->amount );
						} else {
							if ( ! empty( $details->stripe ) ) {
								$total_sales += floatVal( $details->stripe->total_amount );
							} else {
								$total_sales += floatVal( $details->paypal->amount );
							}
						}
					}
				}
			}

			//funnel sales
			if ( $total_sales > 0 ) {
				$funnel_sales[] = array(
					'funnel_id'   => $funnel->id,
					'funnel_name' => $funnel->name,
					'funnel_type' => $funnel->type,
					'sales'       => $total_sales
				);
			} else {
				$funnel_sales = array();
			}
		}

		if ( ! empty( $funnel_sales ) ) {
			usort( $funnel_sales, function ( $a, $b ) {
				return $a['sales'] - $b['sales'];
			} );

			return array_reverse( $funnel_sales );
		}

		return false;
	}*/

	private function getTopSalesFunnels() {

		/*$orderProducts = OrderProducts::select('orders.id', 'orders.user_id', 'orders.page_id')
										->leftJoin("orders", "orders.id", "order_products.order_id")
										->leftJoin("users", "users.id", "orders.user_id")
										->orderBy("orders.id", "DESC")
										->where("users.id", Auth::id())
										->get();

		echo '<pre>';
		print_r( $orderProducts->toArray() );
		die;*/

		$orderedFunnels = Funnel::select("funnels.id", "funnels.type", "funnels.name", DB::raw("SUM(orders.amount) AS total_amount"))
						 ->leftJoin("pages", "pages.funnel_id", "funnels.id")
						 ->leftJoin("orders", "orders.page_id", "pages.id")
						 ->where("funnels.user_id", Auth::id())
						 ->groupBy("funnels.id", "funnels.name", "funnels.type")
						 ->orderBy(DB::raw("SUM(orders.amount)"), "DESC")
						 ->get();

		/*echo '<pre>';
		print_r( $orderedFunnels->toArray() );
		die;*/

		return $orderedFunnels;
	}


	private function getTopCustomers() {

		$customerOrders = OrderCustomer::select( 'order_customers.customer_name', 'orders.customer_email', DB::raw( 'count(orders.customer_email) as total' ) )
		                               ->leftJoin( "orders", "orders.customer_email", "order_customers.email" )
		                               ->where( 'orders.user_id', Auth::id() )
		                               ->groupBy( "orders.customer_email", "order_customers.customer_name" )
		                               ->orderBy( "total", "DESC" )
		                               ->limit( 5 )
		                               ->get();

		/*echo '<pre>';
		print_r( $customerOrders );
		die;*/

		return $customerOrders;
	}


	private function getTopProducts() {

		$orderedProduct = OrderProducts::select( 'order_products.product_name', 'order_products.product_type', DB::raw( 'count(order_products.product_id) as total' ) )
		                               ->leftJoin( "orders", "orders.id", "order_products.order_id" )
		                               ->where( 'orders.user_id', Auth::id() )
		                               ->groupBy( "order_products.product_id", "order_products.product_type", "order_products.product_name" )
		                               ->orderBy( "total", "DESC" )
									   ->limit( 5 )
									   //->having(DB::raw('COUNT(order_products.product_id) = MAX(order_products.product_id)'))
		                               ->get();

		//echo '<pre>'; print_r($orderedProduct); die;

		return $orderedProduct;
	}


	private function getProductTypeSellPercentages() {

		$orderedProducts = OrderProducts::select( 'order_products.product_type', DB::raw( 'count(order_products.product_type) as total' ) )
		                                ->leftJoin( "orders", "orders.id", "order_products.order_id" )
		                                ->where( 'orders.user_id', Auth::id() )
		                                ->groupBy( "order_products.product_type" )
		                                ->orderBy( "order_products.product_type" )
		                                ->get();

		$total_sell = OrderProducts::select( 'order_products.product_type', DB::raw( 'count(order_products.product_type) as total' ) )
		                                             ->leftJoin( "orders", "orders.id", "order_products.order_id" )
		                                             ->where( 'orders.user_id', Auth::id() )
													 ->count();

		$percentages = array();

		//echo '<pre>'; print_r( $orderedProducts ); die;

		foreach ( $orderedProducts as $product ) {

			$percentages[$product->product_type] = round(number_format(($product->total / $total_sell) * 100, 2));
		}

		//echo $total_sell; die;
		/*echo '<pre>';
		print_r( $percentages );
		die;*/

		return $percentages;
	}
}
