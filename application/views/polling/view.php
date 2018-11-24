<script type="text/javascript">
$(document).ready(function(){
	
	$("#simpan").click(function(){
        var formData = new FormData();
        var data_polling = $("#my-form").serializeArray();
        var polling_bool=false;
        var polling_key=0;

        $.each(data_polling,function(key,input){
            //yang diabaikan
            if(!$("#"+input.name).prop('required')){polling_key++;formData.append(input.name,input.value);return true;}

            //yang divalidasi
            if($("#"+input.name).is("select")){ //jika combobox
                if($("#"+input.name).val()=="0"){

                    $.gritter.add({
                        title       : 'Peringatan',
                        text        : $("#"+input.name).attr('title')+" Kosong",    
                        class_name  : 'gritter-error'
                    });

                    $("#"+input.name).focus();

                    return false;
                }
                else{
                    formData.append(input.name,input.value);
                    polling_key++;
                }
            }
            else{
                if($("#"+input.name).val()==""){

                    $.gritter.add({
                        title       : 'Peringatan',
                        text        : $("#"+input.name).attr('title')+" Kosong",    
                        class_name  : 'gritter-error'
                    });

                    $("#"+input.name).focus();

                    return false;
                }
                else{
                    formData.append(input.name,input.value);
                    polling_key++;
                }
            }
        });
    
        if(polling_key==data_polling.length){polling_bool=true;} //go to next step
		
		if(polling_bool){
            $.ajax({
                    type    : 'POST',
                    url     : "<?php echo site_url(); ?>/polling_manag/simpan",
                    data    : formData,
                    cache   : false,
                    async: false,
                    contentType: false,
                    processData: false,
                    success : function(data){
                         alert(data);
                         location.reload();
                    }
            });
        }
		
	});
	
	$("#tambah").click(function(){
		$('#polling_id').val('0');
        $('#judul').val('');
        $('#opsi1').val('');
		$('#opsi2').val('');
		$('#opsi3').val('');
		$('#opsi4').val('');
		$('#opsi5').val('');
        $('#active_flag').val('Y');
		$('#opsi1').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/polling_manag/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
            $('#polling_id').val(data.polling_id);
            $('#judul').val(data.judul);
			$('#opsi1').val(data.jawaban1);
            $('#opsi2').val(data.jawaban2);
            $('#opsi3').val(data.jawaban3);
            $('#opsi4').val(data.jawaban4);
            $('#opsi5').val(data.jawaban5);
            $('#active_flag').val(data.active_flag);
            $('#opsi1').focus();
			
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
            <th class="center">Judul</th>
            <th class="center">OP1</th>
            <th class="center">OP2</th>
            <th class="center">OP3</th>
            <th class="center">OP4</th>
            <th class="center">OP5</th>
            <th class="center">Active Flag</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_polling();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->judul;?></td>
            <td><?php echo $dt->jawaban1;?></td>
            <td><?php echo $dt->jawaban2;?></td>
            <td><?php echo $dt->jawaban3;?></td>
            <td><?php echo $dt->jawaban4;?></td>
            <td><?php echo $dt->jawaban5;?></td>
            <td><?php echo $dt->active_flag;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->polling_id;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/polling_manag/hapus/<?php echo $dt->polling_id;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data Polling
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Judul</label>
                    <div class="controls">
                        <input type="hidden" name="polling_id" id="polling_id"/>
                         <textarea type="text" name="judul" id="judul" placeholder="Judul" required title="Judul"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Opsi 1</label>
                    <div class="controls">
                        <input type="text" name="opsi1" id="opsi1" placeholder="Opsi 1" required title="Opsi 1" />
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Opsi 2</label>
                    <div class="controls">
                        <input type="text" name="opsi2" id="opsi2" placeholder="Opsi 2" required title="Opsi 2" />
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Opsi 3</label>
                    <div class="controls">
                        <input type="text" name="opsi3" id="opsi3" placeholder="Opsi 3" required title="Opsi 3" />
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Opsi 4</label>
                    <div class="controls">
                        <input type="text" name="opsi4" id="opsi4" placeholder="Opsi 4" title="Opsi 4" />
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Opsi 5</label>
                    <div class="controls">
                        <input type="text" name="opsi5" id="opsi5" placeholder="Opsi 5" title="Opsi 5" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Active Flag</label>
                    <div class="controls">
                        <select name="active_flag" id="active_flag" required title="active_flag">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('ACTIVE_FLAG');
                            foreach($data->result() as $dt){
                            ?>
                            <option value="<?php echo $dt->CODE_VAL;?>"><?php echo $dt->DESCRIPTION;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination pull-right no-margin">
        <button type="button" class="btn btn-small btn-danger pull-left" data-dismiss="modal">
            <i class="icon-remove"></i>
            Close
        </button>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
		</div>
    </div>
</div>   