<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_tipe_registrasi_name'))
{
	function get_tipe_registrasi_name()
	{
		$CI =& get_instance();
		return $CI->session->userdata('tipe_registrasi_name');
	}
}

if ( ! function_exists('get_tingkat_name'))
{
	function get_tingkat_name()
	{
		$CI =& get_instance();
		return $CI->session->userdata('tingkat_name');
	}
}