<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );

require_once __DIR__ . '/shortcodes/related-cat.php';
require_once __DIR__ . '/shortcodes/related-post.php';
require_once __DIR__ . '/shortcodes/cat-image.php';
require_once __DIR__ . '/shortcodes/cat-title.php';
require_once __DIR__ . '/shortcodes/cat-random.php';
require_once __DIR__ . '/shortcodes/faq.php';
require_once __DIR__ . '/shortcodes/prefooter-banner.php';

function add_gtag_js_to_header() {
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16593603934"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-16593603934');
      gtag('config', 'AW-16513096685');
    </script>
    <?php
}
add_action('wp_head', 'add_gtag_js_to_header');

function add_gtag_conversion_tracking() {
    if (is_order_received_page()) {
        $order_id = get_query_var('order-received');
        ?>
        <script>
          gtag('event', 'conversion', {
            'send_to': 'AW-16593603934/3IlbCJaHqsUZEN6aueg9',
            'transaction_id': '<?php echo esc_js($order_id); ?>'
          });
        </script>
        <?php
    }
}
add_action('wp_head', 'add_gtag_conversion_tracking');

// Wholesale Order Seperator & Filter
add_action('woocommerce_checkout_update_order_meta', 'add_wholesale_order_meta');
function add_wholesale_order_meta($order_id) {
    $user = wp_get_current_user();
    if (in_array('default_wholesaler', $user->roles)) {
        update_post_meta($order_id, 'is_wholesale_order', '1');
    }
}

add_filter('manage_edit-shop_order_columns', 'add_wholesale_order_column');
function add_wholesale_order_column($columns) {
    $new_columns = array();
    foreach ($columns as $column_name => $column_info) {
        $new_columns[$column_name] = $column_info;
        if ('order_status' === $column_name) {
            $new_columns['is_wholesale_order'] = __('Wholesale', 'woocommerce');
        }
    }
    return $new_columns;
}

add_action('manage_shop_order_posts_custom_column', 'show_wholesale_order_column');
function show_wholesale_order_column($column) {
    global $post;
    if ('is_wholesale_order' === $column) {
        $is_wholesale = get_post_meta($post->ID, 'is_wholesale_order', true);
        if ($is_wholesale) {
            echo '<span class="wholesale-order">'.__('Yes', 'woocommerce').'</span>';
        } else {
            echo '<span class="regular-order">'.__('No', 'woocommerce').'</span>';
        }
    }
}
// End of Wholesale Order Seperator & Filter


// Add a new filter for wholesale orders
add_filter('views_edit-shop_order', 'add_wholesale_orders_view');
function add_wholesale_orders_view($views) {
    $wholesale_orders_count = get_wholesale_orders_count();
    $class = (isset($_GET['wholesale_orders']) && $_GET['wholesale_orders'] == 1) ? 'current' : '';
    $views['wholesale_orders'] = sprintf(
        '<a href="%s" class="%s">%s <span class="count">(%d)</span></a>',
        esc_url(add_query_arg('wholesale_orders', '1', admin_url('edit.php?post_type=shop_order'))),
        $class,
        __('Wholesale', 'woocommerce'),
        $wholesale_orders_count
    );
    return $views;
}

// Get the count of wholesale orders
function get_wholesale_orders_count() {
    $args = array(
        'post_type' => 'shop_order',
        'post_status' => 'any',
        'meta_key' => 'is_wholesale_order',
        'meta_value' => '1',
        'posts_per_page' => -1,
    );
    $wholesale_orders = new WP_Query($args);
    return $wholesale_orders->post_count;
}


// Filter the orders by wholesale orders
add_filter('pre_get_posts', 'filter_wholesale_orders');
function filter_wholesale_orders($query) {
    global $typenow;
    if ('shop_order' !== $typenow || !$query->is_main_query()) {
        return;
    }
    if (isset($_GET['wholesale_orders']) && $_GET['wholesale_orders'] == 1) {
        $query->set('meta_key', 'is_wholesale_order');
        $query->set('meta_value', '1');
    }
}



