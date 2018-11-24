<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

	// programer : sevanam enterprise

	public function antrian()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik Antrian";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 
			
			$total = $this->model_data->jml_antrian_now();
			$open = $this->model_data->jml_antrian_open();
			$inprogress = $this->model_data->jml_antrian_inprogress();
			$close = $this->model_data->jml_antrian_close();
			
			$d['total'] = $total;
			$d['open'] = $open;
			$d['inprogress'] = $inprogress; 
			$d['close'] = $close; 
			
			$d['content']= 'grafik/antrian';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */