	<!-- Page Footer-->
    	<footer class="main-footer">
            <div class="container-fluid">
	            <div class="row">
	                <div class="col-sm-6">
	                  <p>VẬN CHUYỂN HÀNG 24H &copy; 2017-2019</p>
	                </div>
	                <div class="col-sm-6 text-right">
	                  <p>Design by <a href="#" class="external">LeeIT</a></p>
	                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
	                </div>
	            </div>
            </div>
        </footer>
    </div>
    </div>
    </div>

    <?php  
	enqueueScripts(
		array(
				'jquery'  	    	=> assets('js/jquery.min.js'),
				'tether'  	    	=> assets('frontend/user-tool/js/tether.min.js'),
				'bootstrap'  	    => assets('frontend/user-tool/js/bootstrap.min.js'),
				'jquery.cookie'     => assets('frontend/user-tool/js/jquery.cookie.js'),
				'jquery.validate'  	=> assets('frontend/user-tool/js/jquery.validate.min.js'),

				'jqfrontuery'  	    => assets('frontend/user-tool/js/front.js'),
				
				'underscore' 		=> assets('js/backbone/underscore.js'),
				'backbone' 			=> assets('js/backbone/backbone-min.js'),
				'user-tool-backend' => assets('frontend/user-tool/js/backend-debug.js'),
			)
	);
	?>
  </body>
</html>