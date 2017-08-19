<!-- / Header style 1 -->
	<!--End of Header -->
	<!-- Page sub-header + Bottom mask style 3 -->
		<div id="page_header2" class="page-subheader">
			
			<!-- Sub-Header content wrapper -->
			<div class="ph-content-wrap">
				<div class="ph-content-v-center">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<!-- Breadcrumbs -->
								<ul class="breadcrumbs fixclear">
									<li><a href="index-2.html">Home</a></li>
									<li>Package</li>
								</ul>
								<!--/ Breadcrumbs -->

								<!-- Current date -->
								<span id="current-date" class="subheader-currentdate"> tanggal</span>
								<!--/ Current date -->
								<div class="clearfix"></div>
							</div>
							<!--/ col-sm-6 -->
							<div class="col-sm-6">
								<!-- Sub-header titles -->
								<div class="subheader-titles">
									<h2 class="subheader-maintitle">SELECT A PACKAGE</h2>
									<h4 class="subheader-subtitle">FEW MORE STEPS</h4>
								</div>
								<!--/ Sub-header titles -->
							</div>
							<!--/ col-sm-6 -->
						</div>
						<!-- end row -->
					</div>
					<!--/ container -->
				</div>
				<!--/ .ph-content-v-center -->
			</div>
			<!--/ Sub-Header content wrapper -->

			<!-- Sub-header Bottom mask style 3 -->
			<div class="kl-bottommask kl-bottommask--mask3">
				<svg width="5000px" height="57px" class="svgmask " viewBox="0 0 5000 57" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <defs>
				        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask3">
				            <feOffset dx="0" dy="3" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
				            <feGaussianBlur stdDeviation="2" in="shadowOffsetInner1" result="shadowBlurInner1"></feGaussianBlur>
				            <feComposite in="shadowBlurInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowInnerInner1"></feComposite>
				            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.4 0" in="shadowInnerInner1" type="matrix" result="shadowMatrixInner1"></feColorMatrix>
				            <feMerge>
				                <feMergeNode in="SourceGraphic"></feMergeNode>
				                <feMergeNode in="shadowMatrixInner1"></feMergeNode>
				            </feMerge>
				        </filter>
				    </defs>
				    <path d="M9.09383679e-13,57.0005249 L9.09383679e-13,34.0075249 L2418,34.0075249 L2434,34.0075249 C2434,34.0075249 2441.89,33.2585249 2448,31.0245249 C2454.11,28.7905249 2479,11.0005249 2479,11.0005249 L2492,2.00052487 C2492,2.00052487 2495.121,-0.0374751261 2500,0.000524873861 C2505.267,-0.0294751261 2508,2.00052487 2508,2.00052487 L2521,11.0005249 C2521,11.0005249 2545.89,28.7905249 2552,31.0245249 C2558.11,33.2585249 2566,34.0075249 2566,34.0075249 L2582,34.0075249 L5000,34.0075249 L5000,57.0005249 L2500,57.0005249 L1148,57.0005249 L9.09383679e-13,57.0005249 Z" class="bmask-bgfill" filter="url(#filter-mask3)" fill="#f5f5f5"></path>
				</svg>
			    <i class="glyphicon glyphicon-chevron-down"></i>
		    </div>
		    <!--/ Sub-header Bottom mask style 3 -->
		</div>
        <!--/ Page sub-header + Bottom mask style 3 -->

		
		
		
		<!---Checkout Page START -->
		
		
        <!-- Checkout content page -->
        <section id="content" class="hg_section ptop-10">          
			<div class="container">
				<div class="row">
					<div class="right_sidebar col-md-12">
						<!-- Page title & subtitle -->
						
						<div class="text_box">
							<div class="kl-store">
								<?php 
									$attributes = array('id'=>'my-awesome-dropzone','class' => 'checkout kl-store-checkout', 'name' => 'checkout');
															
									echo form_open_multipart('payment/submit', $attributes);
								?>
									<div class="col-md-8" id="customer_details">
										<div class="col-1">
											<div class="kl-store-billing-fields">
												<h3>Customer Details</h3>												
												<p class="form-row form-row form-row-first validate-required" id="bank_field">
													<label for="bank" class="">Transfer Destination<abbr class="required" title="required">*</abbr></label>
													
													<select name="bank" id="bank" class="input-text ">														<?php foreach($selectdata as $key =>$bank): ?>
														<option value="<?=$key?>" <?php if(isset($selectbank))if($selectbank == ($key)) echo "selected"; ?>><?=$bank?></option> 
														<?php endforeach;?>
													</select>
												</p>																																<p class="form-row form-row form-row-last validate-required" id="invoice_field">
													<label for="invoice" class="">Invoice No.<abbr class="required" title="required">*</abbr><span class="errorform"><?php echo form_error('invoiceno'); ?></span></label>
													<input type="text" class="input-text " value="" placeholder="Your Invoice No..." name="invoiceno" id="invoiceno">

												</p>																		<div class="clear"/>												<p class="form-row form-row form-row-first address-field validate-state" id="sender_field">													<label for="sender" class="">Sender Name<span class="errorform"><?php echo form_error('sender'); ?></span></label>																										<input type="text" class="input-text " value="" placeholder="Your Account Name..." name="sender" id="sender">												</p>												<p class="form-row form-row form-row-last address-field validate-required validate-postcode" id="email_field">													<label for="postcode" class="">Email Paypal(paypal transfer) <abbr class="required" title="required">*</abbr><span class="errorform"><?php echo form_error('email'); ?></span></label>																										<input type="text" class="input-text " name="email" id="email" placeholder="Your Email..." value="">												</p>													
												<p class="form-row form-row form-row-first validate-required validate-phone" id="amount_field">
													<label for="amount" class="">Amount Transfer<abbr class="required" title="required">*</abbr><span class="errorform"><?php echo form_error('amount'); ?></span></label>
													
													<input type="text" class="input-text " name="amount" id="amount" placeholder="Amount Transfer..." value="">
												</p>   

												<p class="form-row form-row form-row-last address-field validate-required" id="date_field">
													<label for="date" class="">Date Transfer <abbr class="required" title="required">*</abbr><span class="errorform"><?php echo form_error('date_transfer'); ?></span></label>
													<input type="text" class="form-control styled required" id="date_transfer" name="date_transfer" data-date-format="dd/MM/yyyy"  placeholder="dd/mm/year">  													
																									</p>
												<p class="form-row form-row form-row-wide address-field" id="printout_field">													<label for="printout" class="">Transfer Printout <abbr class="required" title="Transfer Screenshot">*</abbr></label>													<input type="file" name="userfile" size="20" />
												</p>												
												<div class="clear">
												</div>																																	<p class="form-row form-row form-row-wide address-field" id="printout_field">													<input type="submit" class="button alt" name="kl-store_checkout_place_order" id="place_order" value="Submit" data-value="Place order">												</p>
											</div>
										</div>
										
									</div>
									
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
					<!--/  -->


				</div>
				<!--/ row -->
			</div>
			<!--/ container -->
		</section>
		<!--/ Checkout  content page -->

	
		
		<!---Checkout Page END -->
	