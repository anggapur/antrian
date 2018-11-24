<script type="text/javascript">
$(document).ready(function(){
	
	$("#simpan").click(function(){
        var formData = new FormData();
        var data_user = $("#my-form").serializeArray();
        var user_bool=false;
        var user_key=0;

        //photo
        /*for (var i = 0, len = document.getElementById('photo').files.length; i < len; i++) {
            formData.append("photo" + i, document.getElementById('photo').files[i]);
        }*/

        $.each(data_user,function(key,input){
            //yang diabaikan
            if(!$("#"+input.name).prop('required')){user_key++;formData.append(input.name,input.value);return true;}

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
                    user_key++;
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
                    user_key++;
                }
            }
        });
    
        if(user_key==data_user.length){user_bool=true;} //go to next step
		
		if(user_bool){
            $.ajax({
                    type    : 'POST',
                    url     : "<?php echo site_url(); ?>/user_manag/simpan",
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
		$('#user_id').val('0');
        $('#otoritas').val('');
		$('#nama').val('');
		$('#alamat').val('');
		$('#tmp_lahir').val('');
		$('#tgl_lahir').val('');
		$('#jk').val('');
        $('#agama').val('');
        $('#status_kawin').val('');
        $('#hp').val('');
        $('#username').val('');
        $('#password').val('');
		$('#otoritas').focus();
	});
});

function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/user_manag/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
            $('#user_id').val(data.user_id);
			$('#otoritas').val(data.type_user);
            $('#nama').val(data.name);
            $('#alamat').val(data.alamat);
            $('#tmp_lahir').val(data.tmp_lahir);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jenis_kelamin);
            $('#agama').val(data.agama);
            $('#status_kawin').val(data.status_kawin);
            $('#hp').val(data.hp1);
            $('#username').val(data.login);
            $('#password').val(data.pwd);
            $('#otoritas').focus();
			
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
            <th class="center span2">Login</th>
            <th class="center">Nama</th>
            <th class="center">Alamat</th>
            <th class="center">Jenis Kelamin</th>
            <th class="center">Tipe User</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_user();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->LOGIN;?></td>
            <td><?php echo $dt->NAME;?></td>
            <td><?php echo $dt->ALAMAT;?></td>
            <td><?php echo $dt->JENIS_KELAMIN;?></td>
             <td><?php echo $dt->TYPE_USER;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->USER_ID;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/user_manag/hapus/<?php echo $dt->USER_ID;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data User
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Autoritas</label>
                    <div class="controls">
                        <input type="hidden" name="user_id" id="user_id"/>
                        <select name="otoritas" id="otoritas" required title="Autoritas">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('OTORITAS');
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
                    <label class="control-label" for="form-field-1">Nama</label>
                    <div class="controls">
                        <input type="text" name="nama" id="nama" placeholder="Nama" required title="Nama"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Alamat</label>
                    <div class="controls">
                        <textarea type="text" name="alamat" id="alamat" placeholder="Alamat" required title="Alamat"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tempat/Tanggal Lahir</label>
                    <div class="controls">
                        <input type="text" name="tmp_lahir" id="tmp_lahir" placeholder="Tempat Lahir" required title="Tempat Lahir"/>
                        <input type="text" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" required title="Tanggal Lahir"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Jenis Kelamin</label>
                    <div class="controls">
                        <select name="jk" id="jk" required title="Jenis Kelamin">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('JK');
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
                    <label class="control-label" for="form-field-1">Agama</label>
                    <div class="controls">
                        <select name="agama" id="agama" required title="Agama">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('AGAMA');
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
                    <label class="control-label" for="form-field-1">Status Kawin</label>
                    <div class="controls">
                        <select name="status_kawin" id="status_kawin" required title="Status Kawin">
                            <option value="">-Pilih-</option>
                            <?php
                            $data = $this->model_data->lovValueByCode('STATUS_KAWIN');
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
                    <label class="control-label" for="form-field-1">HP</label>
                    <div class="controls">
                        <input type="text" name="hp" id="hp" placeholder="HP"  required title="HP"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Username</label>
                    <div class="controls">
                        <input type="text" name="username" id="username" placeholder="Username"  required title="Username"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Password</label>
                    <div class="controls">
                        <input type="password" name="password" id="password" placeholder="Password"  required title="Password"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Photo</label>
                    <div class="controls">
                        <input type="file" name="photo" id="photo" placeholder="Photo" />
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