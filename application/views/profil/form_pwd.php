<script type="text/javascript">
$(document).ready(function(){
	
	$("#simpan_pwd").click(function(){
		
		var string = $("#form-pwd").serialize();
		
		
		if(!$("#pwd_1").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Password tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#pwd_1").focus();
			return false();
		}
		
		if(!$("#pwd_2").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Ulangi Password tidak boleh kosong',
				class_name: 'gritter-error' 
			});
	
			$("#pwd_2").focus();
			return false();
		}
		
		if($("#pwd_1").val() != $("#pwd_2").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Password tidak sama',
				class_name: 'gritter-error' 
			});
	
			$("#pwd_2").focus();
			return false();
		}
		
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/profil/simpan_pwd",
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
    	<form name="form-pwd" id="form-pwd">
        <fieldset>
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Ganti Passowd </div>
                <div class="profile-info-value">
                    <input type="password" name="pwd_1" id="pwd_1" class="span6"  />
                </div>
            </div>
            
            <div class="profile-info-row">
                <div class="profile-info-name"> Ulangi Passowd </div>
                <div class="profile-info-value">
                    <input type="password" name="pwd_2" id="pwd_2" class="span6"  />
                </div>
            </div>
            
		</div><!--profil info-->
        </fieldset>
        <div class="form-actions center">
             <button type="button" name="simpan_pwd" id="simpan_pwd" class="btn btn-mini btn-primary">
             <i class="icon-save"></i> Simpan
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->