// //When a wholesale user adds items to their shopping cart and goes to check out, the system recognizes their wholesale status and automatically exempts them from any tax charges. This function only affects wholesale users; all other users will still be charged tax according to the existing tax rules.
// function wholesale_tax_exempt( $cart ) {
//     if ( current_user_can( 'default_wholesaler' ) ) {
//         WC()->customer->set_is_vat_exempt( true );
//     }
// }

// add_action( 'woocommerce_before_calculate_totals', 'wholesale_tax_exempt', 10 );

function check_shipping_address() {
    // Get the shipping address entered by the customer
    $shipping_address = WC()->customer->get_shipping_address_1() . ' ' . WC()->customer->get_shipping_address_2();

    // Check if the address matches a PO Box format
    if (preg_match('/^(p\.?\s*o\.?\s*(box|bin|bin #|box #|box no|drawer|drawers|lock box|pb|post box)|post office box)/i', $shipping_address)) {
        // Display only the USPS shipping rate
        ?>
        <script>
            jQuery(document).ready(function($) {
                // Hide all other shipping methods
                jQuery('input.shipping_method').not('#shipping_method_0_flexible_shipping_usps161').closest('li').hide();

                // Select the USPS shipping method
                jQuery('#shipping_method_0_flexible_shipping_usps161').prop('checked', true);
            });
        </script>
        <?php
    } else {
        // Display all shipping rates
        ?>
        <script>
            jQuery(document).ready(function($) {
                // Show all shipping methods
                jQuery('input.shipping_method').closest('li').show();
            });
        </script>
        <?php
    }
}
add_action('woocommerce_review_order_before_shipping', 'check_shipping_address');


/**
 * Add role filter dropdown.
 * 
 * Add the dropdown that shows the roles to filter orders by.
 */
function js_shop_order_user_role_filter() {

	global $typenow, $wp_query;

	if ( in_array( $typenow, wc_get_order_types( 'order-meta-boxes' ) ) ) {
		$user_role	= '';

		// Get all user roles
		$user_roles = array( 'guest' => 'Guest' );
		foreach ( get_editable_roles() as $key => $values ) {
			$user_roles[ $key ] = $values['name'];
		}

		// Set a selected user role
		if ( ! empty( $_GET['_user_role'] ) ) {
			$user_role	= sanitize_text_field( $_GET['_user_role'] );
		}

		// Display drop down
		?><select name='_user_role'>
			<option value=''><?php _e( 'Select a user role', 'woocommerce' ); ?></option><?php
			foreach ( $user_roles as $key => $value ) :
				?><option <?php selected( $user_role, $key ); ?> value='<?php echo $key; ?>'><?php echo $value; ?></option><?php
			endforeach;
		?></select><?php
	}

}
add_action( 'restrict_manage_posts', 'js_shop_order_user_role_filter' );


/**
 * Filter orders by role.
 * 
 * Add the parameters that filters the query by user role.
 * Filtering is done by getting the user IDs that have a specific role and filtering
 * the order by those user IDs.
 * 
 * @param $query
 */
function js_shop_order_user_role_posts_where( $query ) {

	if ( ! $query->is_main_query() || empty( $_GET['_user_role'] ) || $_GET['post_type'] !== 'shop_order' ) {
		return;
	}

	if ( $_GET['_user_role'] != 'guest' ) {
		$ids = get_users( array( 'role' => sanitize_text_field( $_GET['_user_role'] ), 'fields' => 'ID' ) );
		$ids = array_map( 'absint', $ids );
	} else {
		$ids = array( 0 );
	}

	$query->set( 'meta_query', array(
		array(
			'key' => '_customer_user',
			'compare' => 'IN',
			'value' => $ids,
		)
	) );

	if ( empty( $ids ) ) {
		$query->set( 'posts_per_page', 0 );
	}
}
add_filter( 'pre_get_posts', 'js_shop_order_user_role_posts_where' );


//Custom Admin Search bar
function add_global_search_field($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'global-search-field',
        'title' => '<input type="text" id="global-search-input" placeholder="Search Orders..."><button id="global-search-button">Search</button>',
        'meta'  => array(
            'title' => __('Global Search'),
        ),
    ));
}
add_action('admin_bar_menu', 'add_global_search_field', 100);

