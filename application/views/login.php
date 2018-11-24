<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login Page - <?php echo $this->config->item('nama_aplikasi');?></title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--basic styles-->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<!--page specific plugin styles-->
		<!--fonts-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-fonts.css"/>
		<!--ace styles-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css"/>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-responsive.min.css"/>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css"/>
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<!--inline styles related to this page-->
        <script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<!--<![endif]-->
		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			$(document).ready(function(){
				$('#username').focus();
			});
			if("ontouchend" in document) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <!--page specific plugin scripts-->
		<!--ace scripts-->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>
        
		<!--inline scripts related to this page-->
        
	</head>
	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h4><span class="blue"><?php echo $this->config->item('nama_aplikasi');?></span></h4>
									<h2><span class="black"><img src="<?php echo base_url();?>assets/img/<?= $this->model_data->getDisplayLogo();?>"/></span></h2>
								</div>
							</div>
							<div class="space-6"></div>
							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-laptop green"></i>
													Halaman Login
												</h4>
												<div class="space-6"></div>
												<form id="validation-form" method="post" action="<?php echo base_url();?>index.php/login">
													<fieldset>
													<label>
															<span class="block input-icon input-icon-right">
															<input type="text" class="span12" id="username" name="username" placeholder="Username" />
																<i class="icon-user"></i>
															</span>
														</label>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" id="password" name="password" class="span12" placeholder="Password" />
																<i class="icon-lock"></i>
															</span>
														</label>
														<div class="space"></div>
														<div class="clearfix">
															<button type="submit" name="submit" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
														</div>
														<div class="space-4"></div>
													</fieldset>
                                                    <?php
													$valid = validation_errors();
                                                    if(!empty($valid)){
													?>
                                                    <div class="alert alert-error">
                                                    <strong>Warning ..!!! </strong>
                                                   	<?php
														echo validation_errors();
													?>
                                                    </div>
                                                    <?php } ?>
                                                    <?php
													$info = $this->session->flashdata('result_login');
													if(!empty($info)){
													?>
                                                    <div class="alert alert-error">
                                                    <strong>Warning ..!!! </strong>
                                                   	<?php
														echo validation_errors();
														echo $this->session->flashdata('result_login');
													?>
                                                    </div>
                                                    <?php } ?>
												</form>
											</div><!--/widget-main-->
											<div class="toolbar clearfix">
												<center>
													<a href="#" class="forgot-password-link">
														<p>Copyright &copy; <?php echo $this->config->item('nama_pendek');?> - <?= date('Y')?></p>
													</a>
                                                    </center>    
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
		<!--basic scripts-->
		<!--[if !IE]>-->



		
		

	</body>

</html>

