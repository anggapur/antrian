<script type="text/javascript">
$(document).ready(function(){
	selectBannerUpdate();

	$("#simpan").click(function(){
        var formData = new FormData();
        var data_banner = $("#my-form").serializeArray();
        var banner_bool=false;
        var banner_key=0;

        $.each(data_banner,function(key,input){
            //yang diabaikan
            if(!$("#"+input.name).prop('required')){banner_key++;formData.append(input.name,input.value);return true;}

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
                    banner_key++;
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
                    banner_key++;
                }
            }
        });
    
        if(banner_key==data_banner.length){banner_bool=true;} //go to next step
		
		if(banner_bool){
            $.ajax({
                    type    : 'POST',
                    url     : "<?php echo site_url(); ?>/banner_manag/simpan",
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
		$('#banner_text_id').val('0');
        $('#type').val('');
		$('#banner_text').val('');
		$('#active_flag').val('Y');
		$('#keterangan').val('');
		$('#type').focus();
        selectBannerUpdate();
	});

    $('#tambah2').click(function(){
        $('#modal-table').modal('hide');
    });

    $('select#type').change(function(){
        colorVal = $(this).find(':selected').attr('data');
        $('.boxColor2').css({background:'linear-gradient('+colorVal+')'});
    });

    $('#deleteBg').click(function(){
        code = $('select#type').find(':selected').val();
        $.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/banner_manag/deleteBG",
            data    : 
            {
                'CODE_VAL' : code
            },
            cache   : false,            
            success : function(data){
                if(data == "success")            
                {
                    alert("Berhasil Hapus Data Background Banner");
                    selectBannerUpdate();
                }

            }
        });
        
    });
    $('#simpan2').click(function(){
        bgNama = $('input[name="bgNama"]').val();
        color1 = localStorage.getItem("color1");
        color2 = localStorage.getItem("color2");
        // alert(color1+" "+color2);
        $.ajax({
            type    : 'POST',
            url     : "<?php echo site_url(); ?>/banner_manag/simpanBG",
            data    : 
            {
                'bgNama' : bgNama,
                'color1' : color1,
                'color2' : color2
            },
            cache   : false,            
            success : function(data){
                if(data == "success")            
                {
                    alert("Berhasil Simpan Data Background Banner");
                    $('#modal-table2').modal('hide');
                    $('#modal-table').modal('show');
                    selectBannerUpdate();
                }

            }
        });
    });
});

function selectBannerUpdate()
{
    $("#type").html("");
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url(); ?>/banner_manag/getDataBanner",    
        dataType: "json",
        success : function(data){
            console.log(data);
            $('#type').append("<option>-</option>");
            $.each(data,function(i,val){
                $('#type').append("<option data='"+val.DESCRIPTION+"' value='"+val.CODE_VAL+"'>"+val.CODE_VAL+"</option>")
            });
        }
    });
}
function editData(ID){
	var cari	= ID;	
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/banner_manag/cari",
		data	: "cari="+cari,
		dataType: "json",
		success	: function(data){
            console.log(data);
           $('#banner_text_id').val(data.banner_text_id);
            $('#type').val(data.type);
            $('#banner_text').val(data.banner_text);
            $('#active_flag').val(data.active_flag);
            $('#keterangan').val(data.keterangan);
            $('#order').val(data.ordernum);
            $('#type').focus();
			$('.boxColor2').css({background:'linear-gradient('+data.warna+')'});
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
            <th class="center">Banner Text</th>
            <th class="center">Type</th>
            <th class="center">Active Flag</th>
            <th class="center">Order</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$data = $this->model_data->data_banner();
		$i=1;
		foreach($data->result() as $dt){ ?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td><?php echo $dt->banner_text;?></td>
            <td><?php echo $dt->type;?></td>
            <td><?php echo $dt->active_flag;?></td>
            <td><?php echo $dt->ORDERNUM;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="#modal-table" onclick="javascript:editData('<?php echo $dt->banner_text_id;?>')" data-toggle="modal">
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/banner_manag/hapus/<?php echo $dt->banner_text_id;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
            Data Banner
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Type</label>
                    <div class="controls">
                        <input type="hidden" name="banner_text_id" id="banner_text_id"/>
                        <select name="type" id="type" required title="Banner Type">
                            
                        </select>
                        <i class="icon-trash bigger-130" id="deleteBg"></i>
                        <div class="boxColor2" style="height: 50px;width: 220px;background:black;"></div>
                        <a href="#modal-table2" class="btn btn-small btn-success"  role="button" data-toggle="modal" name="tambah2" id="tambah2" >
                            <i class="icon-check"></i>
                            Tambah Background
                        </a>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Banner Text</label>
                    <div class="controls">
                        <textarea type="text" name="banner_text" id="banner_text" placeholder="Banner Text" required title="Banner Text"></textarea>
                        
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Keterangan</label>
                    <div class="controls">
                        <textarea type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required title="Keterangan"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Active Flag</label>
                    <div class="controls">
                        <select name="active_flag" id="active_flag" required title="Active Flag">
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
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Order</label>
                    <div class="controls">
                        <input type="number" name="order"  placeholder="Order"  required title="Order" id="order"/>
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

<!-- modal table -2 -->
<div id="modal-table2" class="modal hide fade" tabindex="-1">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Data Background
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form2">
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Nama Background</label>
                    <div class="controls">
                        <input type="nama-bg" name="bgNama"  placeholder="nama Background"  required title="Nama "/>
                    </div>
                </div>
                <div class="control-group">                    
                    <input type='text' id="custom1" />
                    <input type='text' id="custom2" />
                    <script>

                        $("#custom1").spectrum({
                            flat : true,
                            color: "#000",
                            preferredFormat: "hex",
                            showInput: true,
                            
                            move: function (color) {
                                changeColor();
                            }
                        });
                        $("#custom2").spectrum({
                            flat : true,
                            color: "#f00",
                            preferredFormat: "hex",
                            showInput: true,
                            
                            move: function (color) {
                                // alert(color);
                               changeColor();
                            }
                        });
                        function getColor(id)
                        {
                            return $("#custom"+id).spectrum("get").toHex();
                        }                        
                        function changeColor()
                        {
                            localStorage.setItem('color1',getColor(1));
                            localStorage.setItem('color2',getColor(2));
                             $('.boxColor').css({background:'linear-gradient(#'+getColor(1)+',#'+getColor(2)+')'});
                        }
                        </script>                    
                </div>
                <!-- GROUPING -->
                <div class="control-group">
                    <div class="boxColor" style="height: 50px;width: 100%;">

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
        <button type="button" name="simpan" id="simpan2" class="btn btn-small btn-success pull-left">
            <i class="icon-save"></i>
            Simpan
        </button>
        </div>
    </div>
</div>   
<script type="text/javascript">         
    $('.boxColor').css({background:'linear-gradient(#'+getColor(1)+',#'+getColor(2)+')'});
</script>