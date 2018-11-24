<script type="text/javascript">
$(document).ready(function(){
	
	$("#simpan_profil").click(function(){
		
		var string = $("#form-ortu").serialize();
		
		
		if(!$("#nama_lengkap").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama Lengkap tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#nama_lengkap").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/profil/simpan_profil",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Info..!!',
					text: data,
					class_name: 'gritter-info' 
				});
			}
		});
		
	});
	
});
</script>
<div class="row-fluid">
    <div class="span12">       
    	<form name="form-ortu" id="form-ortu">
        <fieldset>
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Nama Lengkap </div>
                <div class="profile-info-value">
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo $nama_lengkap;?>" class="span6"  />
                </div>
            </div>
            
		</div><!--profil info-->
        </fieldset>
        <div class="form-actions center">
             <button type="button" name="simpan_profil" id="simpan_profil" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->