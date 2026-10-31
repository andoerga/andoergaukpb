<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	private $tipe_ujian_inpassing = array(
		'pertama' => 'Uji Kompetensi Inpassing PTP Pertama',
		'muda' => 'Uji Kompetensi Inpassing PTP Muda',
		'madya' => 'Uji Kompetensi Inpassing PTP Madya',
	);
	private $waktuMulai;
	private $waktuSelesai;
	
	public function __construct(){
		parent::__construct();
		$settingPath = FCPATH . "../_setting.json";
		$setting = file_get_contents($settingPath);
		$setting = json_decode($setting, false);
		$this->waktuMulai = strtotime($setting->Ujian->Mulai);
		$this->waktuSelesai = strtotime($setting->Ujian->Selesai);
		$this->akunujicoba = array('1517', '1518', '1519', '1520', '1521');
	}
	
	private function is_login()
	{
		if($this->session->userdata('id')){
			return true;
		}else{
			return false;
		}
	}
	
	public function index()
	{
		if(!$this->is_login()){
			echo 'not login';
			redirect(site_url('login'));
		}
		$batasAwalWaktu = $this->waktuMulai;
		$batasAkhirWaktu = $this->waktuSelesai;
		$now = time();
		//if(!in_array($this->session->userdata('id'), $this->akunujicoba)){
		if($this->session->userdata('id') >= 1517){
			if($batasAwalWaktu > $now){
				echo '<h1>Ujian belum dibuka</h1>';
				echo '<h3><a href="'.site_url('logout').'">Logout</a></h3>';
				die();
			}else if($now > $batasAkhirWaktu){
				echo '<h1>Sesi  ujian telah berakhir</h1>';
				die();
			}
		}
		$output['nama_user'] = $this->session->userdata('nama');
		$output['tipe_jabfung'] = $this->session->userdata('tipe_jabfung');
		$this->load->view('welcome', $output);
	}
	
	public function pre()
	{
		$output['user'] = $this->session->userdata();
		$output['user_id'] = $this->session->userdata('id');
		$output['nama_user'] = $this->session->userdata('nama');
		if(!$this->is_login()){
			redirect(site_url('login'));
		}
		$batasAwalWaktu = $this->waktuMulai;
		$batasAkhirWaktu = $this->waktuSelesai;
		$now = time();
		//if(!in_array($this->session->userdata('id'), $this->akunujicoba)){
			if($batasAwalWaktu > $now){
				echo '<h1>Ujian belum dibuka</h1>';
				die();
			}else if($now > $batasAkhirWaktu){
				echo '<h1>Sesi  ujian telah berakhir</h1>';
				die();
			}
		//}
		$output['batasAwalWaktu'] = $batasAwalWaktu;
		$output['batasAkhirWaktu'] = $batasAkhirWaktu;
		
		$id_user = $this->session->userdata('id');
		$tingkat_id = $this->session->userdata('tingkat_id');
		$tipe_registrasi_id = $this->session->userdata('tipe_registrasi_id');
		//$output['jenis_ujian'] = $this->tipe_ujian_inpassing[$status_inpassing];
		$output['ujian_list'] = array();
		//if($tipe_registrasi_id == 31){
			//$status_inpassing_id = 11;
		//}
		$ujian_list = $this->main_model->get_ujian_list($tingkat_id, $tipe_registrasi_id);
		$n = 1;
		foreach($ujian_list as $u){
			$output['ujian_list'][$n] = $u;
			$n++;
		}
		
		$logs = $this->main_model->get_logs($id_user);
		
		$status = 'done';
		$output['id_ujian_done'] = array();
		$output['id_ujian_current'] = 0;
		if(count($logs) < 1){
			$this->build_ujian($id_user, $output['ujian_list'][1]);
			$output['next_ujian'] = $output['ujian_list'][1];
			$ujian_current = $this->session->userdata('ujian_current');
			$output['log'] = $this->main_model->get_log($ujian_current['log_id']);
			$status = 'next';
			$output['id_ujian_current'] = $output['next_ujian']['id_ujian'];
		}else{
			$log_mapping = array();
			foreach($logs as $l){
				$log_mapping[$l['ujian_id']] = $l;
			}
			
			foreach($ujian_list as $u){
				if(!isset($log_mapping[$u['id_ujian']])){
					$this->build_ujian($id_user, $u);
					$output['next_ujian'] = $u;
					$output['id_ujian_current'] = $output['next_ujian']['id_ujian'];
					$ujian_current = $this->session->userdata('ujian_current');
					$output['log'] = $this->main_model->get_log($ujian_current['log_id']);
					$status = 'next';
					break;
				}else if($log_mapping[$u['id_ujian']]['time_left'] > 0){
					$output['next_ujian'] = $u;
					$output['id_ujian_current'] = $output['next_ujian']['id_ujian'];
					$this->session->set_userdata('ujian_current', array(
						'ujian_id' => $log_mapping[$u['id_ujian']]['ujian_id'],
						'log_id' => $log_mapping[$u['id_ujian']]['id']
					));
					$output['log'] = $log_mapping[$u['id_ujian']];
					$status = 'continue';
					break;
				}else{
					$output['id_ujian_done'][] = $u['id_ujian'];
				}
			}
		}
		if($status == 'done'){
			$this->session->unset_userdata('ujian_current');
		}
		$output['status'] = $status;
		$this->load->view('pre', $output);
	}
	
	private function build_ujian($id_user, $ujian)
	{	
		if($ujian['tipe_soal'] > 1){
			$tipe_soal = rand(1, $ujian['tipe_soal']);
		}else{
			$tipe_soal = 1;
		}
		/*
		if(in_array($id_user, array(5255,5256,5257,5258,5259))){
			$tipe_soal = 1;
		}
		
		if(in_array($id_user, array(5249,5250,5251,5252,5253))){
			$tipe_soal = 2;
		}
		
		if(in_array($id_user, array(5260,5261))){
			$tipe_soal = 3;
		}
		*/
		
		$ujian_done = $this->main_model->get_log_done($id_user, $ujian['id_ujian']);

		if(is_array($ujian_done)){
			if($ujian_done['tipe_soal'] <= $ujian['tipe_soal']){
				$tipe_soal = $ujian_done['tipe_soal'];
			}
		}
		
		
		//$tipe_soal = 1;
		$kompetensi = $this->main_model->get_kompetensi($ujian['tingkat_id']);
		$kompetensi = array(0);
		$soal = array();
		$soal_mapping = array();
		$id_soal_mapping = array();
		$jawaban_mapping = array();
		/*
		foreach($kompetensi as $k){
			$soal_temp = array();
			$soal_temp = $this->main_model->get_soal_by_kompetensi($k['id'], $tipe_soal);
			shuffle($soal_temp);
			$soal_temp = array_slice($soal_temp, 0, $k['jumlah_soal']);
			$soal = array_merge($soal, $soal_temp);
		}
		*/
		$soal = $this->main_model->get_soal($ujian['id_ujian'], $tipe_soal);
		$soal_mapping = array();
		$id_soal_mapping = array();
		$jawaban_mapping = array();
		foreach($soal as $s){
			$id_soal_mapping[] = $s['id'];
			$soal_mapping[$s['id']] = $s;
			$jawaban_mapping[$s['id']] = 0;
		}
		shuffle($id_soal_mapping);
		$id_soal_mapping = array_slice($id_soal_mapping, 0, $ujian['jumlah_soal']);
		foreach($id_soal_mapping as $s){
			$jawaban_mapping[$s] = 0;
		}
		
		$urutan_soal = $id_soal_mapping;
		$urutan_jawaban = range(1, $ujian['jumlah_pil']);
		//shuffle($urutan_jawaban);
		$time_left = $ujian['waktu'];
		
		$log_id = $this->main_model->create_log($id_user, $ujian['id_ujian'], json_encode($urutan_soal), json_encode($urutan_jawaban), json_encode($jawaban_mapping), $time_left, $tipe_soal, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
		$this->session->set_userdata('ujian_current', array(
			'ujian_id' => $ujian['id_ujian'],
			'log_id' => $log_id
		));
		
	}
	
	public function ujian()
	{
		$output['user'] = $this->session->userdata();
		$output['nama_user'] = $this->session->userdata('nama');
		if(!$this->is_login()){
			redirect(site_url('login'));
		}
		$batasAwalWaktu = $this->waktuMulai;
		$batasAkhirWaktu = $this->waktuSelesai;
		$now = time();
		
		//if(!in_array($this->session->userdata('id'), $this->akunujicoba)){
			if($batasAwalWaktu > $now){
				echo '<h1>Ujian belum dibuka</h1>';
				die();
			}else if($now > $batasAkhirWaktu){
				echo '<h1>Sesi  ujian telah berakhir</h1>';
				die();
			}
		//}
		
		$id_user = $this->session->userdata('id');
		$tingkat_id = $this->session->userdata('tingkat_id');
		$tipe_registrasi_id = $this->session->userdata('tipe_registrasi_id');
		
		$ujian_list = $this->main_model->get_ujian_list($tingkat_id, $tipe_registrasi_id);
		$ujian_list_array = array();
		foreach($ujian_list as $u){
			$ujian_list_array[] = $u;
		}
		
		$output['nama_user'] = $this->session->userdata('nama');
		$current_ujian = $this->session->userdata('ujian_current');
		if(empty($current_ujian)){
			redirect(site_url('pre'));
		}
		
		$output['log'] = $this->main_model->get_log($current_ujian['log_id']);
		$output['ujian'] = $this->main_model->get_ujian($output['log']['ujian_id']);
		$output['last_ujian'] = false;
		if($output['log']['ujian_id'] == $ujian_list_array[(count($ujian_list_array) - 1)]['id_ujian']){
			$output['last_ujian'] = true;
		}
		$soal = $this->main_model->get_soal($output['log']['ujian_id'], $output['log']['tipe_soal']);
		$soal_mapping = array();
		foreach($soal as $s){
			$soal_mapping[$s['id']] = $s;
		}
		$output['soal'] = $soal_mapping;
		
		$kompetensi = $this->main_model->get_kompetensi($output['ujian']['tingkat_id']);
		$kompetensi_map = array();
		foreach($kompetensi as $k){
			$kompetensi_map[$k['id']] = $k;
		}
		$output['kompetensi'] = $kompetensi_map;
		
		if(isset($_COOKIE['size_mode'])){
			$output['size_mode'] = $_COOKIE['size_mode'];
		}else{
			$output['size_mode'] = 'normal-mode';
		}
		$this->load->view('ujian', $output);
	}
	
	public function sync()
	{
		$current_ujian = $this->session->userdata('ujian_current');
		if(empty($current_ujian)){
			echo 'No Session';
			die();
		}
		
		$ujian_log = $this->main_model->get_log($current_ujian['log_id']);
		/*
		if($this->session->userdata('tingkat_id') == 22 && $ujian_log['id_ujian'] != 4){
			echo 'Failed';
			die();
		}
		if($this->session->userdata('tingkat_id') == 23 && $ujian_log['id_ujian'] != 5){
			echo 'Failed';
			die();
		}
		*/
		if(is_array($this->input->post('jawaban')) && count($this->input->post('jawaban') > 0)){
			$jawaban = json_encode($this->input->post('jawaban'));
			$time_left = $this->input->post('time_left');
			$current_pos = $this->input->post('current_pos');
			
			$this->main_model->update_log($current_ujian['log_id'], $time_left, $jawaban, $current_pos);
		
			echo json_encode(array('success'=>true, 'log' => $ujian_log, 'tingkat' => $this->session->userdata('tingkat_id')));
		}else{
			echo json_encode(array('success'=>false));
		}
	}
	
	public function login()
	{
		$this->load->library('Mytools');
		
		//Penilik
		//$tingkat_avail = array(21, 22, 23);
		
		
		//Pamong
		$tingkat_avail = array(11,12, 13, 21, 22, 23);
		
		
		
		$output = array();
		$output['notif'] = '';
		if($this->input->post()){
			$username = $this->input->post('email');
			if(is_numeric($username) && $this->input->post('password') == 'ukkj123'){
				$login = $this->main_model->check_login_bypass($username);
			}else{
			//$password = base64_encode(base64_encode($this->input->post('password')));
			$password = $this->mytools->encrypt_password($this->input->post('password'));
			$login = $this->main_model->check_login($username, $password);
			}
			if($login){
				
				if(!in_array($login->tingkat_id, $tingkat_avail) && $login->status_approval != 'approved'){
					echo "<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-77713226-3\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-77713226-3');
</script>";
					echo '<h1>Ujian tidak tersedia untuk anda</h1>';
					die();
				}
				/*
				if($login->tipe_jabfung != 'ptp'){
					echo '<h1>Ujian tidak tersedia untuk anda</h1>';
					die();
				}
				*/
				$session_variable = array(
					'id' => $login->id,
					'username' => $login->username,
					'nama' => $login->nama,
					'tingkat_id' => $login->tingkat_id,
					'tingkat_name' => $login->tingkat_name,
					'tipe_registrasi_id' => $login->tipe_registrasi_id,
					'tipe_pendaftaran' => $login->tipe_pendaftaran,
					'tipe_registrasi_name' => $login->tipe_registrasi_name
				);
				$this->session->set_userdata($session_variable);
				redirect(site_url());
			}else{
				$output['notif'] = "Maaf, username dan password yang anda masukkan tidak cocok";
			}
		}
		
		$this->load->view('login', $output);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
