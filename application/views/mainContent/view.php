<script type="text/javascript">
$(document).ready(function(){
	
	
	
	$("#tambah").click(function(){
		$('#content_id').val('0');
        $('#type').val('');
		$('#address').val('');
		$('#duration').val('');
		$('#type').focus();
	});
});

function editData(ID){
    
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/content_manag/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
            console.log(data);
            $('#durasi').val(data.duration);
            $('#contentId').val(data.content_id);
            $('#type').val(data.type);
            $('#order').val(data.ordernum);
            file = '<?= base_url();?>uploads/'+data.filename;            
            // alert(file);
            if(data.type=="VIDEO")
            {
                $('#previewVideo').attr('src',file).show();  
                $('#previewImg').hide();
            }
            else
            {
                $('#previewImg').attr('src',file).show();
                $('#previewVideo').hide();
            }
            
            $('#type').focus();
			
		}
	});
	
}

</script>
<div class="row-fluid">
    <div class="table-header">
        <?php echo $judul;?>
        <div class="widget-toolbar no-border pull-right">      
        </div>   
    </div>
    <div class="table-body">
        <div class="span6">
            <form method="POST" action="<?= base_url();?>main_manag/saveData" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama</label>
                    <div class="controls">
                        <input type="text" name="MAIN_NAMA"  placeholder="Nama"  required title="Nama" value="<?= $MAIN_NAMA?>" />
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">No Telpon</label>
                    <div class="controls">
                        <input type="text" name="MAIN_TELPON"  placeholder="No Telpon"  required title="No Telpon" value="<?= $MAIN_TELPON?>"/>
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>
                    <div class="controls">
                        <input type="text" name="MAIN_ALAMAT"  placeholder="Alamat"  required title="Alamat" value="<?= $MAIN_ALAMAT?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Logo Login <b>(Max : 87px x 90px)</b></label>
                    <div class="controls">
                        <input type="file" name="MAIN_LOGO_LOGIN"  placeholder="Logo Login"  title="Logo Login" value="<?= $MAIN_LOGO_LOGIN?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Logo Display <b>(Max : 319px x 65px)</b></label>
                    <div class="controls">
                        <input type="file" name="MAIN_LOGO_DISPLAY"  placeholder="Logo Display"  title="Logo Display" value="<?= $MAIN_LOGO_DISPLAY?>"/>
                    </div>
                </div>
                <button type="submit" name="simpan" id="simpan_main" class="btn btn-small btn-success pull-left">
                    <i class="icon-save"></i>
                    Simpan
                </button>
            </form>
        </div>
        <div class="span3">
            <label>Logo Login</label>
            <img src="<?= base_url()."assets/img/".$MAIN_LOGO_LOGIN;?>" class="img-fluid" alt="Logo Login">
        </div>
         <div class="span3">
            <label>Logo Display</label>
            <img src="<?= base_url()."assets/img/".$MAIN_LOGO_DISPLAY;?>" class="img-fluid" alt="Logo Login">
        </div>
        <div style="clear: both"></div>
    </div>
</div>

<div id="modal-table" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Data Content
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form enctype="multipart/form-data" method="POST" class="form-horizontal" name="my-forms" id="my-forms" action="<?= base_url();?>content_manag/saveData">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Type Content</label>
                    <div class="controls">
                        <input type="hidden" name="content_id" id="content_id"/>
                        <select name="type" required title="Type Content">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('TYPE_CONTENT');
                            foreach($data->result() as $dt){
                            ?>
                            <option value="<?php echo $dt->CODE_VAL;?>"><?php echo $dt->DESCRIPTION;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">File</label>
                    <div class="controls">
                        <!-- <textarea type="text" name="address" id="address" placeholder="Address" required title="Address"></textarea> -->
                        <input type="file" name="userfile" id="addressing" placeholder="File" required="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Duration</label>
                    <div class="controls">
                        <input type="text" name="duration"  placeholder="Duration"  required title="Duration"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Order</label>
                    <div class="controls">
                        <input type="number" name="order"  placeholder="Order"  required title="Order"/>
                    </div>
                </div>
			            
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="submit" name="simpan" id="simpans" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
        </form>    
		</div>
    </div>
</div>   


<!-- EDIT -->
<div id="modal-table-edit" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Edit Data Content
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form enctype="multipart/form-data" method="POST" class="form-horizontal" name="my-forms" id="my-forms" action="<?= base_url();?>content_manag/updateData">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Type Content</label>
                    <div class="controls">
                        
                        <select name="type" id="type" required title="Type Content">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('TYPE_CONTENT');
                            foreach($data->result() as $dt){
                            ?>
                            <option value="<?php echo $dt->CODE_VAL;?>"><?php echo $dt->DESCRIPTION;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">File</label>
                    <div class="controls">
                        <!-- <textarea type="text" name="address" id="address" placeholder="Address" required title="Address"></textarea> -->
                        <input type="file" name="userfile" id="address" placeholder="File" >
                        <img src="" style="width:50%" id="previewImg">
                        <video id="previewVideo" style="width:50%">
                            
                        </video>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Duration</label>
                    <div class="controls">
                        <input type="number" name="duration" id="durasi">
                        <input type="hidden" name="content_id" id="contentId">
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Order</label>
                    <div class="controls">
                        <input type="number" name="order" id="order" placeholder="Order"  required title="Order"/>
                    </div>
                </div>
                        
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="submit" name="simpan" id="simpans" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
        </form>    
        </div>
    </div>
</div>   