// Add an event listener to the search button
function handle_global_search() {
    echo "
    <script>
        var searchField = document.getElementById('global-search-input');
        var searchButton = document.getElementById('global-search-button');

        var searchFunction = function() {
            var canEditShopOrders = ". (current_user_can('edit_shop_orders') ? 'true' : 'false') .";
            var canListUsers = ". (current_user_can('list_users') ? 'true' : 'false') .";
            var canEditProducts = ". (current_user_can('edit_products') ? 'true' : 'false') .";

            if (/\\d{5,}/.test(searchField.value)) {
                // If the input has 5 or more digits, assume it's an order ID
                if (!canEditShopOrders) {
                    alert('You do not have the required permissions to view orders.');
                    return;
                }

                window.location.href = '/wp-admin/edit.php?s='+searchField.value+'&post_type=shop_order';
            } else if (searchField.value.startsWith('#AG-') || searchField.value.startsWith('AG-')) {
                if (!canEditShopOrders) {
                    alert('You do not have the required permissions to view orders.');
                    return;
                }
                
                var orderId = searchField.value.replace('#AG-', '').replace('AG-', ''); 
                window.location.href = '/wp-admin/edit.php?s='+orderId+'&post_type=shop_order';
            } else if (searchField.value.includes(' ')) {
                if (!canListUsers) {
                    alert('You do not have the required permissions to view users.');
                    return;
                }
                
                window.location.href = '/wp-admin/users.php?s='+searchField.value;
            } else if (searchField.value.startsWith('AG')) {
                if (!canEditProducts) {
                    alert('You do not have the required permissions to view products.');
                    return;
                }
                
                window.location.href = '/wp-admin/edit.php?s='+searchField.value+'&post_type=product';
            }
        };

        // Listen for Enter key on the search field
        searchField.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                searchFunction();
            }
        });

        // Listen for click on the search button
        searchButton.addEventListener('click', function(event) {
            event.preventDefault();
            searchFunction();
        });
    </script>
    ";
}
add_action('admin_footer', 'handle_global_search');

add_filter('wf_pklist_alter_additional_fields','wf_pklist_add_customer_note_invoice',10,3);
function wf_pklist_add_customer_note_invoice($extra_fields,$template_type,$order)
{
	if($template_type=='invoice')
	{
		$cust_note=$order->get_customer_note();
		if(!empty($cust_note))
		{
			$extra_fields['cus_note']=$cust_note;	
		}
	}
	return $extra_fields;
}
add_filter( 'wpo_get_item_by_product', function($item, $item_data,$product){
	$user_id = $_REQUEST["cart"]["customer"]["id"];
	if( !$user_id ) return $item; // customer not selected

	$data = $product->get_meta("wholesale_multi_user_pricing");
	if( !$data ) return $item; // no wholesale prices at all

	$role_id = get_current_user_role_id();
	if( !isset($data[$role_id]) ) return $item; // no wholesale prices for user role

	$rule = $data[ $role_id ];
	//variation ??
	if( isset($rule[$product->get_id()]) ) {
		$rule['wholesale_price'] = $rule[$product->get_id()]['wholesaleprice'];
		$rule['qty'] = $rule[$product->get_id()]['qty'];
	}

	if($rule["discount_type"] == "fixed") {
		$item["item_cost"] = $rule["wholesale_price"];
	} else {// %% ?
		$price = $product->get_price();
		$item["item_cost"] =  round( $price * (100-$rule["wholesale_price"])/100, 2);
	}

	return $item;
},10,3);

