
<section class="payment inner-intro bg-opacity-white-70">
  <div class="container">
     <div class="row text-center intro-title">
			<?php if ($idplan!=1):?>
	            <h1 class="text-grey">Confirm Order Payment via <?php echo $tipe_payment; ?></h1>
			<?php else: ?>
	            <h1 class="text-grey">Registration Free Member, CONFIRMED!</h1>
			<?php endif; ?>
            
     </div>
  </div>
</section>

<section class="contact payment-content white-bg page-section-ptb">
  <div class="container">
	<?php if ($idplan!=1):?>
    <div class="row">
       <div class="col-lg-12 col-md-12">
        <div class="section-title-1 text-center">
		<p>invoice amount :</p>
			<p><?=$amount?> + <?=$code_unique?>(Unique Code) </p>
          <h1 class="text-blue"><?php echo (($currency_code=='IDR')?$this->common->formatIDR($amountsum):($currency_symbol." ".$amountsum)) ?></h1>
          <div class="title-line"></div>
          <p>invoice no : <?php echo $invoice_no ?></p>
		  <p class="mt-50 mb-30">Please make a payment with <b>exact amount </b> in the following account before <?php echo $deadline ?> ( 12 hours).</p>
        </div>
		
      </div>
	  
    </div>
	<?php endif;?>
	<?php if ($payment_method == "bank"): ?>
     <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="contact-box text-center">
              <img alt="Logo BCA" src="<?php echo $this->common->theme_link()."/images/bank_logo/BCA.png" ?>" style="height: 32px">
              <p class="mt-20">Rekening : 7725233124<br/> a/n: Anak Agung Gede Mahendra</p>
           </div>
       </div>      
<!--	   <div class="col-lg-3 col-md-3 col-sm-3">
           <div class="contact-box text-center">
              <img alt="Logo BNI" src="<?php echo $this->common->theme_link()."/images/bank_logo/BNI.png" ?>" style="height: 32px">
              <p class="mt-20">Rekening : 0551260982<br/> a/n: Anak Agung Gede Mahendra</p>
           </div>
       </div>
		<div class="col-lg-3 col-md-3 col-sm-3">
           <div class="contact-box text-center">
              <img alt="Logo MANDIRI" src="<?php echo $this->common->theme_link()."/images/bank_logo/MANDIRI.png" ?>" style="height: 52px">
              <p class="mt-20">Rekening : 145-00-1174348-7<br/> a/n: Anak Agung Gede Mahendra</p>
           </div>
       </div>	
	   <div class="col-lg-3 col-md-3 col-sm-3">
           <div class="contact-box text-center">
              <img alt="Logo BRI" src="<?php echo $this->common->theme_link()."/images/bank_logo/BRI.png" ?>" style="height: 32px">
              <p class="mt-20">Rekening : 0557-01-000229-56-4 <br/> a/n: Anak Agung Gede Mahendra</p>
           </div>
       </div> -->
	</div>
     <?php elseif($payment_method == "paypal" ):?>
	 <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="contact-box text-center">
              <img alt="Logo Paypal" src="<?php echo $this->common->theme_link()."/images/bank_logo/paypal.png" ?>">
              <p class="mt-20">Paypal Account : <b>bossfxsignal@gmail.com </b><br/></p>
              <p class="mt-20">For direct action, you could use following link :  <br><b><a class="button button-blue mt-15 pt-10 pb-10 pl-10 pr-10" href="https://paypal.me/bossfxsignal/<?=$amountsum?>" target="_blank">https://paypal.me/bossfxsignal/<?=$amountsum?> </a> </b><br/></p>
           </div>
       </div>	   
	</div>
	<?php endif;?>
      <div class="row">
      <div class="col-lg-12 col-md-12 text-center">
       
      </div>
     </div>
    <div class="page-section-pt"> 
     <div class="row">
       <div class="col-lg-12 col-md-12">
        <div class="section-title-1 text-center">
          <h1 class="text-blue">Additional info</h1>
          <div class="title-line"></div>
          
        </div>
      </div>
    </div>      
     <div class="row">
       <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="feature-3">
            <div class="feature-3-title">
              <span class="icon-clock" aria-hidden="true"></span>
            </div>
            <div class="feature-3-info work-hr">
              <h3 class="text-back mb-20">Business Hours</h3>
              <p>Our Support team is available from <br/>
                <b>Monday to Friday :</b> 10 a.m. – 7 p.m. (GMT +8)<br/>
                <b>Saturday : </b> 9 a.m. – 1 p.m. (GMT +8)<br/>
                <b>Sunday : </b> Closed
                </p>
            </div>
         </div>
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="feature-3">
            <div class="feature-3-title">
              <span class="icon-support" aria-hidden="true"></span>
            </div>
            <div class="feature-3-info">
              <h3 class="text-back mb-20">Our Support Center</h3>
				 <ul class="addresss-info text-black"> 
					<li><i class="fa fa-phone"></i>+62 897-8893-169</li>
					<li><i class="fa fa-envelope-o"></i>info@bossforexsignal.com</li>
				  </ul>
            </div>
         </div>
       </div>
       <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="feature-3">
            <div class="feature-3-title">
              <span class="icon-info" aria-hidden="true"></span>
            </div>
            <div class="feature-3-info">
              <h3 class="text-back mb-20">Some Information</h3>
              <p>After 2 hours of payment and your bill still has not been processed, please kindly confirm it by email to: <br>Info@bossforexsignal.com [Subject: Payment BossForexSignal.com]
                </p>
            </div>
         </div>
       </div>
     </div> 
  </div>
 </div>
</section>
