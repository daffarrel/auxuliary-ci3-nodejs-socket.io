<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page | TCID - AUX</title>



    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url(); ?>assets/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        
    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo.min.css" rel="stylesheet">


    <!--Magic Checkbox [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>assets/plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/clock.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/pnotify.custom.min.css" rel="stylesheet">

</head>

<body>
	<div id="container" class="cls-container">
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h3 class="h4 mar-no">AUX ACCOUNT LOGIN</h3>
		                <p class="text-muted">Please Sign In To Your Account First</p>
		            </div>
		            <form action="<?php echo base_url(); ?>auth/logInAction" method="POST" role="form">
		                <div class="form-group">
		                    <input type="text" name="username" class="form-control" placeholder="Fill With Correct NIP">
		                </div>
		                <div class="form-group">
		                    <input type="password" name="password" class="form-control" placeholder="Fill With Correct Password">
		                </div>
		                <br/>
						<div class="clock">
							<div id="Date"></div>
								<ul>
									<li id="hours"></li>
									<li id="point">:</li>
									<li id="min"></li>
									<li id="point">:</li>
									<li id="sec"></li>
								</ul>
							</div>
		                <br/>
		                <p class="text-danger">Check Your Current Global Time With Clock Above, If There Is Difference Equals Or More Than 5 Minutes, Contact Administrator !</p>
		                <button class="btn btn-danger btn-lg btn-block" type="submit">Sign In</button><br/><br/>
		                <a class="btn btn-info btn-lg btn-block" href="<?php echo base_url(); ?>usermanual" style="color:#ffffff;" target="_blank">User Manual</a>
		            </form>
		        </div>
		    </div>
		</div>
		<!--===================================================-->		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->

    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>

    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>assets/js/nifty.min.js"></script>  
    <script src="<?php echo base_url(); ?>assets/js/clock.js"></script> 
    <script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<script>
		<?php if ($this->session->flashdata('error')) { ?>
			new PNotify({
			    title: "Error Try To Logging In !!!",
			    text: "<?php echo $this->session->flashdata('error'); ?>",
			    type: 'error',
			    icon: false,
			    buttons: {
					        sticker: false
					    }
			});
		<?php } ?>
		<?php if ($this->session->flashdata('success')) { ?>
			var datas = <?php echo json_encode($this->session->flashdata('success')) ?>;
			var socket = io.connect( 'http://'+window.location.hostname+':3033' );

	        socket.emit('onLogout', { 
	            nip         : datas.empNIP,
	            fullname    : datas.empFULLNAME,
	        });
		<?php } ?>
	</script>
	</body>
</html>
