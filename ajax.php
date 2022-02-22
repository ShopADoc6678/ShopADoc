<?php
define('WP_USE_THEMES', true);
require($_SERVER['DOCUMENT_ROOT'].'wp-load.php');
global $wpdb;
if(isset($_POST['mode']) && $_POST['mode']=='mail'){
	//mail("mujahidriazpk@gmail.com","test","this is a message");
	$to = 'mujahidriazpk@gmail.com';
$subject = 'The subject'.rand(5);
$body = 'The email body content';
$headers = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );
	}
if(isset($_POST['mode']) && $_POST['mode']=='getDiscountPopup'){
	if($_POST['selected_coupon'] !='' || $_POST['type'] =='view'){
		$post_id = $_POST['selected_coupon'];
		$content_post = get_post($post_id);
		$discount_type = get_post_meta( $post_id, 'discount_type', true);
		$coupon_amount =get_post_meta( $post_id, 'coupon_amount',true);
		$product_ids = get_post_meta( $post_id, 'product_ids', true);
		$coupon_state = get_post_meta( $post_id, 'coupon_state',true);
		$coupons_category = get_post_meta( $post_id, 'coupons_category',true);
		$date_expires = get_post_meta( $post_id, 'date_expires',true);
		$end_date = '';
		$start_date = $content_post->post_date_gmt;
		$start_date = date("l F j, Y",strtotime($start_date));
		if($date_expires!=""){
			$end_date = date("l F j, Y",$date_expires);
		}
		$html ='<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">'.str_replace("_"," ",$_POST['cat_name']).'</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post"  action="#" >
				
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
						<div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-discount_type" >
						<label class="wpforms-field-label" for="discount_type">Select Type <span class="wpforms-required-label">*</span></label>
						<select name="discount_type" id="discount_type" class="wpforms-field-medium validate[required]" style="display:block !important;" data-prompt-position="topRight:-60,0">
					<option value="">— select Type —</option>
					 <option value="fixed_product">Fixed</option>
						  <option value="percent">Percent</option>
						</select>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-coupon_amount" >
						<label class="wpforms-field-label" for="coupon_amount">Amount <span class="wpforms-required-label">*</span></label>
						<span class="currencyinput"><span class="symbol">$</span><input type="text" id="coupon_amount" class="wpforms-field-medium validate[required,custom[number]]" name="coupon_amount" value="'.$coupon_amount.'" data-prompt-position="topRight:-60,0" onkeypress="return isNumberKey(this, event);"></span>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Amount" >
						<label class="wpforms-field-label" for="Amount">'.str_replace("_"," ",$_POST['cat_name']).' code<span class="wpforms-required-label">*</span></label>
						<input type="text" id="code" class="wpforms-field-medium validate[required]" name="code" value="'.$content_post->post_title.'" data-prompt-position="topRight:-60,0">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date</label>
						<input type="text" id="start_date" class="wpforms-field-medium" autocomplete="off" name="start_date" value="'.$start_date.'" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium" autocomplete="off" name="end_date" value="'.$end_date.'"  data-prompt-position="topRight:-85,3">
					  </div>
					  
					</div>
				  </form>
				</div><script type="text/javascript">jQuery("#discount_type").val("'.$discount_type.'");
									if("'.$discount_type.'"=="percent"){
										jQuery("#wpforms-form-ad .currencyinput .symbol").text("%");
									}else{
										jQuery("#wpforms-form-ad .currencyinput .symbol").text("$");
									}</script>';
				echo $html;
			die;
		
		}else{
		echo '<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">'.str_replace("_"," ",$_POST['cat_name']).'</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post"  action="#" >
				
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
						<div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-discount_type" >
						<label class="wpforms-field-label" for="discount_type">Select Type <span class="wpforms-required-label">*</span></label>
						<select name="discount_type" id="discount_type" class="wpforms-field-medium validate[required]" style="display:block !important;" data-prompt-position="topRight:-60,0">
						  <option value="">— select Type —</option>
						  <option value="fixed_product">Fixed</option>
						  <option value="percent">Percent</option>
						</select>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-coupon_amount" >
						<label class="wpforms-field-label" for="coupon_amount">Amount <span class="wpforms-required-label">*</span></label>
						<span class="currencyinput"><span class="symbol">$</span><input type="text" id="coupon_amount" class="wpforms-field-medium validate[required,custom[number]]" name="coupon_amount" value="" data-prompt-position="topRight:-60,0" onkeypress="return isNumberKey(this, event);"></span>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Amount" >
						<label class="wpforms-field-label" for="Amount">'.str_replace("_"," ",$_POST['cat_name']).' code<span class="wpforms-required-label">*</span></label>
						<input type="text" id="code" class="wpforms-field-medium validate[required]" name="code" value="" data-prompt-position="topRight:-60,0">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date</label>
						<input type="text" id="start_date" class="wpforms-field-medium" autocomplete="off" name="start_date" value="" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium" autocomplete="off" name="end_date" value="" data-prompt-position="topRight:-85,3">
					  </div>
					  
					</div>
				  </form>
				</div>';die;
		
		}
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='submitDiscount'){
	if($_POST['selected_coupon'] !=''){
				$post_id = $_POST['selected_coupon'] ;
				$title = $_POST['code'];
				if(isset($_POST['start_date']) && $_POST['start_date'] !=""){
					$post_date_gmt = date("Y-m-d H:i:s",  strtotime($_POST['start_date']));
				}else{
					$post_date_gmt = date("Y-m-d H:i:s");
				}
				$my_post = array(
										  'ID'    =>$post_id,
										  'post_title'    => wp_strip_all_tags($title),
										  'post_date'    => $post_date_gmt,
										  'post_date_gmt'    => $post_date_gmt,
										  'post_status'   => 'publish',
										  'post_type'     =>'shop_coupon',
										);

				// Insert the post into the database
				wp_update_post( $my_post );
				
				update_post_meta( $post_id, 'discount_type', $_POST['discount_type']);
				update_post_meta( $post_id, 'coupon_amount', $_POST['coupon_amount'] );
				if($_POST['end_date']){
					$end_date = strtotime($_POST['end_date']);
					update_post_meta( $post_id, 'date_expires', $end_date);
				}
				/*if($_POST['coupons_category']=='126'){
					$product_ids = 1141;
					
				}
				if($_POST['coupons_category']=='127'){
					$product_ids = 126;
				}
				if($_POST['coupons_category']=='128'){
					$product_ids = 1642;
				}*/
				//update_post_meta( $post_id, 'product_ids', $product_ids);
				//update_post_meta( $post_id, 'coupon_state', $_POST['state_name'] );
				//update_post_meta( $post_id, 'coupon_zipcode', $_POST['coupon_zipcode']);
				//update_post_meta( $post_id, 'coupons_category', $_POST['coupons_category']);
				//wp_set_object_terms( $post_id, $_POST['cat_name'], 'coupon_category',false );
				
	}else{
				$attach_id ='';
				$title = $_POST['code'];
				if(isset($_POST['start_date']) && $_POST['start_date'] !=""){
					$post_date_gmt = date("Y-m-d H:i:s",  strtotime($_POST['start_date']));
				}else{
					$post_date_gmt = date("Y-m-d H:i:s");
				}
				$my_post = array(
										  'post_title'    => wp_strip_all_tags($title),
										  'post_content'    =>$_POST['cat_name'].' for '.$_POST['state_name'],
										  'post_date'    => $post_date_gmt,
										  'post_date_gmt'    => $post_date_gmt,
										  'post_status'   => 'publish',
										  'post_type'     =>'shop_coupon',
										);
 
				// Insert the post into the database
				$post_id = wp_insert_post( $my_post );
				if($_POST['coupons_category']=='126'){
					$product_ids = 1141;
					
				}
				if($_POST['coupons_category']=='127'){
					$product_ids = 126;
				}
				if($_POST['coupons_category']=='128'){
					$product_ids = 1642;
				}
				update_post_meta( $post_id, 'discount_type', $_POST['discount_type']);
				update_post_meta( $post_id, 'coupon_amount', $_POST['coupon_amount'] );
				update_post_meta( $post_id, 'product_ids', $product_ids);
				update_post_meta( $post_id, 'coupon_state', $_POST['state_name'] );
				//update_post_meta( $post_id, 'coupon_zipcode', $_POST['coupon_zipcode']);
				update_post_meta( $post_id, 'coupons_category', $_POST['coupons_category']);
				wp_set_object_terms( $post_id, $_POST['cat_name'], 'coupon_category',false );
				if($_POST['end_date']){
					$end_date = strtotime($_POST['end_date']);
					update_post_meta( $post_id, 'date_expires', $end_date);
				}
	}
	die;
}
if(isset($_POST['mode']) && $_POST['mode']=='getCoupon'){

	global $US_State_2;
	$productArray =array('127'=>'Promo','126'=>'Coupon','128'=>'Relist');

	echo '<div class="heading-discount">DISCOUNTS - '.strtoupper($US_State_2[$_POST['state_name']]).'</div>
		<table width="100%" class="scroll wp-list-table widefat fixed striped table-view-list posts" id="dest" style="width:100%;height:auto;overflow:scroll;">
              <thead>
                <tr>
                  <th style="width:22% !important;"><strong>Product</strong></th>
                  <th style="width:23% !important;"><strong>Discount</strong></th>
                  <th style="width:30% !important;"><strong>Period</strong></th>
                  <th style="width:25% !important;"><strong>Code</strong></th>
                </tr>
              </thead>
              <tbody >';
			  $i=0;
			  foreach($productArray as $id=>$product){
				  $args = array('meta_query' => array(
									'relation' => 'AND', /* <-- here */
									array(
										'key' => 'coupon_state',
													'value' => $_POST['state_name'],
													'compare' => '=',
									),
									array(
										'key' => 'coupons_category ',
										'value' => $id,
										'type' => 'numeric',
										'compare' => '='
									)
								),
								'post_type' => 'shop_coupon',
								'posts_per_page' => -1
							);
					$posts = get_posts($args);
					$style = '';
					if($i % 2 ==0){
						$style = " style='background-color:#F6F7F7;' ";
					}
					 if ( $posts ) {
						
					  foreach($posts as $post){
						  $coupon_amount =get_post_meta($post->ID,'coupon_amount',true);
						   $date_expires =get_post_meta($post->ID,'date_expires',true);
						  $post_date_gmt = date("m/d/y",strtotime($post->post_date_gmt));
						  $period = 'none';
							if($date_expires!=""){
								$expiry_date = date("m/d/y",$date_expires);
								$period = $post_date_gmt.' - '.$expiry_date;
							}
							$discount_type = get_post_meta($post->ID, 'discount_type', true);
						
							if($discount_type=='percent'){
								$coupon_amount = $coupon_amount."%";
							}else{
								$coupon_amount = "$".$coupon_amount;
							}
							
							
								  echo '<tr '.$style.'>
								  <td style="width:22% !important;"><strong>'.$product.'</strong></td>
								  <td style="width:23% !important;"><strong>'.$coupon_amount.'</strong></td>
								  <td style="width:30% !important;"><strong>'.$period.'</strong></td>
								  <td style="width:25% !important;"><span class="add_coupon" onclick=\'addCoupon("'.$post->ID.'","'.$id.'","'.$product.'","'.$_POST['state_name'].'");\'>'.$post->post_title.'</span></td>
								</tr>';
					  }
				  }else{
					  echo '<tr '.$style.'>
								  <td style="width:22% !important;"><strong>'.$product.'</strong></td>
								  <td style="width:23% !important;"><strong>none</strong></td>
								  <td style="width:30% !important;"><strong>none</strong></td>
								  <td style="width:25% !important;"><span class="add_coupon" onclick=\'addCoupon("","'.$id.'","'.$product.'","'.$_POST['state_name'].'");\'>none</span></td>
								</tr>';
				  }
				  $i++;
			  }
       echo '</tbody>
            </table>';
}
if(isset($_POST['mode']) && $_POST['mode']=='getfeePopup'){
	 $args = array(
						'role'    => 'advanced_ads_user',
						'orderby' => 'user_nicename',
						'order'   => 'ASC'
					);
	$users = get_users( $args );
	$userDropdown = '';
	foreach($users as $user){
		$ad_demo_company_name =  get_user_meta($user->ID, 'ad_demo_company_name', true );
		$userDropdown .= '<option value="'.$user->ID.'">'.$ad_demo_company_name.'</option>';
	}
	if($_POST['selected_ad'] !='' || $_POST['type'] =='view'){
		$post_id = $_POST['selected_ad'];
		$advanced_ads_ad_options = maybe_unserialize(get_post_meta($post_id, 'advanced_ads_ad_options', true ));
		//print_r($advanced_ads_ad_options);post_date_gmt
		$content_post = get_post($post_id);
	//	print_r($content_post);
		$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
		$img_atts = wp_get_attachment_image_src($attach_id, 'thumbnail');
		$src = $img_atts[0];
		$ad_link = $advanced_ads_ad_options['url'];
		$post_date_gmt = date("l F j, Y",strtotime($content_post->post_date_gmt));
		if($advanced_ads_ad_options['expiry_date']){
			$expiry_date = date("l F j, Y",$advanced_ads_ad_options['expiry_date']);
		}
		$ad_user = get_post_meta( $post_id, 'ad_user', true);
		$ad_location  = get_post_meta( $post_id, 'ad_location', true );
		$userDropdown = '';
		foreach($users as $user){
			$selected ='';
			if($user->ID==$ad_user){
				$selected = ' selected="selected" '; 
			}
			$ad_demo_company_name =  get_user_meta($user->ID, 'ad_demo_company_name', true );
			$userDropdown .= '<option value="'.$user->ID.'" '.$selected.'>'.$ad_demo_company_name.'</option>';
		}
		echo '<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">AD Details</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" >
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" >
						<label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label>
						<select name="company" id="company" class="wpforms-field-medium validate[required]" style="display:block !important;">
						  <option value="">- Select Company -</option>
						  '.$userDropdown.'
						</select>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Ad Link <span class="wpforms-required-label">*</span></label>
						<input type="text" id="ad_link" class="wpforms-field-medium validate[required]" name="ad_link" value="'.$ad_link.'" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date <span class="wpforms-required-label">*</span></label>
						<input type="text" id="start_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="start_date" value="'.$post_date_gmt.'" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="end_date" value="'.$expiry_date.'" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first" data-field-id="22">
						<label class="wpforms-field-label" for="wpforms-185-field_22">Creative<span class="wpforms-required-label">*</span></label>
						<img src="'.$src.'" id="ad_image_src" style="width:300px;height:250px;"/>
						<input type="file" id="ad_image" class="wpforms-field-medium" name="ad_image" value="" onChange="load_image(this.id,this.value)"/>
						
					  </div>
					</div>
				  </form>
				</div>';die;
		
	}else{
		$price = get_post_meta($_POST['id'] ,"_regular_price",true);
		echo '<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">'.str_replace("_"," ",$_POST['type']).'</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" >
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Amount" >
						<label class="wpforms-field-label" for="Company">Amount <span class="wpforms-required-label">*</span></label>
						<span class="currencyinput"><span class="symbol">$</span><input type="text" id="Amount" class="wpforms-field-medium validate[required]" name="Amount" value="'.$price.'" data-prompt-position="topRight:-80,3" ></span>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date <span class="wpforms-required-label">*</span></label>
						<input type="text" id="start_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="start_date" value="" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="end_date" value="" data-prompt-position="topRight:-85,3">
					  </div>
					  
					</div>
				  </form>
				</div>';die;
		
		}
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='getDetailAD'){
	$post_id= $_POST['selected_ad'];
	$post   = get_post( $post_id );
	$advanced_ads_ad_options = maybe_unserialize(get_post_meta($post_id, 'advanced_ads_ad_options', true ));
	$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
	$user = get_userdata($post->post_author);
	$City =  get_user_meta($post->post_author, 'billing_city', true );
	$State =  get_user_meta($post->post_author, 'billing_state', true );
	$ad_demo_company_name = get_user_meta($post->post_author, 'ad_demo_company_name',true);
	
	$ad_type = $advanced_ads_ad_options['type'] ;
	$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
	$img_atts = wp_get_attachment_image_src($attach_id, 'full');
	$src = $img_atts[0];
	$ad_link = $advanced_ads_ad_options['url'];
	$post_date_gmt = date("M j, Y",strtotime($post->post_date_gmt));
	if($advanced_ads_ad_options['expiry_date']){
		$expiry_date = date("M j, Y",$advanced_ads_ad_options['expiry_date']);
	}
	$ad_user = get_post_meta( $post_id, 'ad_user', true);
	$ad_location  = get_post_meta( $post_id, 'ad_location', true );
	$user_id= $post->post_author;
	$ad_demo_agent = get_user_meta( $user_id, 'ad_demo_agent', true);
	$billing_address_1 = get_user_meta( $user_id, 'billing_address_1', true);
	$billing_address_2 = get_user_meta( $user_id, 'billing_address_2', true);
	$billing_city = get_user_meta( $user_id, 'billing_city', true);
	$billing_state = get_user_meta( $user_id, 'billing_state', true );
	$billing_postcode = get_user_meta( $user_id, 'billing_postcode', true );
	$billing_phone = get_user_meta( $user_id, 'billing_phone', true );
	$address = $billing_address_1.' '.$billing_address_2.' '.$billing_city.', '.$billing_state.' '.$billing_postcode;
	if($ad_type=='plain'){
		if($post->post_content !=""){
		$newEnbedCode = preg_replace('/width="([0-9]+)" height="([0-9]+)"/', ' width="165" height="135" class="youtube"', $post->post_content);
		$image_html = '<div class="col" style="border:none;text-align:left;width:300px;height:250px;">'.$newEnbedCode.'</div>';
		}
	}else{
		$image_html = ' <div class="col" style="border:none;text-align:left;"><img src="'.$src.'" id="ad_image_src"  /></div>';
	}
	$html = '';
	$html = '<div class="ad_details">
					<p class="pull-right"><a href=\'javascript:AdPopup("'.$_REQUEST['ad_id'].'","'.$_REQUEST['type'].'","'.$_REQUEST['selected_ad'].'");\' class="edit_link">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\'javascript:ClosePopup("'.$_REQUEST['ad_id'].'","'.$_REQUEST['type'].'","'.$_REQUEST['selected_ad'].'");\' class="delete_link">close</a></p>
					<p><label>CREATIVE:</label><br /><span class="popup_val">'.$post->post_name.'</span></p>
					<p><label>COMPANY:</label>&nbsp;<span class="popup_val">'.$ad_demo_company_name.'</span></p>
					<p><label>RUN PERIOD:</label>&nbsp;<span class="popup_val">'.$post_date_gmt.' - '.$expiry_date.'</span></p>
					<div class="row" style="border:none;text-align:left;">
					 '.$image_html.'
					  <div class="col" style="border:none;text-align:left;">
					  		<p><label>AGENT:</label><br /><span class="popup_val">'.$ad_demo_agent.'</span></p>
							<p><label>ADDRESS:</label><br /><span class="popup_val">'.$ad_demo_agent.'</span></p>
							<p><label>EMAIL:</label><br /><span class="popup_val">'.$user->user_email.'</span></p>
							<p><label>CELL:</label><br /><span class="popup_val">'.$billing_phone.'</span></p>
					  </div>
					</div>
				</div>';
	echo $html;
	die;
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='saveAdPosition'){
	$option_name = $_POST['postion_name'];
	$post_id = $_POST['ad_id'];
	if ( get_option( $option_name ) !== false ) {
			update_option( $option_name, $post_id);
	}else{
		$deprecated = null;
		$autoload = 'yes';
		add_option( $option_name,$post_id, $deprecated, $autoload );
	}
	
	/*$query = "SELECT * FROM wp_posts where (post_status = 'publish' or post_status = 'future') and post_type = 'advanced_ads' and ( post_title like '% ".$_POST['type']."%' or post_content = '".$_POST['type']."' )ORDER BY ID ASC";
	$results = $wpdb->get_results($query, OBJECT);
	$html1 = '';
	foreach($results as $row){
		if($row->ID !=""){
			$selected ="";
			if($post_id==$row->ID){
				$selected = ' selected="selected" ';
			}
			$advanced_ads_ad_options = maybe_unserialize(get_post_meta($row->ID, 'advanced_ads_ad_options', true ));
			$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
			$img_atts = wp_get_attachment_image_src($attach_id, 'thumbnail');
			$src = $img_atts[0];
			$html1 .= '<option value="'.$row->ID.'" '.$selected.' data-select2-id="'.$src.'">'.$row->post_title.'</option>';
		}
	}*/
	$args = array(
					'role'    => 'advanced_ads_user',
					'orderby' => 'user_nicename',
					'order'   => 'ASC'
				);
	$users = get_users( $args );
	foreach($users as $user){
		$query = "SELECT * FROM wp_posts where post_author = '".$user->ID."'and (post_status = 'publish' or post_status = 'future') and post_type = 'advanced_ads' and ( post_title like '% ".$_POST['type']."%' or post_excerpt = '".$_POST['type']."' ) ORDER BY ID ASC";
		$results = $wpdb->get_results($query, OBJECT);
		if ($wpdb->num_rows > 0) {
			$ad_demo_company_name_group = get_user_meta($user->ID, 'ad_demo_company_name',true);
			$html1 .='<optgroup label="'.$ad_demo_company_name_group.'">';
			foreach($results as $row){
				if($row->ID !=""){
					$advanced_ads_ad_options = maybe_unserialize(get_post_meta($row->ID, 'advanced_ads_ad_options', true ));
					$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
					$img_atts = wp_get_attachment_image_src($attach_id, 'thumbnail');
					$src = $img_atts[0];
					$selected ="";
					if($post_id==$row->ID){
						$selected = ' selected="selected" ';
					}
					$html1 .= '<option value="'.$row->ID.'" data-select2-id="'.$src.'" '.$selected.'>'.$row->post_title.'</option>';
				}
			}
			$html1 .='</optgroup>';
		}
	}
	$post   = get_post( $post_id );
	$ad_demo_company_name = get_user_meta($post->post_author, 'ad_demo_company_name',true);
	$html2 = '&nbsp;<a href="javascript:detailPopup(\''.$option_name.'\',\''.$_POST['type'].'\',\''.get_option($option_name).'\');">'.$ad_demo_company_name.'</a></span><span id="'.$option_name.'_detail_popup" class="detail_View">&nbsp;</span>';
	echo $html1."##".$html2;
	/*print_r($_POST);
	print_r($_FILES);*/
	die;
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='submitAD'){
	if($_POST['selected_ad'] !=''){

	 			//[COMPANY]_[START DATE MMDDYY]-[ENDDATE MMDDYY]
				$post_id= $_POST['selected_ad'];
				$advanced_ads_ad_options = maybe_unserialize(get_post_meta($post_id, 'advanced_ads_ad_options', true ));
				$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
				$user = get_userdata($_POST['company']);
				$City =  get_user_meta($_POST['company'], 'billing_city', true );
				$State =  get_user_meta($_POST['company'], 'billing_state', true );
				$ad_demo_company_name = get_user_meta($_POST['company'], 'ad_demo_company_name',true);
				$title = $_POST['type']." ".$ad_demo_company_name.'&nbsp;'.date('m/d/y',strtotime($_POST['start_date'])).' - '.date('m/d/y',strtotime($_POST['end_date']));
	
				$post_date_gmt = date("Y-m-d H:i:s",  strtotime($_POST['start_date']));
				$my_post = array(
										   'ID'    =>$post_id,
										  'post_author'=>$_POST['company'],
										   'post_title'    => $title,
										 // 'post_title'    => wp_strip_all_tags($title),
										//  'post_content'    => $_POST['code'],
										  'post_excerpt'    => $_POST['type'],
										  'post_date'    => $post_date_gmt,
										  'post_date_gmt'    => $post_date_gmt,
										  'post_status'   => 'publish',
										  'post_type'     =>'advanced_ads',
										);

				// Insert the post into the database
				wp_update_post( $my_post );
				if( $_POST['ad_type']=='plain'){
					$wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='".$_POST['code']."' WHERE ID='".$post_id."'"));
				}
				if(isset($_FILES['file']) && ($_FILES['file']['size'] > 0)) {

                    // Get the type of the uploaded file. This is returned as "type/extension"
                    $arr_file_type = wp_check_filetype(basename($_FILES['file']['name']));
                    $uploaded_file_type = $arr_file_type['type'];

                    // Set an array containing a list of acceptable formats
                    $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');

                    // If the uploaded file is the right format
                    if(in_array($uploaded_file_type, $allowed_file_types)) {

                        // Options array for the wp_handle_upload function. 'test_upload' => false
                        $upload_overrides = array( 'test_form' => false ); 

                        // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
                        $uploaded_file = wp_handle_upload($_FILES['file'], $upload_overrides);

                        // If the wp_handle_upload call returned a local path for the image
                        if(isset($uploaded_file['file'])) {

                            // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                            $file_name_and_location = $uploaded_file['file'];

                            // Generate a title for the image that'll be used in the media library
                            $file_title_for_media_library = $title;

                            // Set up options array to add this file as an attachment
                            $attachment = array(
                                'post_mime_type' => $uploaded_file_type,
                                'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );

                            // Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
                            $attach_id = wp_insert_attachment( $attachment, $file_name_and_location );
                            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
                            wp_update_attachment_metadata($attach_id,  $attach_data);

                            // Before we update the post meta, trash any previously uploaded image for this post.
                            // You might not want this behavior, depending on how you're using the uploaded images.
                            $existing_uploaded_image = (int) get_post_meta($post_id,'_xxxx_attached_image', true);
                            if(is_numeric($existing_uploaded_image)) {
                                wp_delete_attachment($existing_uploaded_image);
                            }

                            // Now, update the post meta to associate the new image with the post
                            update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                            // Set the feedback flag to false, since the upload was successful
                            $upload_feedback = false;


                        } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.

                            $upload_feedback = 'There was a problem with your upload.';
                            update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                        }

                    } else { // wrong file type

                        $upload_feedback = 'Please upload only image files (jpg, gif or png).';
                        update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                    }

                } 				
				//$attachmentId = media_handle_sideload($_FILES, $post_id);
				$advanced_ads_ad_options = array();
				$advanced_ads_ad_options['visitor'] ='';
				$advanced_ads_ad_options['visitors'] ='';
				$advanced_ads_ad_options['output']['image_id'] = $attach_id;
				$advanced_ads_ad_options['output']['position'] ='';
				$advanced_ads_ad_options['output']['margin']['top'] ='';
				$advanced_ads_ad_options['output']['margin']['right'] ='';
				$advanced_ads_ad_options['output']['margin']['bottom'] ='';
				$advanced_ads_ad_options['output']['margin']['left'] ='';
				$advanced_ads_ad_options['output']['wrapper-id'] ='';
				$advanced_ads_ad_options['output']['wrapper-class'] ='';
				$advanced_ads_ad_options['output']['custom-code'] ='';
				
				$advanced_ads_ad_options['type'] =$_POST['ad_type'];
				$advanced_ads_ad_options['url'] = $_POST['ad_link'];
				$advanced_ads_ad_options['width'] ='300';
				$advanced_ads_ad_options['height'] ='250';
				$advanced_ads_ad_options['conditions'] =array();
				$advanced_ads_ad_options['expiry_date'] =strtotime($_POST['end_date']);
				$advanced_ads_ad_options['description'] ='';
				$advanced_ads_ad_options['tracking']['enabled'] ='default';
				$advanced_ads_ad_options['tracking']['impression_limit'] =0;
				$advanced_ads_ad_options['tracking']['click_limit'] =0;
				$advanced_ads_ad_options['tracking']['public-name'] ='';
				$advanced_ads_ad_options['tracking']['target'] ='default';
				$advanced_ads_ad_options['tracking']['nofollow'] ='default';
				$advanced_ads_ad_options['tracking']['report-recip'] ='';
				$advanced_ads_ad_options['tracking']['report-period'] ='last30days';
				$advanced_ads_ad_options['tracking']['report-frequency'] ='never';
				$advanced_ads_ad_options['tracking']['public-id'] ='';
				update_post_meta( $post_id, 'advanced_ads_ad_options', $advanced_ads_ad_options );
				update_post_meta( $post_id, 'ad_user', $_POST['company'] );
				update_post_meta( $post_id, 'ad_location', $City.", ".$State );
				update_user_meta($_POST['company'] , 'deactivate_advertiser','No');
				/*$option_name = $_POST['id'];
				if ( get_option( $option_name ) !== false ) {
						update_option( $option_name, $post_id);
				}else{
					$deprecated = null;
					$autoload = 'yes';
					add_option( $option_name,$post_id, $deprecated, $autoload );
				}*/
	
	}else{
	 			//[COMPANY]_[START DATE MMDDYY]-[ENDDATE MMDDYY]
				$attach_id ='';
				$user = get_userdata($_POST['company']);
				$City =  get_user_meta($_POST['company'], 'billing_city', true );
				$State =  get_user_meta($_POST['company'], 'billing_state', true );
				$ad_demo_company_name = get_user_meta($_POST['company'], 'ad_demo_company_name',true);
				$title = $_POST['type']." ".$ad_demo_company_name.'&nbsp;'.date('m/d/y',strtotime($_POST['start_date'])).' - '.date('m/d/y',strtotime($_POST['end_date']));
				$post_date_gmt = date("Y-m-d H:i:s",  strtotime($_POST['start_date']));
				$my_post = array(
										   'post_title'    => $title,
										 // 'post_title'    => wp_strip_all_tags($title),
										  'post_author'=>$_POST['company'],
										  'post_date'    => $post_date_gmt,
										  'post_date_gmt'    => $post_date_gmt,
										  //'post_content'    => $_POST['code'],
										  'post_excerpt'    => $_POST['type'],
										  'post_status'   => 'publish',
										  'post_type'     =>'advanced_ads',
										);
 
				// Insert the post into the database
				$post_id = wp_insert_post( $my_post );
				if( $_POST['ad_type']=='plain'){
					$wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='".$_POST['code']."' WHERE ID='".$post_id."'"));
				}
				if(isset($_FILES['file']) && ($_FILES['file']['size'] > 0)) {

                    // Get the type of the uploaded file. This is returned as "type/extension"
                    $arr_file_type = wp_check_filetype(basename($_FILES['file']['name']));
                    $uploaded_file_type = $arr_file_type['type'];

                    // Set an array containing a list of acceptable formats
                    $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');

                    // If the uploaded file is the right format
                    if(in_array($uploaded_file_type, $allowed_file_types)) {

                        // Options array for the wp_handle_upload function. 'test_upload' => false
                        $upload_overrides = array( 'test_form' => false ); 

                        // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
                        $uploaded_file = wp_handle_upload($_FILES['file'], $upload_overrides);

                        // If the wp_handle_upload call returned a local path for the image
                        if(isset($uploaded_file['file'])) {

                            // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                            $file_name_and_location = $uploaded_file['file'];

                            // Generate a title for the image that'll be used in the media library
                            $file_title_for_media_library = $title;

                            // Set up options array to add this file as an attachment
                            $attachment = array(
                                'post_mime_type' => $uploaded_file_type,
                                'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );

                            // Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
                            $attach_id = wp_insert_attachment( $attachment, $file_name_and_location );
                            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
                            wp_update_attachment_metadata($attach_id,  $attach_data);

                            // Before we update the post meta, trash any previously uploaded image for this post.
                            // You might not want this behavior, depending on how you're using the uploaded images.
                            $existing_uploaded_image = (int) get_post_meta($post_id,'_xxxx_attached_image', true);
                            if(is_numeric($existing_uploaded_image)) {
                                wp_delete_attachment($existing_uploaded_image);
                            }

                            // Now, update the post meta to associate the new image with the post
                            update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                            // Set the feedback flag to false, since the upload was successful
                            $upload_feedback = false;


                        } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.

                            $upload_feedback = 'There was a problem with your upload.';
                            update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                        }

                    } else { // wrong file type

                        $upload_feedback = 'Please upload only image files (jpg, gif or png).';
                        update_post_meta($post_id,'_xxxx_attached_image',$attach_id);

                    }

                } 				
				//$attachmentId = media_handle_sideload($_FILES, $post_id);
				$advanced_ads_ad_options = array();
				$advanced_ads_ad_options['visitor'] ='';
				$advanced_ads_ad_options['visitors'] ='';
				$advanced_ads_ad_options['output']['image_id'] = $attach_id;
				$advanced_ads_ad_options['output']['position'] ='';
				$advanced_ads_ad_options['output']['margin']['top'] ='';
				$advanced_ads_ad_options['output']['margin']['right'] ='';
				$advanced_ads_ad_options['output']['margin']['bottom'] ='';
				$advanced_ads_ad_options['output']['margin']['left'] ='';
				$advanced_ads_ad_options['output']['wrapper-id'] ='';
				$advanced_ads_ad_options['output']['wrapper-class'] ='';
				$advanced_ads_ad_options['output']['custom-code'] ='';
				
				$advanced_ads_ad_options['type'] = $_POST['ad_type'];
				$advanced_ads_ad_options['url'] = $_POST['ad_link'];
				$advanced_ads_ad_options['width'] ='300';
				$advanced_ads_ad_options['height'] ='250';
				$advanced_ads_ad_options['conditions'] =array();
				$advanced_ads_ad_options['expiry_date'] =strtotime($_POST['end_date']);
				$advanced_ads_ad_options['description'] ='';
				$advanced_ads_ad_options['tracking']['enabled'] ='default';
				$advanced_ads_ad_options['tracking']['impression_limit'] =0;
				$advanced_ads_ad_options['tracking']['click_limit'] =0;
				$advanced_ads_ad_options['tracking']['public-name'] ='';
				$advanced_ads_ad_options['tracking']['target'] ='default';
				$advanced_ads_ad_options['tracking']['nofollow'] ='default';
				$advanced_ads_ad_options['tracking']['report-recip'] ='';
				$advanced_ads_ad_options['tracking']['report-period'] ='last30days';
				$advanced_ads_ad_options['tracking']['report-frequency'] ='never';
				$advanced_ads_ad_options['tracking']['public-id'] ='';
				update_post_meta( $post_id, 'advanced_ads_ad_options', $advanced_ads_ad_options );
				update_post_meta( $post_id, 'ad_user', $_POST['company'] );
				update_post_meta( $post_id, 'ad_location', $City.", ".$State );
				update_user_meta($_POST['company'] , 'deactivate_advertiser','No');
		
	}
			$option_name = $_POST['id'];
				
			/*	$option_tmp = explode("_",$option_name);
				$newArr = implode("_",array_splice($option_tmp,0,-2));*/
				
				$option_tmp = explode("_",$option_name);
				$option_name_new = implode("_",array_splice($option_tmp,0,-2));
				
				$start = new DateTime(date("Y-m-d",strtotime($_POST['start_date'])));
				$interval = new DateInterval('P1M');
				$end = new DateTime(date("Y-m-d",strtotime($_POST['end_date'])));
				$period = new DatePeriod($start, $interval, $end);
				foreach ($period as $key => $value) {
					$option_name_loop = $option_name_new."_".$value->format('m_y');
					if (get_option($option_name_loop ) !== false ) {
							update_option($option_name_loop, $post_id);
					}else{
						add_option($option_name_loop,$post_id,null,'yes');
					}
				}
				/*$query = "SELECT * FROM wp_posts where (post_status = 'publish' or post_status = 'future') and post_type = 'advanced_ads' and ( post_title like '% ".$_POST['type']."%' or post_content = '".$_POST['type']."' )  ORDER BY ID ASC";
				$results = $wpdb->get_results($query, OBJECT);
				$html1 = '';
				foreach($results as $row){
					if($row->ID !=""){
						$selected ="";
						if($post_id==$row->ID){
							$selected = ' selected="selected" ';
						}
						$html1 .= '<option value="'.$row->ID.'" '.$selected.'>'.$row->post_title.'</option>';
					}
				}*/
				
				$args = array(
					'role'    => 'advanced_ads_user',
					'orderby' => 'user_nicename',
					'order'   => 'ASC'
				);
				$users = get_users( $args );
				foreach($users as $user){
					$query = "SELECT * FROM wp_posts where post_author = '".$user->ID."'and (post_status = 'publish' or post_status = 'future') and post_type = 'advanced_ads' and ( post_title like '% ".$_POST['type']."%' or post_excerpt = '".$_POST['type']."' ) ORDER BY ID ASC";
					$results = $wpdb->get_results($query, OBJECT);
					if ($wpdb->num_rows > 0) {
						$ad_demo_company_name_group = get_user_meta($user->ID, 'ad_demo_company_name',true);
						$html1 .='<optgroup label="'.$ad_demo_company_name_group.'">';
						foreach($results as $row){
							if($row->ID !=""){
								$advanced_ads_ad_options = maybe_unserialize(get_post_meta($row->ID, 'advanced_ads_ad_options', true ));
								$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
								$img_atts = wp_get_attachment_image_src($attach_id, 'thumbnail');
								$src = $img_atts[0];
								$selected ="";
								if($post_id==$row->ID){
									$selected = ' selected="selected" ';
								}
								$html1 .= '<option value="'.$row->ID.'" data-select2-id="'.$src.'" '.$selected.'>'.$row->post_title.'</option>';
							}
						}
						$html1 .='</optgroup>';
					}
				}
				echo $html1;
				
				$args = array(
					'role'    => 'advanced_ads_user',
					'orderby' => 'user_nicename',
					'order'   => 'ASC'
				);
				$users = get_users( $args );
				foreach($users as $user){
					$query = "SELECT * FROM wp_posts where post_author = '".$user->ID."'and (post_status = 'publish' or post_status = 'future') and post_type = 'advanced_ads' and ( post_title like '% ".$_POST['type']."%' or post_excerpt = '".$_POST['type']."' ) ORDER BY ID ASC";
					$results = $wpdb->get_results($query, OBJECT);
					if ($wpdb->num_rows > 0) {
						$ad_demo_company_name_group = get_user_meta($user->ID, 'ad_demo_company_name',true);
						$html1 .='<optgroup label="'.$ad_demo_company_name_group.'">';
						foreach($results as $row){
							if($row->ID !=""){
								$advanced_ads_ad_options = maybe_unserialize(get_post_meta($row->ID, 'advanced_ads_ad_options', true ));
								$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
								$img_atts = wp_get_attachment_image_src($attach_id, 'thumbnail');
								$src = $img_atts[0];
								$selected ="";
								if($post_id==$row->ID){
									$selected = ' selected="selected" ';
								}
								$html1 .= '<option value="'.$row->ID.'" data-select2-id="'.$src.'" '.$selected.'>'.$row->post_title.'</option>';
							}
						}
						$html1 .='</optgroup>';
					}
				}
				$post   = get_post( $post_id );
				$ad_demo_company_name = get_user_meta($post->post_author, 'ad_demo_company_name',true);
				$html2 = '&nbsp;<a href="javascript:detailPopup(\''.$option_name.'\',\''.$_POST['type'].'\',\''.get_option($option_name).'\');">'.$ad_demo_company_name.'</a></span><span id="'.$option_name.'_detail_popup" class="detail_View">&nbsp;</span>';
				echo $html1."##".$html2;
				/*print_r($_POST);
				print_r($_FILES);*/
				die;
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='submitUser'){
	$params = array();
	parse_str($_REQUEST['vars'], $params);
	//print_r($params);
	if($_POST['user_id'] !=''){
		$user_id = $_POST['user_id'] ;
		update_user_meta( $user_id, 'ad_demo_company_name', $params['Company']);
		update_user_meta( $user_id, 'ad_demo_agent', $params['Agent']);
		update_user_meta( $user_id, 'billing_address_1', $params['Street']);
		update_user_meta( $user_id, 'billing_address_2', $params['Apt']);
		update_user_meta( $user_id, 'billing_city', $params['City']);
		update_user_meta( $user_id, 'billing_state', $params['State']);
		update_user_meta( $user_id, 'billing_postcode', $params['Zip']);
		update_user_meta( $user_id, 'billing_phone', $params['Cell']);
		echo 'update';
			
	}else{
		$username = $params['email'];
		$password = $params['Password'];
		$email = $params['email'];
		$query='SELECT * FROM wp_users Where user_email ="'.$email.'"';
		$result= $wpdb->get_results($query); 
		if ($wpdb->num_rows==0) {
			$user_id = wp_create_user( $username, $password, $email );
			$user = get_user_by( 'id', $user_id );
			$user->remove_role( 'subscriber' );
			if($_POST['type'] =='Advertiser'){
				$user->add_role( 'advanced_ads_user' );
			}else{
				$user->add_role( 'ad_demo' );
			}
			add_user_meta( $user_id, 'ad_demo_company_name', $params['Company']);
			add_user_meta( $user_id, 'ad_demo_agent', $params['Agent']);
			add_user_meta( $user_id, 'billing_address_1', $params['Street']);
			add_user_meta( $user_id, 'billing_address_2', $params['Apt']);
			add_user_meta( $user_id, 'billing_city', $params['City']);
			add_user_meta( $user_id, 'billing_state', $params['State']);
			add_user_meta( $user_id, 'billing_postcode', $params['Zip']);
			add_user_meta( $user_id, 'billing_phone', $params['Cell']);
			echo 'added';
		}else{
			echo 'exit';
		}
	}
	die;
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='checkEmail'){
	$query='SELECT * FROM wp_users Where user_email ="'.$_REQUEST['email'].'"';
	$result= $wpdb->get_results($query); 
	if($wpdb->num_rows>0){
		echo 'exit';
	}else{
		echo 'not';
	}
	die;
}
if(isset($_POST['mode']) && $_POST['mode']=='getAddADPopup'){
	 $args = array(
						'role'    => 'advanced_ads_user',
						'orderby' => 'user_nicename',
						'order'   => 'ASC'
					);
	$users = get_users( $args );
	$userDropdown = '';
	foreach($users as $user){
		$ad_demo_company_name =  get_user_meta($user->ID, 'ad_demo_company_name', true );
		$userDropdown .= '<option value="'.$user->ID.'">'.$ad_demo_company_name.'</option>';
	}
	if($_POST['selected_ad'] !='' || $_POST['type'] =='view'){
		$post_id = $_POST['selected_ad'];
		$advanced_ads_ad_options = maybe_unserialize(get_post_meta($post_id, 'advanced_ads_ad_options', true ));
		//print_r($advanced_ads_ad_options);post_date_gmt
		$content_post = get_post($post_id);
	//	print_r($content_post);
		$ad_type = $advanced_ads_ad_options['type'];
		$attach_id = $advanced_ads_ad_options['output']['image_id'] ;
		$img_atts = wp_get_attachment_image_src($attach_id, 'full');
		$src = $img_atts[0];
		$ad_link = $advanced_ads_ad_options['url'];
		$post_date_gmt = date("l F j, Y",strtotime($content_post->post_date_gmt));
		if($advanced_ads_ad_options['expiry_date']){
			$expiry_date = date("l F j, Y",$advanced_ads_ad_options['expiry_date']);
		}
		$ad_user = get_post_meta( $post_id, 'ad_user', true);
		$ad_location  = get_post_meta( $post_id, 'ad_location', true );
		$userDropdown = '';
		foreach($users as $user){
			$selected ='';
			if($user->ID==$ad_user){
				$selected = ' selected="selected" '; 
			}
			$ad_demo_company_name =  get_user_meta($user->ID, 'ad_demo_company_name', true );
			$userDropdown .= '<option value="'.$user->ID.'" '.$selected.'>'.$ad_demo_company_name.'</option>';
		}
		if($ad_type=='plain'){
			$ad_dropDown = '<option value="image">Image</option><option value="plain" selected="selected">Code</option>';
			$display_image = " style='display:none;'";
			$display_code = " style='display:block;'";
		}else{
			$ad_dropDown = '<option value="image" selected="selected">Image</option><option value="plain" >Code</option>';
			$display_image = " style='display:block;'";
			$display_code = " style='display:none;'";
		}
		echo '<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">AD Details</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" >
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" >
						<label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label>
						<select name="company" id="company" class="wpforms-field-medium validate[required]" style="display:block !important;">
						  <option value="">- select Company -</option>
						  '.$userDropdown.'
						</select>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Ad Link <span class="wpforms-required-label">*</span></label>
						<input type="text" id="ad_link" class="wpforms-field-medium validate[required]" name="ad_link" value="'.$ad_link.'" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date <span class="wpforms-required-label">*</span></label>
						<input type="text" id="start_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="start_date" value="'.$post_date_gmt.'" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="end_date" value="'.$expiry_date.'" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Ad Type</label>
						<select name="ad_type" id="ad_type" class="wpforms-field-medium validate[required]" style="display:block !important;" onChange="SelectAdType(this.id,this.value)">
						  '.$ad_dropDown.'
						</select>
					  </div>
					  <div id="ad_code_container" class="wpforms-field wpforms-field-text" '.$display_code.'>
						<label class="wpforms-field-label" for="wpforms-185-field_3">Code <span class="wpforms-required-label">*</span></label>
						<textarea name="code" id="code" class="wpforms-field-medium validate[required]" data-prompt-position="topRight:-85,3">'.$content_post->post_content.'</textarea>
					  </div>
					  <div id="ad_image_container" class="wpforms-field wpforms-field-text" data-field-id="22" '.$display_image.'>
						<label class="wpforms-field-label" for="wpforms-185-field_22">Creative<span class="wpforms-required-label">*</span></label>
						<img src="'.$src.'" id="ad_image_src" style="width:300px;height:250px;"/>
						<input type="file" id="ad_image" class="wpforms-field-medium" name="ad_image" value="" onChange="load_image(this.id,this.value)" />
					  </div>
					</div>
				  </form>
				</div>';die;
		
	}else{
		echo '<div class="wpforms-container wpforms-container-full" >
				  <div class="entry-title">
					<h3 style="float:left;">AD Details</h3>
				  </div>
				  <form id="wpforms-form-ad" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" >
				  <input type="hidden" name="action" value="submit">
					<div class="wpforms-field-container">
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" >
						<label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label>
						<select name="company" id="company" class="wpforms-field-medium validate[required]" style="display:block !important;">
						  <option value="">- select Company -</option>
						  '.$userDropdown.'
						</select>
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Ad Link <span class="wpforms-required-label">*</span></label>
						<input type="text" id="ad_link" class="wpforms-field-medium validate[required]" name="ad_link" value="" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Start Date <span class="wpforms-required-label">*</span></label>
						<input type="text" id="start_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="start_date" value="" >
						<span id="email_error" style="color:red;"></span> </div>
					  <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39">
						<label class="wpforms-field-label" for="wpforms-185-field_39">End Date </label>
						<input type="text" id="end_date" class="wpforms-field-medium validate[required]" autocomplete="off" name="end_date" value="" data-prompt-position="topRight:-85,3">
					  </div>
					  <div id="wpforms-185-field_3-container" class="wpforms-field">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Ad Type</label>
						<select name="ad_type" id="ad_type" class="wpforms-field-medium validate[required]" style="display:block !important;" onChange="SelectAdType(this.id,this.value)" >
						  <option value="image">Image</option>
						  <option value="plain">Code</option>
						</select>
					  </div>
					  <div id="ad_code_container" class="wpforms-field wpforms-field-text" style="display:none;">
						<label class="wpforms-field-label" for="wpforms-185-field_3">Code <span class="wpforms-required-label">*</span></label>
						<textarea name="code" id="code" class="wpforms-field-medium validate[required]" data-prompt-position="topRight:-85,3"></textarea>
					  </div>
					  <div id="ad_image_container" class="wpforms-field wpforms-field-text" data-field-id="22">
						<label class="wpforms-field-label" for="wpforms-185-field_22">Creative<span class="wpforms-required-label">*</span></label>
						<img src="" id="ad_image_src" style="width:300px;height:250px;display:none;"/>
						<input type="file" id="ad_image" class="wpforms-field-medium validate[required]" name="ad_image" value="" onChange="load_image(this.id,this.value)"/>
						
					  </div>
					</div>
				  </form>
				</div>';die;
		
		}
}
if(isset($_POST['mode']) && $_POST['mode']=='getAddUserPopup'){
	if($_POST['type'] =='Advertiser'){
		echo '<div class="wpforms-container wpforms-container-full" > <div class="entry-title"> <h3 style="float:left;">Advertiser Details</h3> </div> <form id="wpforms-form-ad-demo" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" > <div class="wpforms-field-container"> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" > <label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label> <input type="text" id="Company" class="wpforms-field-medium validate[required]" name="Company" value="" > </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half"> <label class="wpforms-field-label" for="wpforms-185-field_3">Agent <span class="wpforms-required-label">*</span></label> <input type="text" id="Agent" class="wpforms-field-medium validate[required]" name="Agent" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first"> <label class="wpforms-field-label" for="wpforms-185-field_3">Email Address <span class="wpforms-required-label">*</span></label> <input type="email" id="email" class="wpforms-field-medium validate[required,custom[email]]" onkeyup="checkUsername(jQuery(this).val())" name="email" value="" ><span id="email_error" style="color:red;"></span> </div> <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39"> <label class="wpforms-field-label" for="wpforms-185-field_39">Password </label> <input type="password" id="Password" class="wpforms-field-medium validate[required]"name="Password" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first mytooltip" data-field-id="22"> <label class="wpforms-field-label" for="wpforms-185-field_22">Street<span class="wpforms-required-label">*</span></label> <input type="text" id="Street" class="wpforms-field-medium validate[required]" name="Street" value="" > </div> <div id="wpforms-185-field_23-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="23"> <label class="wpforms-field-label" for="wpforms-185-field_23">Apt. #</label> <input type="text" id="Apt" class="wpforms-field-medium" name="Apt" value=""> </div> <div id="wpforms-185-field_24-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="24"> <label class="wpforms-field-label" for="wpforms-185-field_24">City <span class="wpforms-required-label">*</span></label> <input type="text" id="City" class="wpforms-field-medium validate[required]" name="City" value=""> </div> <div id="wpforms-185-field_25-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="25"> <label class="wpforms-field-label" for="wpforms-185-field_25">State <span class="wpforms-required-label">*</span></label> <input type="text" id="State" class="wpforms-field-medium validate[required]" name="State" value=""> </div> <div id="wpforms-185-field_26-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="26"> <label class="wpforms-field-label" for="wpforms-185-field_26">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" id="Zip" class="wpforms-field-medium validate[required] " name="Zip" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_28-container" class="wpforms-field wpforms-field-phone wpforms-one-half wpforms-first" data-field-id="28"> <label class="wpforms-field-label phone_label" for="wpforms-185-field_28">Cell <span class="wpforms-required-label">*</span></label> <input type="tel" id="Cell" class="wpforms-field-medium validate[required]" name="Cell" value="" > </div> </div> </form></div>';die;
	}else{
	if($_POST['user_id'] !='' || $_POST['type'] =='view'){
		$user_id = $_POST['user_id'];
		$user = get_user_by( 'id',$_POST['user_id']);
		$ad_demo_company_name = get_user_meta( $user_id, 'ad_demo_company_name', true);
		$ad_demo_agent = get_user_meta( $user_id, 'ad_demo_agent', true);
		$billing_address_1 = get_user_meta( $user_id, 'billing_address_1', true);
		$billing_address_2 = get_user_meta( $user_id, 'billing_address_2', true);
		$billing_city = get_user_meta( $user_id, 'billing_city', true);
		$billing_state = get_user_meta( $user_id, 'billing_state', true );
		$billing_postcode = get_user_meta( $user_id, 'billing_postcode', true );
		$billing_phone = get_user_meta( $user_id, 'billing_phone', true );
		
		echo '<div class="wpforms-container wpforms-container-full" > <div class="entry-title hide"> <h3 style="float:left;">AD DEMO Details</h3> </div> <form id="wpforms-form-ad-demo" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" > <div class="wpforms-field-container"> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" > <label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label> <input type="text" id="Company" class="wpforms-field-medium validate[required]" name="Company" value="'.$ad_demo_company_name.'"  > </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half"> <label class="wpforms-field-label" for="wpforms-185-field_3">Agent <span class="wpforms-required-label">*</span></label> <input type="text" id="Agent" class="wpforms-field-medium validate[required]" name="Agent" value="'.$ad_demo_agent.'"  data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first"> <label class="wpforms-field-label" for="wpforms-185-field_3">Email Address <span class="wpforms-required-label">*</span></label> <input type="email" id="email" class="wpforms-field-medium validate[required,custom[email]]" onkeyup="checkUsername(jQuery(this).val())" name="email" value="'.$user->user_email.'"  disabled="disabled"><span id="email_error" style="color:red;"></span> </div> <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39"> <label class="wpforms-field-label" for="wpforms-185-field_39">Password </label> <input type="password" id="Password" class="wpforms-field-medium validate[required]"name="Password" disabled="disabled"> </div> <div id="wpforms-185-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first mytooltip" data-field-id="22"> <label class="wpforms-field-label" for="wpforms-185-field_22">Street<span class="wpforms-required-label">*</span></label> <input type="text" id="Street" class="wpforms-field-medium validate[required]" name="Street" value="'.$billing_address_1.'"  > </div> <div id="wpforms-185-field_23-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="23"> <label class="wpforms-field-label" for="wpforms-185-field_23">Apt. #</label> <input type="text" id="Apt" class="wpforms-field-medium" name="Apt" value="'.$billing_address_2.'" > </div> <div id="wpforms-185-field_24-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="24"> <label class="wpforms-field-label" for="wpforms-185-field_24">City <span class="wpforms-required-label">*</span></label> <input type="text" id="City" class="wpforms-field-medium validate[required]" name="City" value="'.$billing_city.'" > </div> <div id="wpforms-185-field_25-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="25"> <label class="wpforms-field-label" for="wpforms-185-field_25">State <span class="wpforms-required-label">*</span></label> <input type="text" id="State" class="wpforms-field-medium validate[required]" name="State" value="'.$billing_state.'" > </div> <div id="wpforms-185-field_26-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="26"> <label class="wpforms-field-label" for="wpforms-185-field_26">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" id="Zip" class="wpforms-field-medium validate[required] " name="Zip" value="'.$billing_postcode.'" data-prompt-position="topRight:-85,3" > </div> <div id="wpforms-185-field_28-container" class="wpforms-field wpforms-field-phone wpforms-one-half wpforms-first" data-field-id="28"> <label class="wpforms-field-label" for="wpforms-185-field_28">Cell <span class="wpforms-required-label">*</span></label> <input type="tel" id="Cell" class="wpforms-field-medium validate[required]" name="Cell" value="'.$billing_phone.'"  > </div> </div> </form></div>';die;
		
	
	}else{
		echo '<div class="wpforms-container wpforms-container-full" > <div class="entry-title hide"> <h3 style="float:left;">AD DEMO Details</h3> </div> <form id="wpforms-form-ad-demo" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="#" > <div class="wpforms-field-container"> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-Company wpforms-one-half wpforms-first" > <label class="wpforms-field-label" for="Company">Company <span class="wpforms-required-label">*</span></label> <input type="text" id="Company" class="wpforms-field-medium validate[required]" name="Company" value="" > </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half"> <label class="wpforms-field-label" for="wpforms-185-field_3">Agent <span class="wpforms-required-label">*</span></label> <input type="text" id="Agent" class="wpforms-field-medium validate[required]" name="Agent" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first"> <label class="wpforms-field-label" for="wpforms-185-field_3">Email Address <span class="wpforms-required-label">*</span></label> <input type="email" id="email" class="wpforms-field-medium validate[required,custom[email]]" onkeyup="checkUsername(jQuery(this).val())" name="email" value="" ><span id="email_error" style="color:red;"></span> </div> <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-Password wpforms-one-half" data-field-id="39"> <label class="wpforms-field-label" for="wpforms-185-field_39">Password </label> <input type="password" id="Password" class="wpforms-field-medium validate[required]"name="Password" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first mytooltip" data-field-id="22"> <label class="wpforms-field-label" for="wpforms-185-field_22">Street<span class="wpforms-required-label">*</span></label> <input type="text" id="Street" class="wpforms-field-medium validate[required]" name="Street" value="" > </div> <div id="wpforms-185-field_23-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="23"> <label class="wpforms-field-label" for="wpforms-185-field_23">Apt. #</label> <input type="text" id="Apt" class="wpforms-field-medium" name="Apt" value=""> </div> <div id="wpforms-185-field_24-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="24"> <label class="wpforms-field-label" for="wpforms-185-field_24">City <span class="wpforms-required-label">*</span></label> <input type="text" id="City" class="wpforms-field-medium validate[required]" name="City" value=""> </div> <div id="wpforms-185-field_25-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="25"> <label class="wpforms-field-label" for="wpforms-185-field_25">State <span class="wpforms-required-label">*</span></label> <input type="text" id="State" class="wpforms-field-medium validate[required]" name="State" value=""> </div> <div id="wpforms-185-field_26-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="26"> <label class="wpforms-field-label" for="wpforms-185-field_26">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" id="Zip" class="wpforms-field-medium validate[required] " name="Zip" value="" data-prompt-position="topRight:-85,3"> </div> <div id="wpforms-185-field_28-container" class="wpforms-field wpforms-field-phone wpforms-one-half wpforms-first" data-field-id="28"> <label class="wpforms-field-label" for="wpforms-185-field_28">Cell <span class="wpforms-required-label">*</span></label> <input type="tel" id="Cell" class="wpforms-field-medium validate[required]" name="Cell" value="" > </div> </div> </form></div>';die;
		
		}
	}
}
if(isset($_POST['mode']) && $_POST['mode']=='getUserPopup'){
	if($_POST['type']=='dentist'){
		$dentist = get_user_by( 'id',$_POST['user_id']);
		$user_id = $_POST['user_id'];
		
		$designation = get_user_meta( $user_id, 'designation', true);
		$client_street = get_user_meta( $user_id, 'dentist_office_street', true);
		$client_apt_no = get_user_meta( $user_id, 'dentist_office_apt_no', true);
		$client_city = get_user_meta( $user_id, 'dentist_office_city', true);
		$client_state = get_user_meta( $user_id, 'dentist_office_state', true);
		$client_zip_code = get_user_meta( $user_id, 'dentist_office_zip_code', true);
		$client_cell_ph = get_user_meta( $user_id, 'dentist_personal_cell', true );
		
		$dentist_home_street = get_user_meta( $user_id, 'dentist_home_street', true);
		$dentist_home_apt_no = get_user_meta( $user_id, 'dentist_home_apt_no', true);
		$dentist_home_city = get_user_meta( $user_id, 'dentist_home_city', true);
		$dentist_home_state = get_user_meta( $user_id, 'dentist_home_state', true);
		$dentist_home_zip = get_user_meta( $user_id, 'dentist_home_zip', true);
		$state_dental_license_no = get_user_meta( $user_id, 'state_dental_license_no', true );
		$dentist_office_email = get_user_meta( $user_id, 'dentist_office_email', true );
		$dentist_personal_cell = get_user_meta( $user_id, 'dentist_personal_cell', true );
		
		
		echo '<div class="wpforms-container wpforms-container-full wpforms-stripe" id="wpforms-895"><div class="entry-title"><h3 style="float:left;">Dentist Details</h3> <!--<a style="margin:25px 0 0 60px;float:left;" href="'.home_url('/wp-admin/user-edit.php?user_id='.$_POST['user_id']).'" title="Edit">Edit</a>--></div> <form id="wpforms-form-895" class="wpforms-validate wpforms-form" data-formid="895" method="post" enctype="multipart/form-data" action="/new-dentist/" novalidate> <div class="wpforms-field-container"> <div id="wpforms-895-field_1-container" class="wpforms-field wpforms-field-name wpforms-two-thirds wpforms-firstwpforms-one-half wpforms-first" data-field-id="1"> <label class="wpforms-field-label" for="wpforms-895-field_1">Name <span class="wpforms-required-label">*</span></label> <div class="wpforms-field-row wpforms-field-large"> <div class="wpforms-field-row-block wpforms-first wpforms-one-half"> <input type="text" readonly id="wpforms-895-field_1" class="wpforms-field-name-first wpforms-field-required" name="wpforms[fields][1][first]" value="'.$dentist->first_name.'" required aria-required="true"> <label for="wpforms-895-field_1" class="wpforms-field-sublabel after ">First</label> </div> <div class="wpforms-field-row-block wpforms-one-half"> <input type="text" readonly id="wpforms-895-field_1-last" class="wpforms-field-name-last wpforms-field-required" name="wpforms[fields][1][last]" value="'.$dentist->last_name.'" required aria-required="true"> <label for="wpforms-895-field_1-last" class="wpforms-field-sublabel after ">Last</label> </div> </div> </div> <div id="wpforms-895-field_37-container" class="wpforms-field wpforms-field-select wpforms-one-third wpforms-one-thirdwpforms-one-half" data-field-id="37"> <label class="wpforms-field-label" for="wpforms-895-field_37">Designation <span class="wpforms-required-label">*</span></label><input type="text" readonly id="wpforms-895-field_1-last" class="wpforms-field-name-last wpforms-field-required" name="wpforms[fields][1][last]" value="'.$designation.'" required aria-required="true"> </div> <div id="wpforms-895-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first" data-field-id="3"> <label class="wpforms-field-label" for="wpforms-895-field_3">Email <span class="wpforms-required-label">*</span></label> <input type="email" id="wpforms-895-field_3" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][3]" value="'.$dentist->user_email.'" required aria-required="true"> </div> <div id="wpforms-895-field_16-container" class="wpforms-field wpforms-field-divider" data-field-id="16"> <h3 id="wpforms-895-field_16" name="wpforms[fields][16]">Licensed Dentist\'s address on file with the State Board of Dentistry</h3> </div> <div id="wpforms-895-field_17-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first" data-field-id="17"> <label class="wpforms-field-label" for="wpforms-895-field_17">Street <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_17" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][17]" value="'.$client_street.'" required aria-required="true"> </div> <div id="wpforms-895-field_18-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="18"> <label class="wpforms-field-label" for="wpforms-895-field_18">Suite #</label> <input type="text" readonly id="wpforms-895-field_18" class="wpforms-field-medium" name="wpforms[fields][18]" value="'.$client_apt_no.'"> </div> <div id="wpforms-895-field_19-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="19"> <label class="wpforms-field-label" for="wpforms-895-field_19">City <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_19" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][19]" value="'.$client_city.'" required aria-required="true"> </div> <div id="wpforms-895-field_20-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="20"> <label class="wpforms-field-label" for="wpforms-895-field_20">State <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_19" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][19]" value="'.$client_state.'" required aria-required="true"> </div> <div id="wpforms-895-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="22"> <label class="wpforms-field-label" for="wpforms-895-field_22">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_22" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][22]" value="'.$client_zip_code.'" required aria-required="true"> </div> <div id="wpforms-895-field_6-container" class="wpforms-field wpforms-field-divider" data-field-id="6"> <h3 id="wpforms-895-field_6" name="wpforms[fields][6]">Office address where treatment is administered</h3>  </div> <div id="wpforms-895-field_7-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first" data-field-id="7"> <label class="wpforms-field-label" for="wpforms-895-field_7">Street <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_7" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][7]" value="'.$dentist_home_street.'" required aria-required="true"> </div> <div id="wpforms-895-field_8-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="8"> <label class="wpforms-field-label" for="wpforms-895-field_8">Suite #</label> <input type="text" readonly id="wpforms-895-field_8" class="wpforms-field-medium" name="wpforms[fields][8]" value="'.$dentist_home_apt_no.'"> </div> <div id="wpforms-895-field_9-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="9"> <label class="wpforms-field-label" for="wpforms-895-field_9">City <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_9" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][9]" value="'.$dentist_home_city.'" required aria-required="true"> </div> <div id="wpforms-895-field_11-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="11"> <label class="wpforms-field-label" for="wpforms-895-field_11">State <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_9" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][9]" value="'.$dentist_home_state.'" required aria-required="true"> </div> <div id="wpforms-895-field_12-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="12"> <label class="wpforms-field-label" for="wpforms-895-field_12">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_12" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][12]" value="'.$dentist_home_zip.'" required aria-required="true"> </div> <div id="wpforms-895-field_14-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first" data-field-id="14"> <label class="wpforms-field-label" for="wpforms-895-field_14">Office Email <span class="wpforms-required-label">*</span></label> <input type="email" id="wpforms-895-field_14" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][14]" value="'.$dentist_office_email.'"  required aria-required="true"> </div> <div id="wpforms-895-field_15-container" class="wpforms-field wpforms-field-phone wpforms-one-half" data-field-id="15"> <label class="wpforms-field-label phone_label" for="wpforms-895-field_15">&nbsp;Office <span class="wpforms-required-label">*</span></label> <input type="tel" id="wpforms-895-field_15" class="wpforms-field-medium wpforms-field-required wpforms-masked-input"  name="wpforms[fields][15]" value="'.$dentist_personal_cell.'"  required aria-required="true"> </div> <div id="wpforms-895-field_23-container" class="wpforms-field wpforms-field-text" data-field-id="23"> <label class="wpforms-field-label" for="wpforms-895-field_23">State Dental License # <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-895-field_23" class="wpforms-field-large wpforms-field-required" name="wpforms[fields][23]" value="'.$state_dental_license_no.'"  required aria-required="true"> </div> </form></div>';die;
		
	}else{
	$seller = get_user_by( 'id',$_POST['user_id']);
	$client_street =  get_user_meta($_POST['user_id'], 'client_street', true );
	$client_apt_no =  get_user_meta($_POST['user_id'], 'client_apt_no', true );
	$client_city =  get_user_meta($_POST['user_id'], 'client_city', true );
	$client_state =  get_user_meta($_POST['user_id'], 'client_state', true );
	$client_zip_code =  get_user_meta($_POST['user_id'], 'client_zip_code', true );
	$client_cell_ph =  get_user_meta($_POST['user_id'], 'client_cell_ph', true );
	$client_home_ph =  get_user_meta($_POST['user_id'], 'client_home_ph', true );
	//print_r($seller);
	echo '<div class="wpforms-container wpforms-container-full" id="wpforms-185"><div class="entry-title"><h3 style="float:left;">Client Details</h3> <!--<a style="margin:25px 0 0 60px;float:left;" href="'.home_url('/wp-admin/user-edit.php?user_id='.$_POST['user_id']).'" title="Edit">Edit</a>--></div> <form id="wpforms-form-185" class="wpforms-validate wpforms-form" data-formid="185" method="post" enctype="multipart/form-data" action="#" novalidate> <div class="wpforms-field-container"> <div id="wpforms-185-field_1-container" class="wpforms-field wpforms-field-name check_name" data-field-id="1"> <label class="wpforms-field-label" for="wpforms-185-field_1">Name <span class="wpforms-required-label">*</span></label> <div class="wpforms-field-row wpforms-field-large"> <div class="wpforms-field-row-block wpforms-first wpforms-one-half"> <input type="text" readonly id="wpforms-185-field_1" class="wpforms-field-name-first wpforms-field-required" name="wpforms[fields][1][first]" value="'.$seller->first_name.'" required aria-required="true"> <label for="wpforms-185-field_1" class="wpforms-field-sublabel after ">First</label> </div> <div class="wpforms-field-row-block wpforms-one-half"> <input type="text" readonly id="wpforms-185-field_1-last" class="wpforms-field-name-last wpforms-field-required" name="wpforms[fields][1][last]" value="'.$seller->last_name.'" required aria-required="true"> <label for="wpforms-185-field_1-last"  class="wpforms-field-sublabel after ">Last</label> </div> </div> </div> <div id="wpforms-185-field_3-container" class="wpforms-field wpforms-field-email wpforms-one-half wpforms-first" data-field-id="3"> <label class="wpforms-field-label" for="wpforms-185-field_3">Email <span class="wpforms-required-label">*</span></label> <input type="email" id="wpforms-185-field_3" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][3]" value="'.$seller->user_email.'" required aria-required="true"> </div><div id="wpforms-185-field_22-container" class="wpforms-field wpforms-field-text wpforms-one-half wpforms-first mytooltip" data-field-id="22"> <label class="wpforms-field-label" for="wpforms-185-field_22">Street<span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-185-field_22" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][22]" value="'.$client_street.'" required aria-required="true"> </div> <div id="wpforms-185-field_23-container" class="wpforms-field wpforms-field-text wpforms-one-half" data-field-id="23"> <label class="wpforms-field-label" for="wpforms-185-field_23">Apt. #</label> <input type="text" readonly id="wpforms-185-field_23" class="wpforms-field-medium" name="wpforms[fields][23]" value="'.$client_apt_no.'"> </div> <div id="wpforms-185-field_24-container" class="wpforms-field wpforms-field-text wpforms-one-third wpforms-first" data-field-id="24"> <label class="wpforms-field-label" for="wpforms-185-field_24">City <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-185-field_24" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][24]" required aria-required="true" value="'.$client_city.'"> </div> <div id="wpforms-185-field_25-container" class="wpforms-field wpforms-field-select wpforms-one-third" data-field-id="25"> <label class="wpforms-field-label" for="wpforms-185-field_25">State <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-185-field_24" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][24]" required aria-required="true" value="'.$client_state.'"> </div> <div id="wpforms-185-field_26-container" class="wpforms-field wpforms-field-text wpforms-one-third" data-field-id="26"> <label class="wpforms-field-label" for="wpforms-185-field_26">Zip Code <span class="wpforms-required-label">*</span></label> <input type="text" readonly id="wpforms-185-field_26" class="wpforms-field-medium wpforms-field-required" name="wpforms[fields][26]" required aria-required="true" value="'.$client_zip_code.'"> </div> <div id="wpforms-185-field_28-container" class="wpforms-field wpforms-field-phone wpforms-one-half wpforms-first" data-field-id="28"> <label class="wpforms-field-label phone_label" for="wpforms-185-field_28">Mobile <span class="wpforms-required-label">*</span></label> <input type="tel" id="wpforms-185-field_28" class="wpforms-field-medium wpforms-field-required wpforms-masked-input"  name="wpforms[fields][28]" value="'.$client_cell_ph.'" required aria-required="true"> </div> <div id="wpforms-185-field_39-container" class="wpforms-field wpforms-field-phone wpforms-one-half" data-field-id="39"> <label class="wpforms-field-label phone_label" for="wpforms-185-field_39">Home </label> <input type="tel" id="wpforms-185-field_39" class="wpforms-field-medium wpforms-masked-input"name="wpforms[fields][39]" value="'.$client_home_ph.'"> </div> </div> </form></div>';die;
	}
}
if(isset($_POST['mode']) && $_POST['mode']=='checkBidUpdate'){
	$return = null;
	 if ( isset( $_POST['product_id'] ) && $_POST['product_id']  !="" ) {
			$product_data = wc_get_product($_POST['product_id']);
			if($product_data->get_curent_bid()!=$_POST['current_bid'] && $product_data->get_auction_current_bider() !=""){
				$posts_id = $_POST['product_id'];
				$current_user = wp_get_current_user();
				$_auction_max_current_bider = get_post_meta($_POST['product_id'], '_auction_max_current_bider', true );
				if($current_user->ID==$_auction_max_current_bider){
					$return['winner_screen']       = 'yes';
				}else{
					$return['winner_screen']       = 'no';
				}
				$return['curent_bid']       = $product_data->get_price_html();
				
				$return['curent_bid_value'] = $product_data->get_curent_bid();
				
				$return['curent_bider']     = $product_data->get_auction_current_bider();
				
				$return['curent_id']     	= $current_user->ID;
				
				$return['bid_value']        = $product_data->bid_value();
				
				$return['add_to_cart_text'] = $product_data->add_to_cart_text();
			}
	 }
	 wp_send_json($return);
	 //wp_send_json( apply_filters( 'simple_auction_get_price_for_auctions', $return ) );
	die();
}
if(isset($_POST['mode']) && $_POST['mode']=='getLink'){
	$query = "SELECT ID FROM wp_posts where post_title = '".$_POST['state_name']."' and post_type='mapsvg' limit 1";
	$Link_ID = $wpdb->get_var($query);
	echo $Link_ID;
	die;
}
if(isset($_POST['mode']) && $_POST['mode']=='checkLogin'){
	if (is_user_logged_in()){
		global $today_date_time_seconds,$wpdb;
		$_last_login_session = get_user_meta( $_POST['user_id'], '_last_login_session' , true );
		//$time = current_time( 'timestamp' );
		$timeplus5 = date('Y-m-d H:i:s', strtotime('+5 minutes',$_last_login_session));
		//$today_date_time_seconds.'=='.$timeplus5;
		if(strtotime($today_date_time_seconds) > strtotime($timeplus5 )){
			update_user_meta($_POST['user_id'], 'wpforms-pending', true );
			wp_destroy_current_session();
			wp_clear_auth_cookie();
			echo 'logout';
			//echo 'logout';
		}else{
			echo 'not_logout';
		}
	}else{
		die;
	}
}
if(isset($_POST['mode']) && $_POST['mode']=='update'){
	$product_id = $_POST['product_id'];
	update_post_meta( $product_id, '_auction_maximum_travel_distance', $_POST['_auction_maximum_travel_distance'] );
	$_auction_start_price = get_post_meta( $product_id, '_auction_start_price',TRUE);
	if($_POST['_new_price'] == $_auction_start_price){
		//$message_update = "<p style='color:red;'>Asking price should be greater than current price.</p>";
	}else{
		update_post_meta( $product_id, '_auction_start_price', $_POST['_new_price']);
		//$message_update = "<p style='color:green;'>Asking price has been successfully updated.</p>";
	}
	$_auction_start_price = get_post_meta( $product_id, '_auction_start_price',TRUE);
	$_auction_maximum_travel_distance = get_post_meta( $product_id, '_auction_maximum_travel_distance',TRUE);
	echo wc_price_ask_mujahid($_auction_start_price)."##".$_auction_maximum_travel_distance."##".$_auction_start_price;
	//$message_update = "<p style='color:green;'>Travel distance has been successfully updated to ".$_POST['_auction_maximum_travel_distance']." Miles.</p>";
}
if(isset($_POST['mode']) && $_POST['mode']=='track'){
	$ads = explode(",",$_POST['set_ads']);
	foreach($ads as $ad){
		track_ad_custom($ad,'wp_advads_impressions');
	}
}
if(isset($_POST['mode']) && $_POST['mode']=='checkExtend'){
	 $product_id = $_POST['product_id'] ;
	$_auction_dates_extend = get_post_meta($product_id, '_auction_dates_extend',TRUE);
	$_auction_extend_counter = get_post_meta($product_id, '_auction_extend_counter',TRUE);
	$product = get_product($product_id);
	$auctionend = new DateTime($product->get_auction_dates_to());
	$auctionendformat = $auctionend->format('Y-m-d H:i');
	$time = current_time( 'timestamp' );
	//echo $_auction_dates_extend."==". $_auction_extend_counter;
	if(($_auction_dates_extend=='yes' && $_auction_extend_counter=='yes')){
		$timeplus5 = date('Y-m-d H:i:s', strtotime('+5 minutes', $time));
		$auctionend->add(new DateInterval('PT305S'));
		update_post_meta($product_id, '_auction_dates_to', $auctionend->format('Y-m-d H:i:s') );
		//update_post_meta( $data['product_id'], '_auction_dates_extend', 'yes' );
		update_post_meta($product_id, '_auction_extend_counter', 'no' );
		update_post_meta($product_id, '_auction_extend_first_time', 'no' );
		update_post_meta($product_id, '_extend_time_start', '' );
		echo 'yes';	
	}else if(strtotime($auctionendformat) > $time){
		echo 'yes';
	}else{
		/*$endTime = new DateTime($product->get_auction_dates_to());
		$startTime = date('Y-m-d H:i:s', strtotime('-5 minutes',$endTime->format('Y-m-d H:i:s')));
		$bid_count = $wpdb->get_var("SELECT count(id) as count FROM wp_simple_auction_log WHERE auction_id = '".$data['product_id']."' and date BETWEEN '".$startTime."' AND '".$endTime."' LIMIT 1");*/
		echo 'no';
		/*if($_auction_dates_extend=='yes'){
			echo 'yes';	
		}else{
			echo 'no';
		}*/
	}
}
die;
?>