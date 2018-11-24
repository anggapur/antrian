<ul class="nav ace-nav pull-right">
    <li class="light-blue">
        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        	<?php
			$u = $this->session->userdata('username');
			$foto = $this->model_data->cari_foto_username($u);
        	if(!empty($foto)){
			?>
            	<img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/<?php echo $foto;?>" alt="<?php echo $u;?>" />
            <?php }else{ ?>
            <img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/avatar.png" alt="Sevanam Enterprise" />
            <?php } ?>
            <span class="user-info">
                <small>Welcome,</small>
                <?php echo $this->session->userdata('nama_lengkap');?>
            </span>

            <i class="icon-caret-down"></i>
        </a>
        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
            <li>
                <a href="<?php echo base_url();?>index.php/profil">
                    <i class="icon-user"></i>
                    Edit Profile
                </a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="<?php echo base_url();?>index.php/login/logout">
                    <i class="icon-off"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </li>
</ul><!--/.ace-nav-->