add_filter("wpo_prepare_item", function($item,$product){
	if( @$item['cost_updated_manually'] ) return $item;// edited via UI ?

	// set default cost
	$item["item_cost"] = $item["wpo_item_discount"]["discounted_price"] = $item["wpo_item_discount"]["original_price"] = $product->get_price();
	$item["wpo_item_discount"]["discount"] = 0; // no discount!

	$user_id = $_REQUEST["cart"]["customer"]["id"];
	if( !$user_id ) return $item; // customer not selected

	$data = $product->get_meta("wholesale_multi_user_pricing");
	if( !$data ) return $item; // no wholesale prices at all

	$role_id = get_current_user_role_id();
	if( !isset($data[$role_id]) ) return $item; // no wholesale prices for user role

	$rule = $data[ $role_id ];
	//variation ??
	if( isset($rule[$product->get_id()]) ) {
		$rule['wholesale_price'] = $rule[$product->get_id()]['wholesaleprice'];
		$rule['qty'] = $rule[$product->get_id()]['qty'];
	}

	if( isset ($rule['qty']) AND ($item['qty'] < $rule['qty']) ) return $item; // too few items

	$item["wpo_item_discount"]["discount_type"] = $rule["discount_type"];
	//calc it once
	if($rule["discount_type"] == "fixed") {
		$item["wpo_item_discount"]["discount"] = round($item["wpo_item_discount"]["original_price"] - $rule["wholesale_price"],2);
		$item["item_cost"] = $item["wpo_item_discount"]["discounted_price"] = $rule["wholesale_price"];
	} else {// %% ?
		$item["wpo_item_discount"]["discount"] = $discount = round($item["wpo_item_discount"]["original_price"] * $rule["wholesale_price"]/100,2);
		$item["item_cost"] = $item["wpo_item_discount"]["discounted_price"] = $item["wpo_item_discount"]["original_price"] - $discount;
	}
	return $item;
},10,2);

function custom_admin_footer_script() {
    if (is_admin() && isset($_GET['post']) && get_post_type($_GET['post']) == 'shop_order') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Uncheck the 'Restock refunded items' checkbox by default
                $('#restock_refunded_items').prop('checked', false);
            });
        </script>
        <?php
    }
}
add_action('admin_footer', 'custom_admin_footer_script');

function get_wholesale_orders($paged = 1, $posts_per_page = 20) {
    $args = array(
        'post_type'      => 'shop_order',
        'post_status' => 'any',
        'meta_key' => 'is_wholesale_order',
		 'meta_value' => '1',
        'paged'          => $paged,
        'posts_per_page' => $posts_per_page,
    );

    $orders = new WP_Query($args);

    return $orders;
}
function display_wholesale_orders_report() {
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $orders = get_wholesale_orders($paged);
	add_export_button();
	
	 if ($orders->have_posts()) {
		echo '<table class="wp-list-table widefat fixed striped table-view-list wholesale_order_table">';
		echo '<thead><tr>';
		echo '<th>' . __('Order ID', 'wholesale-orders-report') . '</th>';
		echo '<th>' . __('Customer Name', 'wholesale-orders-report') . '</th>';
		echo '<th>' . __('Date', 'wholesale-orders-report') . '</th>';
		echo '<th>' . __('Status', 'wholesale-orders-report') . '</th>';
		echo '<th>' . __('Total Price', 'wholesale-orders-report') . '</th>';
		echo '</tr></thead>';
		echo '<tbody>';
	
		while ($orders->have_posts()) {
			$orders->the_post();
			
			$order = wc_get_order(get_the_ID());
			 $order_id = get_the_ID();
       		$order_edit_link = get_edit_post_link($order_id);
			$customer_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
			$order_date = $order->get_date_created()->date('Y-m-d H:i:s');
			$order_status = wc_get_order_status_name($order->get_status());
			$order_status_loweer = strtolower($order_status);
			$order_status_name = wc_get_order_status_name($order_status);
			$total_price = $order->get_total();
  			$total_sales += $total_price; // Accumulate total sales
			echo '<tr>';
			echo '<td><a href="' . esc_url($order_edit_link) . '" target="_blank">' . esc_html($order_id) . '</a></td>';
			echo '<td>' . esc_html($customer_name) . '</td>';
			echo '<td>' . esc_html($order_date) . '</td>';
			echo '<td class="order_status column-order_status"><mark class="order-status status-' . esc_attr($order_status_loweer) . ' tips">' . esc_html($order_status_name) . '</span></mark></td>';
			echo '<td>' . wc_price($total_price) . '</td>';
			echo '</tr>';
		}

		echo '</tbody></table>';

		 // Default WordPress Pagination
		 $total_pages = $orders->max_num_pages;
        $base_url = admin_url('admin.php?page=wholesale-orders-report');
		 echo '<div class="ct-wholesale-order"><div class="tablenav pagination"><div class="tablenav-pages">';
		 echo '<span class="displaying-num">' . sprintf(__('Showing %s items', 'wholesale-orders-report'), $orders->found_posts) . '</span>';
		 echo paginate_links(array(
            'base'      => add_query_arg('paged', '%#%', $base_url),
            'format'    => '',
            'current'   => max(1, $paged),
            'total'     => $total_pages,
            'add_args'  => false, // Ensures the 'paged' parameter is correctly added to the URL
            'prev_text' => __('&laquo; Previous', 'wholesale-orders-report'),
            'next_text' => __('Next &raquo;', 'wholesale-orders-report'),
        ));
		
        echo '</div></div></div>';
	} else {
		echo '<p>' . __('No wholesale orders found', 'wholesale-orders-report') . '</p>';
	}

}


