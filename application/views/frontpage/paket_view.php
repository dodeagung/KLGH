
<!--=================================
 inner-intro-->

<section class="inner-intro bg-2 bg-opacity-white-70">
  <div class="container">
     <div class="row text-center intro-title">
            <h1 class="text-blue">Pricing Service</h1>
            <p class="text-grey">Our Service Plan</p>
            <ul class="page-breadcrumb">
               <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
              <li><a href="#">Pricing Plan</a></li>
           </ul>
     </div>
  </div>
</section>

<!--=================================
 inner-intro-->

 
 <!--=================================
 pricing -->
 
 <section class="page-section-ptb">
  <div class="pricing">
   <div class="container">
    <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 hidden-xs">
       <div class="pricing-table active compare text-center">
         <div class="pricing-title plan">
			 <h2 class="text-white text-bg"></h2>
			 <span></span>
			 <div class="pricing-prize">
			   <h2 class="text-white">Our Plan</h2>
			   <span></span>
			 </div>   
         </div>
       <div class="pricing-list">
         <ul>
           <li>Target Signal / Month</li>
           <li>Target (pipettes)</li>
           <li>Entry & Exit</li>
           <li>Trade Ideas</li>       
		   <li>Whatsapp Signal</li>
           <li>Email Signal</li>
           <li>Big Trade Signal</li>
           <li>Comodity Signal</li>		  
		   <li>News Trading Signal</li>
           <li>Trend Reversal Signal</li>
           <li>Email Support</li>
           <li>Personal Assistant</li>
         </ul>
       </div>
       
     </div>
    </div>	
	<div class="col-lg-2 col-md-2 col-sm-6">
        <div class="pricing-table text-center mb-20">
         <div class="pricing-title">
           <h2><?=$this->common->paketname($plan->row()->name)?></h2>
           <span>Starting at</span>
         <div class="pricing-prize">
           <h2 class="text-blue">$ <?=$plan->row()->cost?>,-</h2>
           <span>Per month</span>
         </div>  
       </div>
       <div class="pricing-list">
         <ul>
           <li>1 to 2 Signals</li>
           <li>-</li>
           <li>Basic Setup</li>
           <li>2 Trade Ideas</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Whatsapp Signal</li> 
		   <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
		   <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
         </ul>
       </div>
       <div class="pricing-order">
		<?=form_open_multipart($this->common->slug_link('join/plan/1'));	?>
			<button type="submit" class="btn button-border-white">Order Now</button>
		<?=form_close(); ?>
       </div>
     </div>
    </div>
	<div class="col-lg-2 col-md-2 col-sm-6">
        <div class="pricing-table text-center mb-20">
         <div class="pricing-title">
           <h2><?=$this->common->paketname($plan->row(1)->name)?></h2>
           <span>Starting at</span>
         <div class="pricing-prize">
           <h2 class="text-blue">$ <?=$plan->row(1)->cost?>,-</h2>
           <span>Per month</span>
         </div>  
       </div>
       <div class="pricing-list">
         <ul>
           <li>5 to 10 Signals</li>
           <li>+900 to +3000 Points</li>
           <li>Accurate</li>
           <li>7 Trade Ideas</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Whatsapp Signal</li> 
		   <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
		   <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
         </ul>
       </div>
       <div class="pricing-order">
		<?=form_open_multipart($this->common->slug_link('join/basic-signal'));	?>
			<button type="submit" class="btn button-border-white">Order Now</button>
		<?=form_close(); ?>
       </div>
     </div>
    </div>
	<div class="col-lg-3 col-md-3 col-sm-6">
       <div class="pricing-table active text-center">
        <div class="pricing-ribbon">
          <img src="<?php echo $this->common->theme_link(); ?>images/ribbon.png" alt="">
        </div>
        <div class="pricing-title">
           <h2 class="text-white text-bg"><?=$this->common->paketname($plan->row(2)->name)?></h2>
           <span>Starting at</span>
         <div class="pricing-prize">
           <h2 class="text-white">$ <?=$plan->row(2)->cost?>,-</h2>
           <span>Per month</span>
         </div>  
       </div>
       <div class="pricing-list">
         <ul>
           <li>10 to 15 Signals</li>
           <li>+3000 to +7000 Points</li>
           <li>Accurate</li>
           <li>up to 10 Trade Ideas</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>   
		   <li class="visible-xs" >Whatsapp Signal</li> 		   
		   <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Email Signal</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
		   <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >News Trading Signa</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Trend Reversal Signal</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-remove"></i></li>
		   
         </ul>
       </div>
       <div class="pricing-order">
	   <?=form_open_multipart($this->common->slug_link('join/pro-signal'));	?>
			<button type="submit" class="btn button-border-white">Order Now</button>
		<?=form_close(); ?>

       </div>
     </div>
    </div>
	<div class="col-lg-2 col-md-2 col-sm-6">
       <div class="pricing-table pricing-table-border text-center">
        <div class="pricing-title">
           <h2><?=$this->common->paketname($plan->row(3)->name)?></h2>
           <span>Starting at</span>
         <div class="pricing-prize">
           <h2 class="text-blue">$ <?=$plan->row(3)->cost?>,-</h2>
           <span>Per month</span>
         </div>  
       </div>
       <div class="pricing-list">
         <ul>
                      <li>20 to 30 Signals</li>
           <li>+7000 to +15000 Points</li>
           <li>Accurate</li>
           <li>up to 15 Trade Ideas</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>   
		   <li class="visible-xs" >Whatsapp Signal</li> 		   
		   <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Email Signal</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Big Trade Signal</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Comodity Signal</li>		   
		   <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >News Trading Signa</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Trend Reversal Signal</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Email Support</li>
           <li class="hidden-xs"><i class="glyphicon glyphicon-ok"></i></li>
		   <li class="visible-xs" >Personal Assistant</li>
         </ul>
       </div>
       <div class="pricing-order">
	   <?=form_open_multipart($this->common->slug_link('join/premium-signal'));	?>
			<button type="submit" class="btn button-border-white">Order Now</button>
		<?=form_close(); ?>
       </div>
      </div>
     </div>
   </div>
  </div>
 </div>
 </section>
 
<!--=================================
 pricing -->

