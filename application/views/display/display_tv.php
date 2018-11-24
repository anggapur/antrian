<!DOCTYPE html>
<html>
<head>
	<title>TV Media</title>
	<link href="<?php echo base_url();?>assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/display_tv.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />	

	<script src="<?= base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.marquee.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/fitText.js"></script>
	<script src="<?php echo base_url();?>assets/fsmode/jquery.fullscreen.min.js"></script>
</head>
<body class="tv">
	<div class="container-fluid">
		<div class="row topper">
			<!-- Nomor Loket -->
			<div class="col-md-3 wrapping">
				<!-- Logo -->
				<div class="logo">
					<img src="<?php echo base_url();?>assets/img/<?= $this->model_data->getDisplayLogo();?>" class="img-logos img-responsive">
				</div>
				<div class="timeIndikator">
					<div class="center" id="time" ></div>
				</div>
				<!-- Boc Loket -->
				<div class="wrapLoket">
					<?php 
						$h = 80 / $jenis_loket->num_rows();
						foreach($jenis_loket->result() as $val):
					?>
					<div class="boxLoket center" data-nama-loket="" data-jenis-pelayanan="<?= $val->TYPE_LOKET; ?>">
						<div class="leftPart">
							<h4 class="typeLoket"><?= $val->TYPE_LOKET; ?></h4>
							<h4 class="ketLoket">TELLER : <span class="noLoket"></span></h4>
						</div>
						<div class="rightPart">
							<h3 class="noAntrian">-</h3>
						</div>
					</div>
					<?php
						endforeach;
					?>
				</div>
			</div>
			<!-- TV Disini -->
			<div class="col-md-9 videoTron">
				<img src="" class="imgEntertaiment">
				<video  autoplay="autoplay" class="videoEntertaiment" loop="loop">
				  <source src="" type="video/mp4" />
				</video>
			</div>
		</div>
		<div class="row bottomFloat">
			<div class="col-md-12">
				<div class="marquee">
					<?php						
						foreach ($banner_list->result() as $key => $value) {							
								echo '<div class="mar" style="background:linear-gradient('.$value->DESCRIPTION.')"><p class="textMar">'.$value->banner_text.'</p></div>';							
								echo '<div class="mar" style="background:linear-gradient('.$value->DESCRIPTION.')"><p class="textMar">-</p></div>';
						}
					?>					
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
	$('.marquee').marquee({
    //speed in milliseconds of the marquee
    duration: 20000,
    //gap in pixels between the tickers
    gap: 50,
    //time in milliseconds before the marquee will start animating
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left',
    //true or false - should the marquee be duplicated to show an effect of continues flow
    duplicated: true
});
</script>
<script type="text/javascript">
	 var settime = setInterval(function () {
        var d = new Date(); // for now
        var tanggal = d.getDate();
        var month = new Array();
			month[0] = "Januari";
			month[1] = "Februari";
			month[2] = "Maret";
			month[3] = "April";
			month[4] = "Mei";
			month[5] = "Juni";
			month[6] = "Juli";
			month[7] = "Agustus";
			month[8] = "September";
			month[9] = "Oktober";
			month[10] = "November";
			month[11] = "Desember";
		var n = month[d.getMonth()];
		var year = d.getFullYear();
		var  h = d.getHours(); // => 9
		var m = d.getMinutes(); // =>  30
		var s = d.getSeconds(); // => 51

        $("#time").html(tanggal +" "+n+" "+year+"   "+('0'  + h).slice(-2) + ":" + ('0'  + m).slice(-2) + ":" + ('0'  + s).slice(-2));
    },1000);
</script>

<script type="text/javascript">		
	//Seting Font	
	final = $('.rightPart').height()-20;
	$('h3.noAntrian').css({'font-size':'6em'});
	//
	localStorage.setItem("volumeVideo",1);
	var sounds = new Array();
	var entertaiment = new Array();	
	var audioPemanggilan = 1;
		
	var audioVideoNonActive = 0.01;	
	var durationPrep = 0.1*1000;
	var i = 0;	
	//MENDAPATKAN YANG SEDANG DILAYANI	
	firstTime();
	function firstTime()
	{
		getVolume();
		checkDataDisplay();
		checkData();
		getEntertaimentContent();
		console.log('first volume '+localStorage.getItem("volumeVideo"));
		changeSoundOf(".videoEntertaiment",localStorage.getItem("volumeVideo"));
	}
	var isPlay = true;

	//Loop realtime
	setInterval(function(){
		getVolume();
		console.log("volume ls : "+localStorage.getItem("volumeVideo"));
		console.log("volume prop : "+$('.videoEntertaiment').prop('volume'));		
		if(isPlay == true)
		{
			checkDataDisplay();
			checkData();
			console.log('TIDAK PEMANGGILAN');			
			changeSoundOf(".videoEntertaiment",localStorage.getItem("volumeVideo"));
		}
		else
		{
			console.log('PEMANGGILAN');
		}
	},1000);
	//functionnya 
	function checkDataDisplay()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/checkDataDisplay",			
			cache	: false,
			dataType : 'json',
			success	: function(data){				
				$.each(data,function(i,val){
					$('.boxLoket.center[data-jenis-pelayanan="'+val.JENIS_PELAYANAN+'"]').find('.noLoket').html(val.NAMA_LOKET);
					$('.boxLoket.center[data-jenis-pelayanan="'+val.JENIS_PELAYANAN+'"]').find('.noAntrian').html(val.ANTRIAN_NO);
				});
			}
		});
	}
	function getEntertaimentContent()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/getEntertaimentContent",			
			cache	: false,
			dataType : 'json',
			success	: function(data){				
				entertaiment = data;
				console.log(entertaiment);
				playEntertaiment(0);
			}
		});
	}
	function playEntertaiment(index)
	{
		if(typeof entertaiment[index] === 'undefined')
		{
			index = 0;		
		}
		//cek type
		if(entertaiment[index].TYPE == "BANNER")
		{
			
			$('.videoEntertaiment').slideUp(500).attr('src','');
			$('.imgEntertaiment').slideUp(500,function(){
				$('.imgEntertaiment').slideDown(300).attr('src','<?= base_url();?>uploads/'+entertaiment[index].FILENAME);	
			});			
		}
		else
		{
			$('.imgEntertaiment').slideUp(500);
			$('.videoEntertaiment').slideUp(500,function(){
				$('.videoEntertaiment').slideDown(300).attr('src','<?= base_url();?>uploads/'+entertaiment[index].FILENAME);
			});
			handlePromise();
		}

		//change
		duration = entertaiment[index].DURATION*1000;
		setTimeout(function () {	
			console.log('change');	       
	    	playEntertaiment(index+1);
	    },duration);

	}
	function checkData()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/getDataForTv",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				$.each(data,function(i,val){
					//console.log(val);
					//$('.boxLoket[data-nama-loket="'+val.NAMA_LOKET+'"]').find('.noAntrian').html(val.ANTRIAN_NO);
					//delay untuk cek suara
					if(val.STATUS == "INCALL")
					{
						isPlay = false;
						changeSoundOf(".videoEntertaiment",audioVideoNonActive);
						console.log("Ada Yang Dicall");
						// alert("Panggil "+val.ANTRIAN_ID);
						ubahStateAntrianNo(val.ANTRIAN_ID);
						//panggil
						//blink
						$('.boxLoket[data-jenis-pelayanan="'+val.TYPE+'"]').find('h3.noAntrian').addClass('blinking');
						//						
						if(val.ANTRIAN_NO.length == 3)
						{
							$('.boxLoket[data-jenis-pelayanan="'+val.TYPE+'"]').find('h3.noAntrian')
							.css({'font-size':'6em !important'});
							// alert('6 em');
							console.log('6 em');
						}
						noAntrian = complexSplit(val.ANTRIAN_NO);
						klinikTujuan = complexSplit(val.NAMA_LOKET);
						console.log(noAntrian);
						console.log(klinikTujuan);
						makeSound(['no','antrian'],noAntrian,['menuju','ke','teller'],klinikTujuan);
						playSnd(0);
						return false;
					}
				});
			}
		});
	}	

	function makeSound(kata1,noAntrian,kata2,klinikTujuan)
	{
		console.log(noAntrian.length);
		console.log(klinikTujuan.length);
		sounds = [];
		//awal
		iteration = 0;		
		for(it = 0; it < kata1.length; it++)
			sounds[iteration++] = new Audio("<?= base_url();?>assets/audio/"+kata1[it]+".wav");
		//buat nomor antrian
		for(it = 0; it < noAntrian.length; it++)
			sounds[iteration++] = new Audio("<?= base_url();?>assets/audio/"+noAntrian[it]+".wav");
		//Dipersilahkan
		for(it = 0; it < kata2.length; it++)
			sounds[iteration++] = new Audio("<?= base_url();?>assets/audio/"+kata2[it]+".wav");
		//Klinik tujuan
		for(it = 0; it < klinikTujuan.length; it++)
			sounds[iteration++] = new Audio("<?= base_url();?>assets/audio/"+klinikTujuan[it]+".wav");
	}
	function ubahStateAntrianNo(ANTRIAN_ID)
	{

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/display/ubahStateAntrianNo",			
			cache	: false,
			dataType : 'json',
			data : {
				'ANTRIAN_ID' : ANTRIAN_ID
			},
			success	: function(data){
				console.log(data);				
			}
		});
	}

	function getVolume()
    {
    	var v = 0;
        $.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/home/getVolume",           
            cache   : false,
            dataType : 'json',               
            success : function(data){
        		localStorage.setItem("volumeVideo",(data/100))
        		// alert(volumeVideo);             
            }
        });
        
    }
	
	function playSnd(index) {	

		if(sounds[index] !== null && sounds[index] !== "" && sounds[index] !== undefined)    
		{
			console.log(index+" = "+sounds[index]);
		    sounds[index].play();
		    sounds[index].volume = audioPemanggilan;
		    sounds[index].addEventListener("ended",function(){
		    	playSnd(index+1);
		    });
		}
		else
		{			
			isPlay = true;
			//remove blink
			$('.noAntrian').removeClass('blinking');
			i = 0;
			vol = 0.2			
			var fadeout = setInterval(
			  function() {
			    // Reduce volume by 0.05 as long as it is above 0
			    // This works as long as you start with a multiple of 0.05!

			    if(vol > localStorage.getItem("volumeVideo")) {
			      // Stop the setInterval when 0 is reached
			      clearInterval(fadeout);
			      console.log('habis');
			    }
			    if ($('.videoEntertaiment').prop("volume") < 1 && isPlay == true) {			    
			      vol += 0.05;
			      changeSoundOf('.videoEntertaiment',vol);
			      console.log(vol +""+isPlay);
			    }
			    else
			    {
			    	console.log('reset');
			    	changeSoundOf('.videoEntertaiment',0.01);
			    }
			  }, 200);
						
		}
	}

	function penyebut(nilai) {
		nilai = Math.abs(nilai);
		huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
		temp = "";
		if (nilai < 12) {
			temp = " "+ huruf[nilai];
		} else if (nilai <20) {
			temp = penyebut(nilai - 10)+ " belas";
		} else if (nilai < 100) {
			temp = penyebut(Math.floor(nilai/10))+" puluh"+ penyebut(nilai % 10);
		} else if (nilai < 200) {
			temp = " seratus" + penyebut(nilai - 100);
		} else if (nilai < 1000) {
			temp = penyebut(Math.floor(nilai/100)) + " ratus" + penyebut(nilai % 100);
		} else if (nilai < 2000) {
			temp = " seribu" + penyebut(nilai - 1000);
		} else if (nilai < 1000000) {
			temp = penyebut(Math.floor(nilai/1000)) + " ribu" + penyebut(nilai % 1000);
		} else if (nilai < 1000000000) {
			temp = penyebut(Math.floor(nilai/1000000)) + " juta" + penyebut(nilai % 1000000);
		}
		return temp;
	}
 
	function terbilang(nilai) {
		if(nilai<0) {
			hasil = "minus ". penyebut(nilai);
		} else {
			hasil = penyebut(nilai);
		}     		
		return hasil;
	}

	function onlyNumber(str)
	{
		str = str.replace(/[^0-9\.]+/g, "");
		return str;
	}
	function onlyChar(str)
	{
		str = str.replace(/[^A-Za-z\.]+/g, "");
		return str.toLowerCase();
	}
	function complexSplit(str)
	{
		str = str.match(/[a-zA-Z]+|[0-9]+/g);	
		arr = [];
		a = 0;
		for(i = 0; i < str.length ; i++)	
		{
			if(isNaN(str[i]))
			{
				arr[a++] = str[i].toLowerCase();
			}
			else
			{				
				wordSplit = terbilang(str[i]).split(" ");
				for(x = 0; x < wordSplit.length; x++)
				{
					arr[a++] = wordSplit[x];
				}
			}
		}
		return arr.filter(function(e){return e});
	}	
	function changeSoundOf(kelas,volume)
	{
		$(kelas).prop("volume",volume);
	}

	function handlePromise()
	{
		var playPromise = document.querySelector('video').play();
		// In browsers that don’t yet support this functionality,
		// playPromise won’t be defined.
		if (playPromise !== undefined) {
		  playPromise.then(function() {
		    // Automatic playback started!
		    // alert('Sip');
		    // window.location.href="";
		  }).catch(function(error) {
		    // Automatic playback failed.
		    // Show a UI element to let the user manually start playback.
		    //alert('Error Plz');
		    window.location.href="";
		  });
		}
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