function export_wholesale_orders() {

    if (isset($_GET['export_wholesale_orders'])) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=wholesale-orders.csv');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Order ID', 'Customer Name', 'Date', 'Order Status', 'Total Price'));

        $orders = get_wholesale_orders(1, -1);
        while ($orders->have_posts()) {
            $orders->the_post();
            $order = wc_get_order(get_the_ID());
            $customer_name = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
			$order_date = $order->get_date_created()->date('Y-m-d H:i:s');
			$order_status = wc_get_order_status_name($order->get_status());
            $total_price = $order->get_total();

            fputcsv($output, array(get_the_ID(), $customer_name, $order_date, $order_status, $total_price));
        }

        fclose($output);
        exit;
    }
}

// add_action('admin_init', 'export_wholesale_orders');

function add_export_button() {
    echo '<a href="' . esc_url(add_query_arg('export_wholesale_orders', '1')) . '" class="button-primary" style="margin-bottom:20px">' . __('Export Orders', 'your-text-domain') . '</a>';
}


function wholesale_orders_report_menu() {
    add_menu_page(
        __('Wholesale Orders Report', 'woodmart'),
        __('Wholesale Orders', 'woodmart'),
        'manage_woocommerce',
        'wholesale-orders-report',
        'display_wholesale_orders_report',
        'dashicons-chart-line',
        56
    );
}

//add_action('admin_menu', 'wholesale_orders_report_menu');


// Add a custom tab to WooCommerce Reports
function custom_add_wholesale_reports_tab($reports) {
    $reports['orders']['reports']['wholesale_orders'] = array(
        'title'       => __('Wholesale Orders', 'woodmart'),
        'description' => '',
        'hide_title'  => true,
        'callback'    => 'custom_wholesale_orders_report',
    );
    return $reports;
}
add_filter('woocommerce_admin_reports', 'custom_add_wholesale_reports_tab');

// Display content for the Wholesale Orders report
function custom_wholesale_orders_report() {
    // Your custom report code here
    echo '<h2>' . __('Wholesale Orders Report', 'woodmart') . '</h2>';
    
    // Example: Query wholesale orders and display them
    $args = array(
        'post_type' => 'shop_order',
        'post_status' => 'wc-completed',
        'meta_key' => '_is_wholesale_order',
        'meta_value' => 'yes',
    );
    $wholesale_orders = new WP_Query($args);

    if ($wholesale_orders->have_posts()) {
        echo '<table class="widefat">';
        echo '<thead><tr><th>' . __('Order ID', 'woodmart') . '</th><th>' . __('Customer', 'woodmart') . '</th><th>' . __('Total', 'woodmart') . '</th><th>' . __('Date', 'woodmart') . '</th></tr></thead>';
        echo '<tbody>';
        while ($wholesale_orders->have_posts()) {
            $wholesale_orders->the_post();
            $order = wc_get_order(get_the_ID());
            echo '<tr>';
            echo '<td>' . $order->get_id() . '</td>';
            echo '<td>' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '</td>';
            echo '<td>' . $order->get_formatted_order_total() . '</td>';
            echo '<td>' . $order->get_date_created()->date('Y-m-d H:i:s') . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>' . __('No wholesale orders found.', 'your-textdomain') . '</p>';
    }
    wp_reset_postdata();
}
