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
    <a href="#modal-table" class="btn btn-small btn-success"  role="button" data-toggle="modal" name="tambah" id="tambah" >
        <i class="icon-check"></i>
        Tambah Data
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center span2">Type</th>
            <th class="center">Address</th>
            <th class="center">Duration</th>
            <th class="center">Order</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_content();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->TYPE;?></td>
            <td><?php echo $dt->FILENAME;?></td>
            <td><?php echo $dt->DURATION;?></td>
            <td><?php echo $dt->ORDERNUM;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table-edit" onclick="javascript:editData('<?php echo $dt->CONTENT_ID;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/content_manag/hapus/<?php echo $dt->CONTENT_ID;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                        <i class="icon-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="icon-trash bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </center>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
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