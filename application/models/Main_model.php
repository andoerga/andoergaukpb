<?php

class main_model extends CI_Model {
	

	public function __construct(){
		parent::__construct();
		//$this->db = $this->db_more = $this->load->database('auth', TRUE);
	}
	
	public function check_login($username, $password){
		$this->db->select('id, username, nama, nip, tingkat_id, status_approval, tipe_peserta, tipe_registrasi_id, tingkat_name, tipe_registrasi_name, tipe_jabfung');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where_in('status_approval', array('approved', 'perbaikan'));
		$query = $this->db->get('v_peserta');
		$row = $query->row();
		return $row;
	}
	
	public function check_login_bypass($nip){
		$this->db->select('id, username, nama, nip, tingkat_id, status_approval, tipe_peserta, tipe_registrasi_id, tingkat_name, tipe_registrasi_name, tipe_jabfung');
		$this->db->where('nip', $nip);
		$this->db->where_in('status_approval', array('approved', 'perbaikan'));
		$query = $this->db->get('v_peserta');
		$row = $query->row();
		return $row;
	}
	
	public function get_ujian($id){
		$this->db->where('id_ujian', $id);
		$query = $this->db->get('ujian');
		return $query->row_array();
	}
	
	public function get_ujian_list($tingkat_id, $tipe_registrasi_id){
		/*
		if($tingkat_id == 12 || $tingkat_id == 13){
			$tingkat_id = 11;
		}
		if($tingkat_id == 22 || $tingkat_id == 23 || $tingkat_id == 24){
			$tingkat_id = 21;
		}
		*/
		$this->db->where('tingkat_id', $tingkat_id);
		$this->db->where('tipe_registrasi_id', $tipe_registrasi_id);
		$this->db->order_by('urutan ASC');
		$query = $this->db->get('ujian');
		return $query->result_array();
	}
	
	public function get_logs($id_user){
		$this->db->where('user_id', $id_user);
		$this->db->where('create_score', '0');
		$this->db->order_by('ujian_id ASC');
		$query = $this->db->get('ujian_log');
		return $query->result_array();
	}
	
	public function get_log($id){
		$this->db->where('id', $id);
		$query = $this->db->get('ujian_log');
		return $query->row_array();
	}
	
	public function get_log_done($id_user, $id_ujian){
		$this->db->where('user_id', $id_user);
		$this->db->where('ujian_id', $id_ujian);
		$this->db->where('create_score', '1');
		$query = $this->db->get('ujian_log');
		return $query->row_array();
	}
	
	public function create_log($user_id, $ujian_id, $soal, $pilihan, $jawaban, $time_left, $tipe_soal, $updated, $created){
		$data = array(
			'user_id' => $user_id,
			'ujian_id' => $ujian_id,
			'soal' => $soal,
			'pilihan' => $pilihan,
			'jawaban' => $jawaban,
			'time_left' => $time_left,
			'tipe_soal' => $tipe_soal,
			'updated' => $updated,
			'created' => $created
		);
		$this->db->insert('ujian_log', $data);
		return $this->db->insert_id();
	}
	
	public function update_log($log_id, $time_left, $jawaban, $current_pos)
	{
		$data = array(
			'time_left' => $time_left,
			'jawaban' => $jawaban,
			'current_pos' => $current_pos,
			'updated' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $log_id);
		$this->db->update('ujian_log', $data);
	}
	
	public function get_soal($id_ujian, $tipe_soal){
		$this->db->where('ujian_id', $id_ujian);
		$this->db->where('tipe_soal', $tipe_soal);
		$query = $this->db->get('soal');
		return $query->result_array();
	}
	
	public function get_soal_by_kompetensi($kompetensi_id, $tipe_soal){
		$this->db->where('kompetensi_id', $kompetensi_id);
		$this->db->where('tipe_soal', $tipe_soal);
		$query = $this->db->get('soal');
		return $query->result_array();
	}
	
	public function get_kompetensi($tingkat_id){
		$this->db->where('tingkat_id', $tingkat_id);
		$this->db->order_by('urutan ASC');
		$query = $this->db->get('kompetensi');
		return $query->result_array();
	}
	
}