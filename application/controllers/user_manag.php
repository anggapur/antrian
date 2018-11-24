<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_manag extends CI_Controller {

	// programer : fadli
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="User Management";
			$d['class'] = "master";
			
			$d['content'] = 'user/view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['user_id']	= $this->input->post('cari');
			
			$q = $this->db->get_where("s_user",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['user_id'] = $dt->USER_ID;
					$d['login'] = $dt->LOGIN;
					$d['pwd'] = $dt->PWD;
					$d['name'] = $dt->NAME;
					$d['tmp_lahir'] = $dt->TEMPAT_LAHIR;
					$d['tgl_lahir'] = $dt->TGL_LAHIR;
					$d['jenis_kelamin'] = $dt->JENIS_KELAMIN;
					$d['alamat'] = $dt->ALAMAT;
					$d['hp1'] = $dt->HP1;
					$d['photo'] = $dt->PHOTO;
					$d['agama'] = $dt->AGAMA;
					$d['status_kawin'] = $dt->STATUS_KAWIN;
					$d['type_user'] = $dt->TYPE_USER;
				}
				echo json_encode($d);
			}else{
					$d['user_id'] = "0";
					$d['login'] = "";
					$d['pwd'] = "";
					$d['name'] = "";
					$d['tmp_lahir'] = "";
					$d['tgl_lahir'] = "";
					$d['jenis_kelamin'] = "";
					$d['alamat'] = "";
					$d['hp1'] = "";
					$d['photo'] = "";
					$d['agama'] = "";
					$d['status_kawin'] = "";
					$d['type_user'] = "";
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}	
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$login=$this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Makassar');
			$id['user_id'] = $this->input->post('user_id');
			$d['user_id'] = $this->input->post('user_id');
			$d['login'] = $this->input->post('username');
			$d['pwd'] = $this->input->post('password');
			$d['name'] = $this->input->post('nama');
			$d['tempat_lahir'] = $this->input->post('tmp_lahir');
			$d['tgl_lahir'] = $this->input->post('tgl_lahir');
			$d['jenis_kelamin'] = $this->input->post('jk');
			$d['alamat'] = $this->input->post('alamat');
			$d['hp1'] = $this->input->post('hp');
			$d['agama'] = $this->input->post('agama');
			$d['status_kawin'] = $this->input->post('status_kawin');
			$d['type_user'] = $this->input->post('otoritas');

			/*if(isset($_FILES['photo']['name']) && $_FILES['photo']['name']!=""){
				$data['photo'] = $_FILES['photo']['name'];	
			}*/
						
			$q = $this->db->get_where("s_user",$id);
			$row = $q->num_rows();
			if($row>0){
				$d['CHANGE_WHO'] = $login;
				$d['CHANGE_DATE'] = date('Y-m-d H:i:s');
				$this->db->update("s_user",$d,$id);
				$last_id=$id['user_id'];
				foreach($q->result() as $d){
					$photoLama = $d->PHOTO;
				}
				echo "Data Sukses diupdate";
			}else{
				$d['CREATED_WHO'] = $login;
				$d['CREATED_DATE'] = date('Y-m-d H:i:s');
				$this->db->insert("s_user",$d);
				echo "Data Sukses disimpan";
			}

			//upload file here
			/*if($lastid!="0"){
				if(isset($_FILES['photo']['name'])  && $_FILES['photo']['name']!="")
				{
					$config['upload_path'] = './assets/avatars';
					$config['allowed_types'] = 'gif|jpg|png|bmp';
					$config['file_name'] = "user_".$lastid.".".pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); 
					$this->load->library('upload', $config);

					if(file_exists($config['upload_path'].'/'.$config['file_name'])){
						unlink($config['upload_path'].'/'.$config['file_name']);
					}

					
					if($this->upload->do_upload('file_photo'))
					{
						$image_data = $this->upload->data();
						//Update name image in database
						$id['user_id']  = $lastid;
						$dataPhoto['photo'] =$config['file_name'];
						$this->db->update("s_user",$dataPhoto,$id);
					}
				}	
			}*/
			//end upload file
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['user_id']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("s_user",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("s_user",$id);
			}
			redirect('user_manag','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */