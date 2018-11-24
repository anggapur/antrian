<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_manag extends CI_Controller {

	// programer : fadli
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Banner Management";
			$d['class'] = "master";
			
			$d['content'] = 'banner/view';
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
			$id['banner_text_id']	= $this->input->post('cari');
			$q = $this->db->select('m_banner_text.*,s_lov_value.DESCRIPTION')
					->join('s_lov_value','m_banner_text.type = s_lov_value.CODE_VAL')
					->get_where("m_banner_text",$id);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$d['banner_text_id'] = $dt->banner_text_id;
					$d['type'] = $dt->type;
					$d['banner_text'] = $dt->banner_text;
					$d['active_flag'] = $dt->active_flag;
					$d['keterangan'] = $dt->keterangan;
					$d['ordernum'] = $dt->ORDERNUM;
					$d['warna'] = $dt->DESCRIPTION;
				}
				echo json_encode($d);
			}else{
					$d['banner_text_id'] = "0";
					$d['type'] = "";
					$d['banner_text'] = "";
					$d['active_flag'] = "";
					$d['keterangan'] = "";
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}	
	}
	
	public function simpanBG()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$login=$this->session->userdata('username');
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Makassar');
			$data['CODE'] = "TYPE_BANNER";
			$data['DESCRIPTION'] = "#".$this->input->post('color1').",#".$this->input->post('color2');
			$data['CODE_VAL'] = $this->input->post('bgNama');

			$q = $this->db->insert('s_lov_value',$data);
			if($q)
				echo "success";
			else
				echo "failed";
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
			$id['banner_text_id'] = $this->input->post('banner_text_id');			
			$d['banner_text_id'] = $this->input->post('banner_text_id');
			$d['type'] = $this->input->post('type');
			$d['banner_text'] = $this->input->post('banner_text');
			$d['active_flag'] = $this->input->post('active_flag');
			$d['keterangan'] = $this->input->post('keterangan');
						
			$q = $this->db->get_where("m_banner_text",$id);
			$row = $q->num_rows();
			if($row>0){
				//update
	            $orderNow = $this->db->where($id)->get('m_banner_text')->row()->ORDERNUM;
	            $update = $this->db->where('ORDERNUM >',$orderNow)
	            			->set('ORDERNUM','ORDERNUM-1',false)
	            			->update('m_banner_text');
	            $update = $this->db->where('ORDERNUM >=',$this->input->post('order'))
	            			->set('ORDERNUM','ORDERNUM+1',false)
	            			->update('m_banner_text');

	            //get last
	            $ORDERLAST = $this->db->order_by('ORDERNUM','DESC')->get('m_banner_text')->row()->ORDERNUM;
	            $getORDERNUM = $this->input->post('order');			
	            if($getORDERNUM > $ORDERLAST)
	            	$d['ORDERNUM'] = $ORDERLAST+1;			
	            else
	            	$d['ORDERNUM'] = $this->input->post('order');			
	            //insert

				$d['changed_who'] = $login;
				$d['changed_date'] = date('Y-m-d H:i:s');
				$this->db->update("m_banner_text",$d,$id);
				$last_id=$id['banner_text_id'];
				echo "Data Sukses diupdate";
			}else{
				$update = $this->db->where('ORDERNUM >=',$this->input->post('order'))
            			->set('ORDERNUM','ORDERNUM+1',false)
            			->update('m_banner_text');
                        //get last
	            $ORDERLAST = $this->db->order_by('ORDERNUM','DESC')->get('m_banner_text')->row()->ORDERNUM;
	            $getORDERNUM = $this->input->post('order');			
	            if($getORDERNUM > $ORDERLAST)
	            	$d['ORDERNUM'] = $ORDERLAST+1;			
	            else
	            	$d['ORDERNUM'] = $this->input->post('order');

				$d['created_who'] = $login;
				$d['created_date'] = date('Y-m-d H:i:s');
				$this->db->insert("m_banner_text",$d);
				echo "Data Sukses disimpan";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id['banner_text_id']	= $this->uri->segment(3);
			
			//update
	        $orderNow = $this->db->where($id)->get('m_banner_text')->row()->ORDERNUM;
	        $update = $this->db->where('ORDERNUM >',$orderNow)
	            			->set('ORDERNUM','ORDERNUM-1',false)
	            			->update('m_banner_text');

			$q = $this->db->get_where("m_banner_text",$id);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("m_banner_text",$id);
			}
			redirect('banner_manag','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
	public function getDataBanner()
	{
		$q = $this->model_data->lovValueByCode('TYPE_BANNER');
		echo json_encode($q->result());

	}
	public function deleteBG()
	{
		$data['CODE_VAL'] = $this->input->post('CODE_VAL');
		$q = $this->db->delete("s_lov_value",$data);
		if($q)
			echo "success";
		else
			echo "failed";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */