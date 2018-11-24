<!DOCTYPE html>
<html>
<head>
	<title>Terminal</title>
	<link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/display_terminal.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />	

	<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/fsmode/jquery.fullscreen.min.js"></script>
</head>
<body class="terminal" style="background:url('<?php echo base_url();?>assets/img/bg_touch.png')">
	<div class="container">
		<!-- JUDUL -->
		<div class="row titlePart">
			<div class="col-sm-12 center">
				<img src="<?php echo base_url();?>assets/img/<?= $this->model_data->getDisplayLogo();?>">
			</div>
		</div>
		<!-- ISI -->
		<div class="row contectPart">
			<!-- Pilihan Loket -->
			<div class="col-md-6">
				<?php 
					date_default_timezone_set('Asia/Jakarta');
					foreach($jenis_loket->result() as $val):
				?>
				<div class="option" onclick="getTicket(<?= $val->JENIS_LOKET_ID?>,'<?= $val->KODE_LOKET?>','<?= $val->TYPE_LOKET?>')">
					<?= $val->TYPE_LOKET?>
				</div>
				<?php
					endforeach;
				?>
			</div>
			<!-- Polling -->
			<div class="col-md-6">
				<div class="formPoll">
				<?php
					foreach ($pertanyaan_polling->result() as $key => $value) {
						echo "<h2 class='titlePertanyaan'>$value->judul</h2>";
						//loop jawaban
						if($value->jawaban1 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban1`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban1`)'>$value->jawaban1</span>
								</h3>";
						if($value->jawaban2 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban2`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban2`)'>$value->jawaban2</span>
								</h3>";
						if($value->jawaban3 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban3`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban3`)'>$value->jawaban3</span>
								</h3>";
						if($value->jawaban4 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban4`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban4`)'>$value->jawaban4</span>
								</h3>";
						if($value->jawaban5 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban5`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban5`)'>$value->jawaban5</span>
								</h3>";
						if($value->jawaban6 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban6`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban6`)'>$value->jawaban6</span>
								</h3>";
						if($value->jawaban7 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban7`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban7`)'>$value->jawaban7</span>
								</h3>";
						if($value->jawaban8 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban8`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban8`)'>$value->jawaban8</span>
								</h3>";
						if($value->jawaban9 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban9`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban9`)'>$value->jawaban9</span>
								</h3>";
						if($value->jawaban10 !== NULL)
							echo "<h3>
									<div class='iconOption' onclick='submitPolling($value->polling_id,`$value->jawaban10`)'></div>
									<span onclick='submitPolling($value->polling_id,`$value->jawaban10`)'>$value->jawaban10</span>
								</h3>";
					}
				?>
				</div>
				<div class="thankYou">
					<img src="<?php echo base_url();?>assets/images/done.png">
					<h3>Terimakasih Atas Pendapat Anda</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="requestfullscreen">
		<img src="<?= base_url();?>assets/images/fullscreen.png">
	</div>
	<div class="exitfullscreen"></div>
</body>

<script type="text/javascript">
	function getTicket(ID_LOKET,KODE_LOKET,TYPE_LOKET)
	{		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/makeTicket",
			data	: {
				'ID_LOKET' : ID_LOKET,
				'KODE_LOKET' : KODE_LOKET,
				'TYPE_LOKET' : TYPE_LOKET
			},
			dataType : 'JSON',
			cache	: false,
			success	: function(data){
				// alert(data.ANTRIAN_NO);
				console.log(data);
				// window.open("printTiket/"+data.ANTRIAN_NO+"/"+data.JUMLAH_ANTRIAN_DIDEPAN, '_blank');
				// $.ajax({
				// 	type	: 'POST',
				// 	url		: "<?php echo site_url(); ?>/display/printTiket/"+data.ANTRIAN_NO+"/"+data.JUMLAH_ANTRIAN_DIDEPAN,					
				// 	cache	: false,
				// 	success	: function(data){
				// 		alert('sukses');
				// 	}
				// });
				//end ajax
			}
		});
	}

	function submitPolling(POLLING_ID,JAWABAN)
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/submitPolling",
			data	: {
				'POLLING_ID' : POLLING_ID,
				'JAWABAN' : JAWABAN
			},
			cache	: false,
			success	: function(data){
				if(data == "success")
				{
					$('.formPoll').slideUp(300).delay(4000).slideDown(300);
					$('.thankYou').fadeIn(300).delay(4000).fadeOut(300);
				}

			}
		});
	}
</script>
<script type="text/javascript">
	$(function() {			
		// check native support
		$('#support').text($.fullscreen.isNativelySupported() ? 'supports' : 'doesn\'t support');

		// open in fullscreen
		$('.requestfullscreen').click(function() {			
			$('html').fullscreen();
			$(this).hide();
			return false;
		});

		// exit fullscreen
		$('.exitfullscreen').click(function() {
			$.fullscreen.exit();
			return false;
		});

		// document's event
		$(document).bind('fscreenchange', function(e, state, elem) {
			// if we currently in fullscreen mode
			if ($.fullscreen.isFullScreen()) {
				$('#fullscreen .requestfullscreen').hide();
				$('#fullscreen .exitfullscreen').show();
			} else {
				$('#fullscreen .requestfullscreen').show();
				$('#fullscreen .exitfullscreen').hide();
			}

			$('#state').text($.fullscreen.isFullScreen() ? '' : 'not');
		});
		// $('.requestfullscreen').trigger("click");
	});
</script>
</html>