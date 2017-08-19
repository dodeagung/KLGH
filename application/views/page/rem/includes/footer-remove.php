<?php
	$plugin_url = base_url()."theme_costume/";
?>
 <footer>
        <div class="container">
            <div class="row ">
                <div class="col-md-3 col-sm-3">
                    <p id="logo_footer">
                        <img src="<?php echo $plugin_url; ?>img/logo.png" width="220" height="40" alt="Atena" data-retina="true">
                    </p>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4>About</h4>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Terms and condition</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4>Sertifikasi</h4>
                    <ul>
                        <li><a href="#">Skema Sertifikasi</a></li>
                        <li><a href="#">Alur Sertifikasi</a></li>
                        <li><a href="#">Tempat Uji Kompetensi</a></li>
                        <li><a href="#">Pendaftaran</a></li>
                        <li><a href="#">Kunjungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3">
                    <h4>Contact us</h4>
                    <ul>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Plan a visit</a></li>
                    </ul>
                    <ul id="contacts_footer">
                        <li>Info line - <a href="tel://087822063853">+0878 22063853</a></li>
                        <li>Email - <a href="#">info@lspbali.or.id</a></li>
                    </ul>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        </footer><!-- End footer -->
        <div id="copy">
            <div class="container">
                 © 2016
            </div>
        </div><!-- End copy -->



 <!-- Login modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<form action="#" class="popup-form" id="myLogin">
					<input type="text" class="form-control form-white" placeholder="Username">
					<input type="text" class="form-control form-white" placeholder="Password">
					<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" value="accept_1" id="check_1" name="check_1" />
							<label for="check_1"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
						</div>
					</div>
					<button type="submit" class="btn btn-submit">Submit</button>
				</form>
			</div>
		</div>
	</div>

<!-- Common scripts -->
<script src="<?php echo $plugin_url; ?>js/jquery/jquery-2.1.3.min.js"></script>

<script src="<?php echo $plugin_url; ?>js/common_scripts_min.js"></script>
<script src="<?php echo $plugin_url; ?>js/functions.js"></script>
<script src="<?php echo $plugin_url; ?>assets/validate.js"></script>

<!-- Common scripts -->
<script src="<?php echo $plugin_url; ?>plugin/tree/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo $plugin_url; ?>plugin/tree/js/jquery-ui.js"></script>
<script src="<?php echo $plugin_url; ?>plugin/tree/js/jquery.tree.js"></script>

</body>
</html>
