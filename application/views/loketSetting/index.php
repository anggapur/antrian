<script type="text/javascript">
$(document).ready(function(){
    var statusSimpan;
	//Trigger click
    $('.type1').focus(function(){        
        $('.type2').val('');
    });
    $('.type2').focus(function(){        
        $('.type1').val('');
    });

    //
	$("#simpan").click(function(){        
        var formData = new FormData();
        var data_content = $("#my-form").serializeArray();
        var content_bool=false;
        var content_key=0;

        $.each(data_content,function(key,input){
            //yang diabaikan
            if(!$("#"+input.name).prop('required')){content_key++;formData.append(input.name,input.value);return true;}

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
                    content_key++;
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
                    content_key++;
                }
            }
        });
    
        if(content_key==data_content.length){content_bool=true;} //go to next step
        //special        
        //kirim data
		if(content_bool){
            if(statusSimpan == true)
            {
                $.ajax({
                        type    : 'POST',
                        url     : "<?php echo site_url(); ?>/loketSetting/simpan",
                        data    : formData,
                        cache   : false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success : function(data){
                            if(data == "success")
                            {
                                alert("Berhasil Simpan Data");                            
                            }
                             location.reload();
                        }
                });
            }
            else
            {
                getID = $('#LOKET_ID').val();
                $.ajax({
                        type    : 'POST',
                        url     : "<?php echo site_url(); ?>/loketSetting/update/"+getID,
                        data    : formData,
                        cache   : false,
                        async: false,
                        contentType: false,
                        processData: false,
                        success : function(data){
                            if(data == "success")
                            {
                                alert("Berhasil Simpan Data");                            
                            }
                             location.reload();
                        }
                });
            }
        }
		
	});
	
	$("#tambah").click(function(){
        statusSimpan = true;
		
        $('#NAMA_LOKET').val('').focus();
	});
});

function editData(ID){      
    statusSimpan = false;
	$.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/loketSetting/editData",           
            cache   : false,
            dataType : 'json',
            data : {
                'cari' : ID
            },
            success : function(data){
                console.log(data);   
                $('#NAMA_LOKET').val(data.NAMA_LOKET);                         
                                        
               
                $('#LOKET_ID').val(data.LOKET_ID);
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
            <th class="center">Nama Loket</th>         
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_loket();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->NAMA_LOKET;?></td>                       
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="editData('<?php echo $dt->LOKET_ID;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/loketSetting/hapus/<?php echo $dt->LOKET_ID;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data Loket
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Loket</label>
                    <div class="controls">
                        <textarea type="text" name="NAMA_LOKET" id="NAMA_LOKET" placeholder="Nama Loket" required title="Address"></textarea>
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
        <input type="hidden" name="LOKET_ID" id="LOKET_ID">
		</div>
    </div>
</div>   