<?php
if($class=='home'){
	$home = 'class="active"';
	$master ='';
	$transaksi = '';
    $user_privilege = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='master'){
	$home = '';
    $user_privilege = '';
	$master ='class="active"';
	$transaksi = '';
	$laporan = '';
	$grafik = '';
}elseif($class=='laporan'){
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = 'class="active"';
    $user_privilege = '';
	$grafik = '';					
}elseif($class=='user_privilege'){
    $home = '';
    $master ='';
    $transaksi = '';
    $laporan = '';
    $user_privilege = 'class="active"';
    $grafik = '';                   
}else{
	$home = '';
	$master ='';
	$transaksi = '';
	$laporan = '';
    $user_privilege = '';
	$grafik = 'class="active"';
}
?>
<div class="main-container container-fluid">
<a class="menu-toggler" id="menu-toggler" href="#">
    <span class="menu-text"></span>
</a>
<div class="sidebar" id="sidebar">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <i class="icon-calendar"></i> 
			<?php 
			date_default_timezone_set('Asia/Jakarta');
			echo $this->model_global->hari_ini(date('w')).", ".$this->model_global->tgl_indo(date('Y-m-d'));
			?>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!--#sidebar-shortcuts-->
	
    <div align="center">
    <img src="<?php echo base_url()."assets/img/".$this->model_data->getMainLogo();?>" width="80">
    <h6><?php //echo $this->config->item('nama_instansi');?><?= $this->model_data->getMainNama();?></h6>
    </div>
    
    <?php if($this->session->userdata('level') == "admin"): ?>
    <ul class="nav nav-list">
        <li <?php echo $home;?> >
            <a href="<?php echo base_url();?>index.php/home">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        <li <?php echo $master;?> >
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Content Management </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo base_url();?>index.php/main_manag">
                        <i class="icon-double-angle-right"></i>
                        Main Content Managemet
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>index.php/user_manag">
                        <i class="icon-double-angle-right"></i>
                        User Management
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/content_manag">
                        <i class="icon-double-angle-right"></i>
                        Content Management
                    </a>
                </li>
				<li>
                    <a href="<?php echo base_url();?>index.php/banner_manag">
                        <i class="icon-double-angle-right"></i>
                        Banner Text
                    </a>
                </li>
				<li>
                    <a href="<?php echo base_url();?>index.php/polling_manag">
                        <i class="icon-double-angle-right"></i>
                        Polling Management
                    </a>
                </li>                
            </ul>
        </li>
        <li <?php echo $laporan;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-print"></i>
                <span class="menu-text"> Reporting </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
            	 <li>
                    <a href="<?php echo base_url();?>index.php/lap_trx">
                        <i class="icon-double-angle-right"></i>
                        Trx Antrian Report
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/lap_csr">
                        <i class="icon-double-angle-right"></i>
                        CSR Report
                    </a>
                </li>
                 <li>
                    <a href="<?php echo base_url();?>index.php/lap_polling">
                        <i class="icon-double-angle-right"></i>
                        Polling Report
                    </a>
                </li>
            </ul>
        </li>
        <li <?php echo $user_privilege;?> >
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Loket & User Privilege </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo base_url();?>index.php/jenisPelayananSetting">
                        <i class="icon-double-angle-right"></i>
                        Jenis Pelayanan
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/loketSetting">
                        <i class="icon-double-angle-right"></i>
                        Loket
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/userPrivilegeSetting">
                        <i class="icon-double-angle-right"></i>
                        User Privilege
                    </a>
                </li>                            
            </ul>
        </li>

        <!--<li <?php echo $grafik;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-bar-chart"></i>
                <span class="menu-text">
                    Grafik
                </span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
               	 <li>
                    <a href="<?php echo base_url();?>index.php/grafik/mhs">
                        <i class="icon-double-angle-right"></i>
                        Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/grafik/dosen">
                        <i class="icon-double-angle-right"></i>
                        Dosen
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo base_url();?>index.php/grafik/mhs_aktif">
                        <i class="icon-double-angle-right"></i>
                        Mahasiswa Aktif
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>index.php/grafik/krs">
                        <i class="icon-double-angle-right"></i>
                        KRS
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>index.php/grafik/wisuda">
                        <i class="icon-double-angle-right"></i>
                        Wisuda
                    </a>
                </li>
            </ul>
        </li>-->
         <li>
            <a href="<?php echo base_url();?>index.php/login/logout">
                <i class="icon-off"></i>
                <span class="menu-text"> Keluar </span>
            </a>
        </li>
    </ul><!--/.nav-list-->
    <?php endif; ?>
    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>