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
    <div class="span12">        
        <div class="span12 infobox-container">
        <div class="infobox infobox-green " style="padding-right: 15px;">
            <input type="range" min="0" max="100" value="0" id="volIndicator">
        </div>
        <div class="infobox infobox-pink  ">
            <div class="infobox-icon">
                <i class="icon-volume-up"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number" id="volume"></span>                
            </div>
        </div>        
    </div>    </div>
</div>
<div class="row-fluid">
	<div class="span12"></div>
    <div class="span12 infobox-container">
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('s_user');?> Data</span>
                <div class="infobox-content">Pengguna</div>
            </div>
        </div>
        <div class="infobox infobox-pink  ">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_data('t_user_polling');?> Data</span>
                <div class="infobox-content">Polling</div>
            </div>
        </div>        
    </div>
    <div class="span12"></div>
    <div class="span12 infobox-container">
        <div class="infobox infobox-blue  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_antrian_now('t_antrian');?> Data</span>
                <div class="infobox-content">Antrian</div>
            </div>
        </div>
        <div class="infobox infobox-red  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_antrian_open();?> Data</span>
                <div class="infobox-content">Belum Terlayani</div>
            </div>
        </div>
        <div class="infobox infobox-orange  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_antrian_inprogress();?> Data</span>
                <div class="infobox-content">Proses Pelayanan</div>
            </div>
        </div>
        <div class="infobox infobox-green  ">
            <div class="infobox-icon">
                <i class="icon-book"></i>
            </div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?php echo $this->model_data->jml_antrian_close();?> Data</span>
                <div class="infobox-content">Terlayani</div>
            </div>
        </div>
    </div>
    <div class="span12"></div>
    <div class="span12 center"><?php echo $this->load->view('grafik/antrian');?></div>
</div>    
<script type="text/javascript">
    $(document).ready(function(){
        //first call
        getVolume();
        //changeinpit
        $('#volIndicator').change(function(){
            vol = $(this).val();
            sendVolume(vol);
        });
        //function
        function getVolume()
        {
            $.ajax({
                type    : 'POST',
                url     : "<?php echo site_url(); ?>/home/getVolume",           
                cache   : false,
                dataType : 'json',               
                success : function(data){
                    // alert(data);
                    $('#volIndicator').val(data);
                    $('#volume').html(data);
                }
            });
        }
        function sendVolume(vol)
        {
            $('#volume').html(vol);
            $.ajax({
                type    : 'POST',
                url     : "<?php echo site_url(); ?>/home/sendVolume",           
                cache   : false,
                dataType : 'json',
                data : {
                    'volume' : vol
                },
                success : function(data){
                    console.log(data);              
                }
            });
        }
    });
</script>