<script type="text/javascript">
$(document).ready(function(){
	
    $('.date-picker').datepicker({autoclose: true});
        $('.date-picker').datepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
	
    $("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var tgl_awal = $("#tgl_awal").val();
		var tgl_akhir = $("#tgl_akhir").val();
        var csr = $("#csr").val();

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/lap_csr/cari_data",
			data	: "tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir+"&csr="+csr,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	
});
</script>

<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-book blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
            <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form" action="<?php echo base_url();?>index.php/lap_trx/cetak" method="post">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">CSR/Operator</label>
                    <div class="controls">
                        <select name="csr" id="csr" class="span4">
                        	<option value="%" selected="selected">-Semua-</option>
                            <?php
							$data = $this->model_data->data_csr();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->csr;?>"><?php echo $dt->csr;?></option>
							<?php } ?>
                         </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal Awal</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" name="tgl_awal" id="tgl_awal" value="<?php echo date("d-m-Y");?>" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                            <span class="add-on">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal Akhir</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="text" name="tgl_akhir" id="tgl_akhir" value="<?php echo date("d-m-Y");?>" class="span6 date-picker"  data-date-format="dd-mm-yyyy"/>
                            <span class="add-on">
                                <i class="icon-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>  	        
                <div class="alert alert-success"> 
                    <center>                                     
                        <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                            <i class="icon-th"></i> Lihat Data
                        </button>
                        <!--<button type="submit" name="cetak" id="cetak" class="btn btn-mini btn-primary">
                            <i class="icon-print"></i> Cetak PDF
                        </button>-->
                   </center>       
               </div>
           </form>   
           </div>
           <?php
		  	echo  $this->session->flashdata('result_info');
		   ?>
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>