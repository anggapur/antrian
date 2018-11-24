<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-success">
            
            <i class="icon-ok green"></i>
                 
            Selamat datang di 
            <strong class="green">
                Aplikasi <?php echo $this->config->item('nama_aplikasi');?>
                <small>(v1.1.0)</small>
            </strong>
            ,
            <?php echo $this->model_data->getMainNama();?>
        </div>
    </div>                            
</div>
<div class="row-fluid">	
    <div class="span12 infobox-container">
        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="jenisLoket"></span>
                <div class="infobox-content">Jenis Loket</div>
            </div>
        </div>
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="namaLoket"></span>
                <div class="infobox-content">Nama Loket</div>
            </div>
        </div>
        <div class="infobox infobox-orange  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="sudahDilayani"></span>
                <div class="infobox-content">Yang Sudah Dilayani</div>
            </div>
        </div>
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="belumDilayani"></span>
                <div class="infobox-content">Yang Belum Dilayani</div>
            </div>
        </div>
    </div>   
    <div class="span12 infobox-container" style="padding-top: 50px;">
		<div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="antrian_now">-</span>
                <div class="infobox-content" >Antrian Sedang Dilayani</div>
            </div>
        </div>
        <div class="infobox infobox-red  repeatBox">
            <div class="infobox-icon">
                <i class="icon-repeat repeatCall callingRepeatEl" data-no-antrian=""onclick="callRepeat()" style="cursor: pointer"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number repeatCall callingRepeatEl" data-no-antrian="" onclick="callRepeat()" style="cursor: pointer">Panggil Ulang</span>
                <!-- <div class="infobox-content">Nama Loket</div> -->
            </div>
        </div>
         <div class="infobox infobox-green  nextBox">
            <div class="infobox-icon">
                <i class="icon-step-forward callingNextEl" onclick="callNext()" style="cursor: pointer"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number callingNextEl" onclick="callNext()" style="cursor: pointer">Selanjutnya</span>
                <!-- <div class="infobox-content">Nama Loket</div> -->
            </div>
        </div>
    </div>
</div>    

<!-- MODAL -->
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Ubah Loket</h3>
  </div>
  <div class="modal-body">
    <div class="row-fluid">
    	
    </div>
  </div>  
</div>
<script type="text/javascript">	

	//MENDAPATKAN YANG SEDANG DILAYANI
	firstTime();
	function firstTime()
	{
		callToGetData();
		getDataSedangDilayani();
		checkActiveNext();
		checkJenisNamaLoket();
	}

	//Loop realtime
	setInterval(function(){
		callToGetData();
		getDataSedangDilayani();
		checkActiveNext();
		checkJenisNamaLoket();
	},500);
	//functionnya 
	function checkJenisNamaLoket()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/checkJenisNamaLoket",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				$('#jenisLoket').html(data.jenisLoket);
				$('#namaLoket').html(data.namaLoket);
			}
		});		
	}
	function checkActiveNext()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/checkActiveNext",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				if(data.state == "active")
				{
					$('.callingNextEl').css("pointer-events","auto");
					$('.nextBox').removeClass('blur');
				}
				else
				{
					$('.callingNextEl').css("pointer-events","none");
					$('.nextBox').addClass('blur');
				}
			}
		});
	}
	function getDataSedangDilayani()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/getDataSedangDilayani",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				console.log(data);
				$('#antrian_now').html(data.sedangDilayani.ANTRIAN_NO);
				$('#jenisLoket').html(data.sedangDilayani.TYPE);
				$('#namaLoket').html(data.sedangDilayani.NAMA_LOKET);
				$('.repeatCall').attr('data-no-antrian',data.sedangDilayani);
				if(data.sedangDilayani == "-")
				{
					$('.callingRepeatEl').css("pointer-events","none");
					$('.repeatBox').addClass('blur');
				}
				else
				{
					$('.callingRepeatEl').css("pointer-events","auto");
					$('.repeatBox').removeClass('blur');
				}
			}
		});
	}
	function callToGetData()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/getPelayanan",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				$('#sudahDilayani').html(data.sudahDilayani);
				$('#belumDilayani').html(data.belumDilayani);
			}
		});
	}
	function callNext()
	{
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/callNext",			
			cache	: false,
			dataType : 'json',
			success	: function(data){
				// alert(data.antrian_now);
				$('#antrian_now').html(data.antrian_now);
				$('.repeatCall').attr('data-no-antrian',data.antrian_now)
			}
		});
	}

	function callRepeat()
	{
		no_antrian = $('.repeatCall').attr('data-no-antrian');
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/callRepeat",			
			cache	: false,			
			dataType : 'json',
			success	: function(data){
				// alert('success');
			}
		});
		// alert(no_antrian);
	}
	function changeLoket(LOKET_ID)
	{		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/changeLoket",			
			cache	: false,					
			data : {
				'JENIS_LOKET_ID' : LOKET_ID
			},
			success	: function(data){
				$('#myModal').modal('hide');
			}
		});
	}
	//action trigger when click
	$('.ubahLoket').click(function(){
		$('#myModal').modal('show');
		content = $('#myModal .modal-body .row-fluid');
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/dataLoketHandleable",			
			cache	: false,			
			dataType : 'json',
			success	: function(data){
				content.html("");
				$.each(data,function(i,val){
					htmlWrap = "<div class='boxChangeLoket span4' onclick='changeLoket("+val.JENIS_LOKET_ID+")'><h4>"+val.TYPE_LOKET+"</h4><span>"+val.NAMA_LOKET+"</span></div>"
					content.append(htmlWrap);
				});
			}
		});
	});
	
</script>