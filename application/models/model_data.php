<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_data extends CI_Model {

	// ANGGA PURNAJIWA
	public function getMainLogo()
	{
		$d['MAIN_LOGO_LOGIN'] = $this->db->where('CODE','MAIN_LOGO_LOGIN')->get('s_lov_value')->row()->DESCRIPTION;
		return $d['MAIN_LOGO_LOGIN'];
	}
	public function getDisplayLogo()
	{
		$d['MAIN_LOGO_DISPLAY'] = $this->db->where('CODE','MAIN_LOGO_DISPLAY')->get('s_lov_value')->row()->DESCRIPTION;
		return $d['MAIN_LOGO_DISPLAY'];
	}
	public function getMainNama()
	{
		$d['MAIN_NAMA'] = $this->db->where('CODE','MAIN_NAMA')->get('s_lov_value')->row()->DESCRIPTION;
		return $d['MAIN_NAMA'];
	}
	public function getMainAlamat()
	{
		$d['MAIN_ALAMAT'] = $this->db->where('CODE','MAIN_ALAMAT')->get('s_lov_value')->row()->DESCRIPTION;
		return $d['MAIN_ALAMAT'];
	}
	public function data_loket()
	{
		$q = $this->db
			->get('t_loket');
		return $q;
	}
	public function banner_list()
	{
		$q = $this->db
			->where('active_flag','Y')
			->get('m_banner_text');
		return $q;
	}
	public function banner_list_marquee()
	{
		$q = $this->db
			->join('s_lov_value','m_banner_text.type = s_lov_value.CODE_VAL')
			->select('m_banner_text.*,s_lov_value.DESCRIPTION')
			->where('m_banner_text.active_flag','Y')
			->order_by('ORDERNUM','ASC')
			->get('m_banner_text');
		return $q;
	}
	public function data_jenis_loket($STATE)
	{
		$q = $this->db;
		if($STATE !== "ALL")			
			$q = $q->where('STATUS',$STATE);
		$q = $q->get('t_jenis_loket');
		return $q;
	}
	public function data_pertanyaan_polling($id_pertanyaan)
	{
		$q = $this->db
			->where('polling_id',$id_pertanyaan)
			->get('m_polling');
		return $q;
	}
	public function makeTicket($ID_LOKET,$KODE_LOKET,$TYPE_LOKET)
	{
		date_default_timezone_set('Asia/Jakarta');
		//CHECK, THERE IS TICKET WITH SAME LOCKET TODAY
		$find = $this->db
				->where('TRX_DATE >=',date('Y-m-d'))
				->like('ANTRIAN_NO',$KODE_LOKET,'after');
		$hitung = $find->get('t_antrian')->num_rows;
		if($hitung == 0)
		{
			$ANTRIAN_NO = $KODE_LOKET."1";
			$nowNumber = 1;
		}
		else
		{
			
			$lastNumber = $hitung;
			$nowNumber = $lastNumber+1;
			$ANTRIAN_NO = $KODE_LOKET.$nowNumber;
		}

		//ARRANGE DATA
		$data = [
				'TRX_DATE'=>date('Y-m-d H:i:s'),
				'ANTRIAN_NO' => $ANTRIAN_NO,
				'TYPE'=>$TYPE_LOKET,
				'STATUS'=>'OPEN',				
				'CREATED_DATE'=>date('Y-m-d H:i:s'),
				'KODE'=>$KODE_LOKET,
				'NO'=>$nowNumber
		];
		//STORE DATA TO t_antrian
		$q = $this->db->insert('t_antrian',$data);			
		//Mencari tahu berapa Yang di depan
		$ANTRIAN_DIDEPAN = $this->db
							->where('TRX_DATE >=',date('Y-m-d'))
							->where('TRX_DATE <',$data['TRX_DATE'])
							->where('STATUS','OPEN')
							->like('ANTRIAN_NO',$KODE_LOKET,'after')
							->get('t_antrian')->num_rows();
		//SET DATA
		$data = [
			'ANTRIAN_NO' => $ANTRIAN_NO,
			'TYPE_LOKET' => $TYPE_LOKET,
			'KODE_LOKET' => $KODE_LOKET,
			'ID_LOKET' => $ID_LOKET,
			'JUMLAH_ANTRIAN_DIDEPAN' => $ANTRIAN_DIDEPAN,
			'CREATE_TIME' => $data['TRX_DATE']
		];

		return $data;
	}

	public function submitPolling($polling_id,$jawaban)
	{
		$data = [
			'POLLING_ID' => $polling_id,
			'TRX_DATE' => date('Y-m-d h:i:s'),
			'CREATED_DATE' => date('Y-m-d h:i:s'),
			'USER_COMMENT' => $jawaban
		];
		$query = $this->db->insert('t_user_polling',$data);
		
		return $query;
	}

	public function getInfoLoket($LOKETNO,$identitas)
	{
		$query = $this->db->where('JENIS_LOKET_ID',$LOKETNO)->get('t_jenis_loket')->row();
		if($identitas == "jenis")
			return $query->TYPE_LOKET;
		else if($identitas == "nama")
			return $query->NAMA_LOKET;
	}

	public function getDataSudahDilayani($ID_LOKET)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$count = 0;
		foreach ($this->getKodeJenisByHandle() as $key => $value) {					
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")				
				->where('STATUS','CLOSE')
				->like('ANTRIAN_NO',$value,'after')
				->get('t_antrian')->num_rows();
		$count+=$QUERY;
		}
		return $count;
	}
	public function dataApiGetDataSudahDilayani($USER_ID)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$count = 0;
		foreach ($this->getKodeJenisByHandle($USER_ID) as $key => $value) {					
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")				
				->where('STATUS','CLOSE')
				->like('ANTRIAN_NO',$value,'after')
				->get('t_antrian')->num_rows();
		$count+=$QUERY;
		}
		return $count;
	}

	public function getDataBelumDilayani($ID_LOKET)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$count = 0;
		foreach ($this->getKodeJenisByHandle() as $key => $value) {	
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:0")							
				->where('STATUS','OPEN')
				->like('ANTRIAN_NO',$value,'after')
				->get('t_antrian')->num_rows();
			$count+=$QUERY;
		}
		return $count;
	}
	public function dataApiGetDataBelumDilayani($USER_ID)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$count = 0;
		foreach ($this->getKodeJenisByHandle($USER_ID) as $key => $value) {	
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:0")							
				->where('STATUS','OPEN')
				->like('ANTRIAN_NO',$value,'after')
				->get('t_antrian')->num_rows();
			$count+=$QUERY;
		}
		return $count;
	}
	public function getKodeJenisByHandle($USER_ID = "")
	{
		if($USER_ID == "")
			$user_id = $this->session->userdata('USER_ID');
		else
			$user_id = $USER_ID;

		//
		$KODE_LOKET = $this->db->WHERE('USER_ID',$user_id)
						->select('KODE_LOKET')
						->join('t_jenis_loket','t_user_loket.JENIS_LOKET_ID = t_jenis_loket.JENIS_LOKET_ID')
						->get('t_user_loket')->result_array();
		$arr = array_map (function($value){
		    return $value['KODE_LOKET'];
		} , $KODE_LOKET);
		return $arr;
	}
	public function getAntrianNow($ID_LOKET)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$i = 0;
		$arr = [];
		foreach ($this->getKodeJenisByHandle() as $key => $value) {
			$arr[$i++] = $value;
		}
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','OPEN')
				->where_in('KODE',$arr)
				->order_by('ANTRIAN_ID','ASC')
				->limit(1)
				->get('t_antrian')->row();
		$id = $QUERY->ANTRIAN_ID;
		$change = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','INPROGRESS')
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$this->session->userdata('USER_ID'))
				->set('STATUS','CLOSE')
				->update('t_antrian');
		//update ke incall
		$updating = $this->db->set('STATUS','INCALL')
					->set('SERVICED_BY',$this->session->userdata('USER_ID'))
					->set('SERVICED_STARTDATE',date('Y-m-d h:i:s'))
					->set('LOKETNO',$this->getLoketNoByUser())
					->where('ANTRIAN_ID',$id)
					->update('t_antrian');
		return $QUERY->ANTRIAN_NO;
	}
	public function APIgetAntrianNow($ID_LOKET,$USER_ID)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$KODE_LOKET = "";
		$i = 0;
		$arr = [];
		foreach ($this->getKodeJenisByHandle($USER_ID) as $key => $value) { ////
			$arr[$i++] = $value;
		}
		$QUERY 	= $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','OPEN')
				->where_in('KODE',$arr)
				->order_by('ANTRIAN_ID','ASC')
				->limit(1)
				->get('t_antrian')->row();
		$id = $QUERY->ANTRIAN_ID;
		$change = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','INPROGRESS')
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$USER_ID)
				->set('STATUS','CLOSE')
				->update('t_antrian');
		//update ke incall
		$updating = $this->db->set('STATUS','INCALL')
					->set('SERVICED_BY',$USER_ID)
					->set('SERVICED_STARTDATE',date('Y-m-d h:i:s'))
					->set('LOKETNO',$this->getLoketNoByUser($USER_ID)) 
					->where('ANTRIAN_ID',$id)
					->update('t_antrian');
		return $QUERY->ANTRIAN_NO;
	}

	public function getLoketNoByUser($USER_ID = "")
	{
		if($USER_ID == "")
		{
			return $this->session->userdata('LOKETNO');
		}
		else
		{
			$q = $this->db
			->where('USER_ID',$USER_ID)
			->get('s_user')->row();
			return $q->LOKETNO;
		}
		
	}
	public function checkDataDisplay()
	{
		$jenis_pelayanan = $this->data_jenis_loket('Y');
		$data = [];
		$i = 0;
		foreach ($jenis_pelayanan->result() as $key => $value) {

			$q = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")	
				->where('TYPE',$value->TYPE_LOKET)
				->order_by('SERVICED_STARTDATE','DESC')
				->join('t_loket','t_antrian.LOKETNO = t_loket.LOKET_ID')
				->limit(1)
				->get('t_antrian');				

			$data[$i]['JENIS_PELAYANAN'] = $value->TYPE_LOKET;
			if($q->num_rows() == 0)
			{
				$data[$i]['ANTRIAN_NO'] = "-";
				$data[$i]['NAMA_LOKET'] = "-";
			}
			else
			{
				$data[$i]['ANTRIAN_NO'] = $q->row()->ANTRIAN_NO;
				$data[$i]['NAMA_LOKET'] = $q->row()->NAMA_LOKET;
			}

			$i++;
		}

		return $data;

	}
	public function getDilayaniNow($ID_LOKET)
	{
		$i = 0;
		$arr = [];
		foreach ($this->getKodeJenisByHandle() as $key => $value) {
			$arr[$i++] = $value;
		}
		$KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")											
				->where('(STATUS = "INPROGRESS" OR STATUS = "INCALL")',NULL,FALSE)								
				->where_in('KODE',$arr)
				->where('SERVICED_BY',$this->session->userdata('USER_ID'))
				->join('t_loket','t_antrian.LOKETNO = t_loket.LOKET_ID')
				->select('t_antrian.*,t_loket.NAMA_LOKET')
				->get('t_antrian');				
		if($query->num_rows() > 0)
			return $query->row();
		else 
			return "-";
	}
	public function isInCall($ID_LOKET)
	{
		$KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")											
				->where('STATUS','INCALL')								
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$this->session->userdata('USER_ID'))
				->get('t_antrian');				
		if($query->num_rows() > 0)
			return "incall";
		else 
			return "-";
	}
	public function isThereAny($ID_LOKET)
	{
		$i = 0;
		$arr = [];
		foreach ($this->getKodeJenisByHandle() as $key => $value) {
			$arr[$i++] = $value;
		}
		$KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")											
				->where('STATUS','OPEN')								
				->where_in('KODE',$arr)				
				->get('t_antrian');				
		if($query->num_rows() > 0)
			return "there";
		else 
			return "-";
	}

	public function repeatCall($ID_LOKET)
	{
		$KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','INPROGRESS')
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$this->session->userdata('USER_ID'))
				->set('STATUS','INCALL')
				->set('SERVICED_STARTDATE',date('Y-m-d h:i:s'))
				->update('t_antrian');	
		return $query;
	}
	public function APIrepeatCall($ID_LOKET,$USER_ID)
	{
		// $KODE_LOKET = $this->db->where('JENIS_LOKET_ID',$ID_LOKET)->get('t_jenis_loket')->row()->KODE_LOKET;
		$KODE_LOKET = "";
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','INPROGRESS')
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$USER_ID)
				->set('STATUS','INCALL')
				->set('SERVICED_STARTDATE',date('Y-m-d h:i:s'))
				->update('t_antrian');	
		$query = $this->db
				->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")							
				->where('STATUS','INCALL')
				->like('ANTRIAN_NO',$KODE_LOKET,'after')
				->where('SERVICED_BY',$USER_ID)
				
				->get('t_antrian')->row();	
		return $query;
	}

	public function dataNoAntrianDiLoket()
	{
		$query = $this->db
					->where('TRX_DATE >=',date('Y-m-d')." 00:00:00")		
					->where('(t_antrian.STATUS = "INPROGRESS" OR t_antrian.STATUS = "INCALL")',NULL,FALSE)	
					->join('t_jenis_loket','t_antrian.LOKETNO = t_jenis_loket.JENIS_LOKET_ID')
					->join('t_loket','t_antrian.LOKETNO = t_loket.LOKET_ID')
					->select('ANTRIAN_ID,TYPE,ANTRIAN_NO,t_antrian.STATUS,NAMA_LOKET')
					->order_by('SERVICED_STARTDATE','ASC')
					->get('t_antrian');
		return $query;
	}

	public function ubahStateAntrianNo($ANTRIAN_ID)
	{
		$query = $this->db							
				->where('ANTRIAN_ID',$ANTRIAN_ID)
				->set('STATUS','INPROGRESS')
				->update('t_antrian');
		return $query;
	}
	public function dataLoketHandleable()
	{
		$query = $this->db
				->where('USER_ID',$this->session->userdata('USER_ID'))
				->join('t_jenis_loket','t_user_loket.JENIS_LOKET_ID = t_jenis_loket.JENIS_LOKET_ID')
				->select('t_user_loket.*,t_jenis_loket.TYPE_LOKET,t_jenis_loket.KODE_LOKET,t_jenis_loket.NAMA_LOKET')
				->where('t_jenis_loket.STATUS','Y')
				->get('t_user_loket');
		return $query->result();
	}
	public function dataLoketHandleableByID($USER_ID)
	{
		$query = $this->db
				->where('USER_ID',$USER_ID)
				->join('t_jenis_loket','t_user_loket.JENIS_LOKET_ID = t_jenis_loket.JENIS_LOKET_ID')
				->join('t_loket','t_user_loket.LOKET_ID = t_loket.LOKET_ID')
				->select('t_user_loket.*,t_jenis_loket.TYPE_LOKET,t_jenis_loket.KODE_LOKET,t_loket.NAMA_LOKET')
				->where('t_jenis_loket.STATUS','Y')
				->get('t_user_loket');
		return $query->result();
	}
	public function data_jenis_loket_all()
	{
		$q = $this->db
			->get('t_jenis_loket');
		return $q;
	}
	public function data_jenis_loket_all_grouping()
	{
		$q = $this->db
			->group_by('TYPE_LOKET')
			->get('t_jenis_loket');
		return $q;
	}
	public function inputDataJenisPelayanan($data)
	{		
		$q = $this->db->insert('t_jenis_loket',$data);	
		return $q;
	}
	public function inputDataLoket($data)
	{		
		$q = $this->db->insert('t_loket',$data);	
		return $q;
	}
	public function getEntertaimentContent()
	{
		$q = $this->db
			->select('CONTENT_ID,TYPE,FILENAME,DURATION')
			->order_by('ORDERNUM','ASC')
			->get('m_content');			
		return $q->result();
	}
	public function getUser($role)
	{
		$q = $this->db
			->where('TYPE_USER',$role)
			->select('USER_ID,LOGIN,NAME')
			->get('s_user');
		return $q;
	}
	public function handleByUser($USER_ID)
	{
		$query = $this->db
				->where('USER_ID',$USER_ID)
				->join('t_jenis_loket','t_user_loket.JENIS_LOKET_ID = t_jenis_loket.JENIS_LOKET_ID')
				->join('t_loket','t_user_loket.LOKET_ID = t_loket.LOKET_ID')
				->select('t_user_loket.*,t_jenis_loket.TYPE_LOKET,t_jenis_loket.KODE_LOKET,t_loket.NAMA_LOKET')	
				->get('t_user_loket');
		return $query;

	}
	// END ANGGA PURNAJIWA
	public function data_user(){
		$q = $this->db->order_by('user_id');
		$q = $this->db->get('s_user');
		return $q;
	}

	public function data_banner(){
		$q = $this->db->order_by('ORDERNUM','ASC');
		$q = $this->db->get('m_banner_text');
		return $q;
	}

	public function data_content(){
		$q = $this->db->order_by('ORDERNUM','ASC');
		$q = $this->db->get('m_content');
		return $q;
	}

	public function data_polling(){
		$q = $this->db->order_by('polling_id');
		$q = $this->db->get('m_polling');
		return $q;
	}

	public function lovValueByCode($code){
		$q = $this->db->query("SELECT * FROM s_lov_value WHERE code='$code'");
		return $q;
	}

	public function data_tipe_antrian(){
		$q = $this->db->query("SELECT DISTINCT(TYPE) AS tipe FROM t_antrian");
		return $q;
	}

	public function data_csr(){
		$q = $this->db->query("SELECT DISTINCT(login) AS csr FROM s_user where login!='admin'");
		return $q;
	}
	
	/*** jumlah data ***/
	public function jml_data($table){
		$q = $this->db->get($table);
		return $q->num_rows();
	}

	public function jml_antrian_now(){
		$q = $this->db->query("SELECT * FROM t_antrian WHERE CAST(trx_date AS DATE)=CAST(NOW() AS DATE)");
		return $q->num_rows();
	}	

	public function jml_antrian_open(){
		$q = $this->db->query("SELECT * FROM t_antrian WHERE status='OPEN' and CAST(trx_date AS DATE)=CAST(NOW() AS DATE)");
		return $q->num_rows();
	}

	public function jml_antrian_inprogress(){
		$q = $this->db->query("SELECT * FROM t_antrian WHERE status='INPROGRESS' and CAST(trx_date AS DATE)=CAST(NOW() AS DATE)");
		return $q->num_rows();
	}

	public function jml_antrian_close(){
		$q = $this->db->query("SELECT * FROM t_antrian WHERE status='CLOSE' and CAST(trx_date AS DATE)=CAST(NOW() AS DATE)");
		return $q->num_rows();
	}
	
	/*** data table ***/
	public function data($table){
		$q = $this->db->get($table);
		return $q->result();
	}
	
	/**** REFERENSI ***/
	
	/*** cari_data **/	
	public function cari_foto_username($u){
		$q = $this->db->query("SELECT * FROM s_user WHERE login='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->PHOTO;
		}
		return $hasil;
	}

	/*** CHART ***/

	/*** QUERY LAPORAN ***/
	public function lap_trx($tgl_awal,$tgl_akhir,$tipe){
		$this->db->query("SET @vDateAwal=STR_TO_DATE('$tgl_awal','%d-%m-%Y');");
		$this->db->query("SET @vDateAkhir=STR_TO_DATE('$tgl_akhir','%d-%m-%Y');");
		$this->db->query("SET @vType=CONCAT('%','$tipe','%')");
		$q = $this->db->query("SELECT 
									xx.*,
									(
										SELECT COUNT(*) AS jml FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='OPEN' AND TYPE=xx.TIPE
									) AS stat_open,
									(
										SELECT COUNT(*) AS jml FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='INPROGRESS' AND TYPE=xx.TIPE
									) AS stat_inprogress,
									(
										SELECT COUNT(*) AS jml FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND TYPE=xx.TIPE
									) AS stat_close,
									IFNULL((
										SELECT MIN(TIMEDIFF(serviced_enddate,serviced_startdate)) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND TYPE=xx.TIPE
									),'-') AS min_time,
									IFNULL((
										SELECT MAX(TIMEDIFF(serviced_enddate,serviced_startdate)) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND TYPE=xx.TIPE
									),'-') AS max_time,
									IFNULL((
										SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(serviced_enddate,serviced_startdate)))) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND TYPE=xx.TIPE
									),'-') AS average_time
								FROM
								(
									SELECT 
										TYPE AS tipe,
										COUNT(*) AS jml
									FROM t_antrian 
									WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)
									AND TYPE LIKE @vType
									GROUP BY TYPE
								)XX
								ORDER BY tipe;
							");
		return $q;
	}

	public function lap_csr($tgl_awal,$tgl_akhir,$csr){
		$this->db->query("SET @vDateAwal=STR_TO_DATE('$tgl_awal','%d-%m-%Y');");
		$this->db->query("SET @vDateAkhir=STR_TO_DATE('$tgl_akhir','%d-%m-%Y');");
		$this->db->query("SET @vType=CONCAT('%','$csr','%')");
		$q = $this->db->query("SELECT 
									xx.*,
									(
										SELECT COUNT(*) AS jml FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='INPROGRESS' AND TYPE=xx.csr
									) AS stat_inprogress,
									(
										SELECT COUNT(*) AS jml FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND serviced_by=xx.csr
									) AS stat_close,
									IFNULL((
										SELECT MIN(TIMEDIFF(serviced_enddate,serviced_startdate)) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND serviced_by=xx.csr
									),'-') AS min_time,
									IFNULL((
										SELECT MAX(TIMEDIFF(serviced_enddate,serviced_startdate)) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND serviced_by=xx.csr
									),'-') AS max_time,
									IFNULL((
										SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(TIMEDIFF(serviced_enddate,serviced_startdate)))) FROM t_antrian 
										WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) 
										AND CAST(@vDateAkhir AS DATE) AND STATUS='CLOSE' AND serviced_by=xx.csr
									),'-') AS average_time
								FROM
								(
									SELECT 
										serviced_by AS csr,
										COUNT(*) AS jml
									FROM t_antrian 
									WHERE CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)
									AND serviced_by LIKE @vCSR
									GROUP BY serviced_by
								)XX
								ORDER BY csr;
							");
		return $q;
	}

	public function lap_polling($tgl_awal,$tgl_akhir,$judul){
		$this->db->query("SET @vDateAwal=STR_TO_DATE('$tgl_awal','%d-%m-%Y');");
		$this->db->query("SET @vDateAkhir=STR_TO_DATE('$tgl_akhir','%d-%m-%Y');");
		$this->db->query("SET @vJudul=CONCAT('%','$judul','%')");
		$q = $this->db->query("SELECT 
								  judul,
								  CONCAT(CASE a.jawaban1 WHEN '' THEN '-' ELSE a.jawaban1 END,'(',(SELECT COUNT(*) FROM t_user_polling WHERE polling_id=a.polling_id AND user_comment LIKE a.jawaban1 AND CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)),')') OP1, 
								  CONCAT(CASE a.jawaban2 WHEN '' THEN '-' ELSE a.jawaban2 END,'(',(SELECT COUNT(*) FROM t_user_polling WHERE polling_id=a.polling_id AND user_comment LIKE a.jawaban2 AND CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)),')') OP2, 
								  CONCAT(CASE a.jawaban3 WHEN '' THEN '-' ELSE a.jawaban3 END,'(',(SELECT COUNT(*) FROM t_user_polling WHERE polling_id=a.polling_id AND user_comment LIKE a.jawaban3 AND CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)),')') OP3, 
								  CONCAT(CASE a.jawaban4 WHEN '' THEN '-' ELSE a.jawaban4 END,'(',(SELECT COUNT(*) FROM t_user_polling WHERE polling_id=a.polling_id AND user_comment LIKE a.jawaban4 AND CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)),')') OP4, 
								  CONCAT(CASE a.jawaban5 WHEN '' THEN '-' ELSE a.jawaban5 END,'(',(SELECT COUNT(*) FROM t_user_polling WHERE polling_id=a.polling_id AND user_comment LIKE a.jawaban5 AND CAST(trx_date AS DATE) BETWEEN CAST(@vDateAwal AS DATE) AND CAST(@vDateAkhir AS DATE)),')') OP5
								FROM m_polling a 
								WHERE judul LIKE @vJudul;
							");
		return $q;
	}
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */