<div class="row-fluid">
    <div class="span12">       
    	<form name="form-foto" id="form-foto" action="<?php echo base_url();?>index.php/profil/simpan_foto" method="post" enctype="multipart/form-data">
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> Upload File Foto </div>
                <div class="profile-info-value">
                    <input type="file" name="gambar" id="gambar" />
                </div>
            </div>
            
		</div><!--profil info-->
        <div class="form-actions center">
             <button type="submit" name="simpan_foto" id="simpan_foto" class="btn btn-mini btn-primary">
             <i class="icon-cloud-upload "></i> Upload Foto
             </button>
        </div>     
		</form>
    </div><!--/span-->
</div><!--/row-fluid-->