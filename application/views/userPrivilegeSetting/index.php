<script type="text/javascript">
$(document).ready(function(){    
	//Trigger click
          
   
    //
	$("#simpan").click(function(){  
        //console.log($('.inputCheckBox:checked').val());      
        data = $('input[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();
        USER_ID = $('input[name="USER_ID"]').val();
        LOKET_ID = $('select[name="LOKET_ID"]').val();
        $.ajax({
                type    : 'POST',
                url     : "<?php echo site_url(); ?>/userPrivilegeSetting/simpan",
                data    : {
                    'USER_ID' : USER_ID,
                    'DATA' : data,
                    'LOKET_ID' : LOKET_ID
                },
                cache   : false,              
                success : function(data){
                    if(data == "success")
                    {
                        alert("Berhasil Simpan Data");                            
                    }
                     location.reload();
                }
        });
	});
	
	$("#tambah").click(function(){        
	});
});

function editData(ID){      
    
    $('input[name="USER_ID"]').val('');
    $('input[name="USER_ID"]').val(ID);
	$.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/userPrivilegeSetting/getData",           
            cache   : false,
            dataType : 'json',
            data : {
                'USER_ID' : ID
            },
            success : function(data){
                $('input[type="checkbox"]').prop('checked',false);
                $.each(data,function(i,val){                    
                    $('#checkBox'+val.JENIS_LOKET_ID).prop('checked',true);
                });
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
            <th class="center">Nama User</th>
            <th class="center">Username</th>           
            <th class="center">Loket Yang Dihandle</th>           
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->getUser('operator');
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->NAME;?></td>           
            <td><?php echo $dt->LOGIN;?></td>                       
            <td>
                <?php
                    $handle = $this->model_data->handleByUser($dt->USER_ID);
                    foreach ($handle->result() as $key => $value) {
                        echo "<span>".$value->TYPE_LOKET." - <b>".$value->NAMA_LOKET."</b></span><br>";                        
                    }
                ?>
            </td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="editData('<?php echo $dt->USER_ID;?>')" data-toggle="modal">
                        <i class="icon-gear bigger-130"></i>
                    </a>

                    <!-- <a class="red" href="<?php echo site_url();?>/loketSetting/hapus/<?php echo $dt->USER_ID;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                        <i class="icon-trash bigger-130"></i>
                    </a> -->
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
                <?php
                    $handle = $this->model_data->data_jenis_loket('Y');
                    foreach ($handle->result() as $key => $value) {
                ?>
                    <div class="boxChangeLoket span4">
                        <h6><?= $value->TYPE_LOKET;?></h6>
                        <input name="loket[]" value="<?=$value->JENIS_LOKET_ID;?>" id="checkBox<?=$value->JENIS_LOKET_ID;?>" type="checkbox" style="position: relative;opacity: 1" class="inputCheckBox">
                    </div>
                <?php                   
                    }
                ?>
                <div class="clear" style="clear:both;"></div>
                <div class="form-group" style="text-align: center;">
                    <label>Pilih Loket</label>
                    <select class="form-control" name="LOKET_ID">
                        <option value="">-</option>
                        <?php
                            foreach ($this->model_data->data_loket()->result() as $key => $value) {
                            echo '<option value="'.$value->LOKET_ID.'">'.$value->NAMA_LOKET.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="USER_ID" value="">
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
        <input type="hidden" name="JENIS_LOKET_ID" id="JENIS_LOKET_ID">
		</div>
    </div>
</div>   