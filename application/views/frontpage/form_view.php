<!--=================================
   inner-intro-->
<section class="inner-intro bg-opacity-white-70 visible-xs mt-20">
   <div class="container">
      <div class="row text-center intro-title">
         <h1 class="text-blue">Enquiry Plan</h1>
         <p class="text-grey">Customer Details</p>
         <ul class="page-breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
            <li><a href="#">Enquiry</a></li>
         </ul>
      </div>
   </div>
</section>

<section class="inner-intro bg-2 bg-opacity-white-70 hidden-xs">
   <div class="container">
      <div class="row text-center intro-title">
         <h1 class="text-blue">Enquiry Plan</h1>
         <p class="text-grey">Customer Details</p>
         <ul class="page-breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
            <li><a href="#">Enquiry</a></li>
         </ul>
      </div>
   </div>
</section>
<!--=================================
   inner-intro-->
<!--=================================
   faq-->
<section class="faq white-bg page-section-ptb">
   <div class="container">
      <?php 
         $attributes = array('class' => 'checkout kl-store-checkout', 'name' => 'checkout','id' => 'checkout','enctype' => 'multipart/form-data');
         $hidden = array('paket' => $planselected->ID);
         echo form_open('join/submit', $attributes,$hidden);	?>
      <div class="row">
         <div class="col-lg-<?=($planselected->ID!=1)?"9":"12"?> col-md-<?=($planselected->ID!=1)?"9":"12"?>">
            <div id="register-form" class="register-form">
               <div class="row">
                  <div class="section-field col-md-12">
                     <label for="name">Your Name* <span class="errorform"><?php echo form_error('first_name'); ?></span></label>
                     <div class="field-widget">
                        <i class="fa fa-pencil"></i>
                        <input  type="text" placeholder="Your Name" name="first_name" value="<?php if(isset($datakirim['first_name']))echo $datakirim['first_name']?>">
                     </div>
                  </div>
               </div>
               <div class="section-field">
                  <label for="email">Email * <span class="errorform"><?php echo form_error('email'); ?></span></label>
                  <div class="field-widget">
                     <i class="fa fa-envelope"></i>
                     <input  class="email" type="text" placeholder="Enter your email" name="email" value="<?php if(isset($datakirim['email']))echo $datakirim['email']?>">
                  </div>
               </div>
               <div class="section-field">
                  <label for="emailpaypal">Paypal Email Account <span class="errorform"><?php echo form_error('emailpaypal'); ?></span></label>
                  <div class="field-widget">
                     <i class="fa fa-envelope"></i>
                     <input  class="email" id="emailpaypal" type="text" placeholder="Enter your email paypal" name="emailpaypal" value="<?php if(isset($datakirim['emailpaypal']))echo $datakirim['emailpaypal']?>">
                  </div>
               </div>
				<div class="row">
				   <div class="section-field col-md-6">
						<label for="phone">Country Phone Code *<span class="errorform"></span></label>
						  <div class="field-widget">
							 <select name="phonecode" id="phonecode" class="input-text ">
								<?php foreach($phonecode as $key=>$ds) : ?>
								<option value="<?=$ds['dial_code']; ?>" <?php if(isset($dial_code))if($dial_code == $ds['dial_code']) echo "selected"; ?> >
								   <?=$ds['name'];?> (<?=$ds['dial_code'];?>)
								</option>
								<?php endforeach;?>
							 </select>
						  </div>
				   </div>				 
					<div class="section-field col-md-6">
					  <label for="phone">Whatsapp No *<span class="errorform"><?php echo form_error('phone'); ?></span></label>
					  <div class="field-widget">
						 <i class="fa fa-mobile"></i>
						 <input id="phone" class="phone" type="text" placeholder="exp. 878 220 63223" name="phone" value="<?php if(isset($datakirim['phone']))echo $datakirim['phone']?>">
					  </div>
				   </div>
				</div>
               <div class="section-field">
                  <label for="phone">Address *<span class="errorform"><?php echo form_error('address_1'); ?></span></label>
                  <div class="field-widget">
                     <i class="fa fa-map-marker"></i>
                     <input id="address_1" class="address_1" type="text" placeholder="Enter your address" name="address_1" value="<?php if(isset($datakirim['address_1']))echo $datakirim['address_1']?>">
                  </div>
               </div>
               <div class="section-field">
                  <label for="phone">Select Country *<span class="errorform"><?php echo form_error('state'); ?></span></label>
                  <div class="field-widget">
                     <i class="fa fa-map-marker"></i>
                     <input id="state" class="state" type="text" placeholder="Enter your nationality" name="state" value="<?php if(isset($datakirim['state']))echo $datakirim['state']?>">
                  </div>
               </div>
               <?php if ($planselected->ID!=1):?>
               <div class="section-field">
                  <label for="phone">Subscribe Plan *</label>
                  <div class="field-widget">
                     <select name="dosID" id="dos" class="input-text ">
                        <?php foreach($dos as $key=>$ds) : ?>
                        <option value="<?=$ds->ID; ?>" data-factor="<?=$totalplanpriceonduration[$key];?>"  <?php if(isset($dosID))if($dosID == ($key+1)) echo "selected"; ?> >
                           <?=$ds->duration;?> - (price plan USD <?=$planpriceonduration[$key];?>/month)
                        </option>
                        <?php endforeach;?>
                     </select>
                  </div>
               </div>
               <?else:?>
					<input type="hidden" name="dosID" value="1" />
               <?endif;?>
               <div class="section-field">
                  <label for="captcha">Please enter this captcha below <span class="errorform"><?php if(isset($captchastat))echo $captchastat;?></span></label>
                  <div class="field-widget">
                     <input  class="captcha gui-input" type="text" placeholder="" name="captcha">
                     <label class="button cap" for="verify"><?php echo $cap['image'] ?></label>
                  </div>
               </div>
               <div class="section-field">
                  <div class="remember-checkbox">
                     <input type="checkbox" name="check_agree" id="check_agree" value = 'agree' />
                     <label for="check_agree">Accept our <a href="<?=site_url("home/tos")?>" target="_blank"> Terms of Use, Policies and Disclaimers.</a><span class="errorform"><?php if(isset($nochecked))echo "*Please check this, if you agree"?></span></label>
                  </div>
               </div>
			   
            </div>
			<?php if ($planselected->ID == 1):?>
					<input type="hidden" name="payment_method" value="Free" />
					<input type="submit" class="daftar button-border" name="kl-store_checkout_free" id="place_order2" value="Submit" data-value="Submit">
				<?php endif; ?> 
         </div>
		 <?php if ($planselected->ID!=1):?>
         <div class="col-lg-3 col-md-3">
            <div class="faq-form">
               <h4 class="mb-30">Your Detail Order</h4>
               <div id="order_review" class="kl-store-checkout-review-order">
                  <table class="shop_table kl-store-checkout-review-order-table">
                     <thead>
                        <tr>
                           <th class="product-name">
                              Product
                           </th>
                           <th class="product-total">
                              Total
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr class="cart_item">
                           <td class="product-name">
                              <span class ="name"><strong><?php echo $planselected->name;?></strong></span> 
                              <span class ="duration">x <span class ="duration_value"><?php echo (isset($dosID))?($dos[$dosID-1]->duration):"1 month";?></span> </span>
                           </td>
                           <td class="product-total currency amountbase">USD <span class="priceamount"><?php echo (isset($dosID))?($totalplanpriceonduration[$dosID-1]):$planselected->cost;?></span></td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr class="order-total">
                           <th>
                              <span class ="name">Total</span>
                           </th>
                           <td>
                              <strong><span class="amount currency">USD <span class="priceamount"><?php echo (isset($dosID))?($totalplanpriceonduration[$dosID-1]):$planselected->cost;?></span></span></strong>
                           </td>
                        </tr>
                     </tfoot>
                  </table>
                  <div id="payment" class="kl-store-checkout-payment">
                     <label for="phone">Payment Method</label>
                     <div class="field-widget transfer-method">
                        <select name="payment_method" id="payment_method">
                           <option value="bank" <?php if(isset($payment_method))if($payment_method == "bank") echo "selected"; ?>>Bank Transfer</option>
                           <option value="paypal" <?php if(isset($payment_method))if($payment_method == "paypal") echo "selected"; ?> >Paypal Transfer</option>
                        </select>
                     </div>
                     <div class="form-row place-order">
                        <noscript>
                           Since your browser does not support JavaScript, or it is disabled, please ensure you click the &lt;em&gt;Update Totals&lt;/em&gt; button before placing your order. You may be charged more than the amount stated above if you fail to do so.&lt;br/&gt;&lt;input type="submit" class="button alt" name="kl-store_checkout_update_totals" value="Update totals" /&gt;
                        </noscript>
                     </div>
                     <div class="clear">
                     </div>
                  </div>
               </div>
               <input type="submit" class="daftar button-border" name="kl-store_checkout_place_order" id="place_order1" value="Submit" data-value="Submit">
               <label></label>
            </div>
         </div>
		 <?php endif; ?>
      </div>
      <?php echo form_close(); ?>
   </div>
</section>


<!--=================================
   faq-->