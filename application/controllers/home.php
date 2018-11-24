<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function setTimeDefault()
	{
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Dashboard";
			$d['class'] = "home";

			//start of grafik antrian
			$total = $this->model_data->jml_antrian_now();
			$open = $this->model_data->jml_antrian_open();
			$inprogress = $this->model_data->jml_antrian_inprogress();
			$close = $this->model_data->jml_antrian_close();
			
			$d['total'] = $total;
			$d['open'] = $open;
			$d['inprogress'] = $inprogress; 
			$d['close'] = $close; 
			//end of grafik antrian
			
			$d['content']= 'isi';
			$this->load->view('home',$d);
		}
		else if(!empty($cek) && $level=='operator'){
			$d['judul']="Dashboard";
			$d['class'] = "home";

			//start of grafik antrian
			$total = $this->model_data->jml_antrian_now();
			$open = $this->model_data->jml_antrian_open();
			$inprogress = $this->model_data->jml_antrian_inprogress();
			$close = $this->model_data->jml_antrian_close();
			
			$d['total'] = $total;
			$d['open'] = $open;
			$d['inprogress'] = $inprogress; 
			$d['close'] = $close; 
			//end of grafik antrian
			
			$d['content']= 'homeOperator';
			$this->load->view('home',$d);
		}
		else{
			redirect('login','refresh');
		}
	}
	public function getPelayanan()
	{
		$this->setTimeDefault();
		
		$data['sudahDilayani'] = $this->model_data->getDataSudahDilayani($this->session->userdata('LOKETNO'));
		$data['belumDilayani'] = $this->model_data->getDataBelumDilayani($this->session->userdata('LOKETNO'));
		echo json_encode($data);
	}

	public function callNext()
	{
		$this->setTimeDefault();
		$data['antrian_now'] = $this->model_data->getAntrianNow($this->session->userdata('LOKETNO'));
		echo json_encode($data);
	}
	public function APIcallNext($USERID)
	{
		$this->setTimeDefault();
		$LOKETNO = "A";
		$data['antrian_now'] = $this->model_data->APIgetAntrianNow($LOKETNO,$USERID);
		$datas = $this->db->where('ANTRIAN_NO',$data['antrian_now'])
					->order_by('ANTRIAN_ID','DESC')
					->limit(1)
					->join('t_loket','t_antrian.LOKETNO = t_loket.LOKET_ID')					
					->select('t_antrian.ANTRIAN_NO,t_loket.NAMA_LOKET')
					->get('t_antrian')
					->row();
		$jenis_pelayanan = $this->db->where('KODE_LOKET',$datas->ANTRIAN_NO[0])->get('t_jenis_loket')->row();

		$dataJSON['no_antrian'] = $datas->ANTRIAN_NO;
		$dataJSON['nama_loket'] = $datas->NAMA_LOKET;
		$dataJSON['jenis_pelayanan'] = $jenis_pelayanan->TYPE_LOKET;		
		$dataJSON['sudah_dilayani'] = $this->model_data->dataApiGetDataSudahDilayani($USERID);
		$dataJSON['belum_dilayani'] = $this->model_data->dataApiGetDataBelumDilayani($USERID);
		echo json_encode($dataJSON);
	}

	public function getDataSedangDilayani()
	{
		$this->setTimeDefault();
		$data['sedangDilayani'] = $this->model_data->getDilayaniNow($this->session->userdata('LOKETNO'));
		echo json_encode($data);
	}

	public function callRepeat()
	{
		$this->setTimeDefault();		
		$this->model_data->repeatCall($this->session->userdata('LOKETNO'));

	}
	public function APICallRepeat($USERID)
	{		
		//KODE LOKET = A / B / C
		//USER iD = id dari user
		$this->setTimeDefault();	
		$KODELOKET = "A";	
		$data['antrian_now'] = $this->model_data->APIrepeatCall($KODELOKET,$USERID)->ANTRIAN_NO;
		$datas = $this->db->where('ANTRIAN_NO',$data['antrian_now'])
					->order_by('ANTRIAN_ID','DESC')
					->limit(1)
					->join('t_loket','t_antrian.LOKETNO = t_loket.LOKET_ID')					
					->select('t_antrian.ANTRIAN_NO,t_loket.NAMA_LOKET')
					->get('t_antrian')
					->row();
		$jenis_pelayanan = $this->db->where('KODE_LOKET',$datas->ANTRIAN_NO[0])->get('t_jenis_loket')->row();

		$dataJSON['no_antrian'] = $datas->ANTRIAN_NO;
		$dataJSON['nama_loket'] = $datas->NAMA_LOKET;
		$dataJSON['jenis_pelayanan'] = $jenis_pelayanan->TYPE_LOKET;		
		$dataJSON['sudah_dilayani'] = $this->model_data->dataApiGetDataSudahDilayani($USERID);
		$dataJSON['belum_dilayani'] = $this->model_data->dataApiGetDataBelumDilayani($USERID);
		echo json_encode($dataJSON);

	}
	public function checkActiveNext()
	{
		$this->setTimeDefault();		
		$isInCall = $this->model_data->isInCall($this->session->userdata('LOKETNO'));
		$isThereAny = $this->model_data->isThereAny($this->session->userdata('LOKETNO'));
		if($isInCall == "incall" || $isThereAny == "-")
			$data['state'] = "unactive";
		else
			$data['state'] = "active";
		echo json_encode($data);
	}
	public function checkJenisNamaLoket()
	{
		$data['jenisLoket'] = $this->model_data->getInfoLoket($this->session->userdata('LOKETNO'),'jenis');
		$data['namaLoket'] = $this->model_data->getInfoLoket($this->session->userdata('LOKETNO'),'nama');
		echo json_encode($data);
	}
	public function dataLoketHandleable()
	{
		$query = $this->model_data->dataLoketHandleable();
		echo json_encode($query);
	}
	public function changeLoket()
	{
		$JENIS_LOKET_ID =$this->input->post('JENIS_LOKET_ID');
		$sess_data['LOKETNO'] = $JENIS_LOKET_ID;
		$q = $this->session->set_userdata($sess_data);
		echo "success";		
	}
	public function getVolume()
	{
		$getVolume = $this->db->where('CODE','VOLUME')->get('s_lov_value')->row()->CODE_VAL;
		echo $getVolume;
	}
	public function sendVolume()
	{
		$vol = $this->input->post('volume');
		$q = $this->db->set('CODE_VAL',$vol)->where('CODE','VOLUME')->update('s_lov_value');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */