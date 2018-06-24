<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'helpers/HttpRequest.php');

class Welcome extends CI_Controller {

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
    public function __construct()
     {
        // Ensure you run parent constructor
        parent::__construct();
        $this->load->library('user_agent');
     }

	public function index()
	{
		$this->load->view('landing');
	}

	public function shorten () {
		$item = json_decode(file_get_contents('php://input'),true);
		$url = 'http://localhost:8000/api/v1/short';
		$data = "longurl=".$item['longurl']."&customurl=".$item['customurl']."&password=".$item['password']."&expiration=".$item['expiration']."";
		$method = 'POST';
		$result = $this->cURL($url, $data, $method, $this->config->item('apikey'));
		echo $result;
	}

	public function getLink($params="") {
		if (!empty($params)) {
			$url = 'http://localhost:8000/api/v1/retrieve/'.$params;
			$data = "";
			$method = 'GET';
			$result = $this->cURL($url, $data, $method, $this->config->item('apikey'));
			$decode = json_decode($result, true);
			if ($decode['success']) {
				if ($decode['data']['password']) {
					$array['short_url'] = $decode['data']['short_url'];
					$array['encoded_short'] = json_encode($decode['data']['short_url'], true);
					return $this->load->view('password_link', $array);	
				}
				$array = array(
					'redirected' => $decode['data']['long_url']
				);
				$this->load->view('link_success', $array);
				// var_dump($decode['data']['short_url']);
			} else {
				if ($decode['data']['expired']) {
					return $this->load->view('expired_link');
				}
				$this->load->view('not_found');
			}
		}
	}

	public function checkCustom($params) {
		$url = 'http://localhost:8000/api/v1/check/'.$params;
		$data = "";
		$method = 'GET';
		echo $this->cURL($url, $data, $method, $this->config->item('apikey'));
	}

	public function password($params){
		$item = json_decode(file_get_contents('php://input'),true);
		$url = 'http://localhost:8000/api/v1/retrieve/'.$params;
		$data = "password=".$item['password'];
		$method = 'POST';
		$result = $this->cURL($url, $data, $method, $this->config->item('apikey'));
		echo $result;
		$decode = json_decode($result, true);
		// var_dump($decode);
	}

	public function cURL($url, $dataArray, $method, $api) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $dataArray, //"longurl=http%3A%2F%2Flocalhost%3A8081%2Fphpmyadmin%2Fsql.php%3Fserver%3D1%26db%3Dkusiaga%26table%3Ddb_user%26pos%3D0%26token%3Deebd2deb2ff4032ab73ad5404328dacf&customurl=&password=&expiration="
		  CURLOPT_HTTPHEADER => array(
		    "accept: application/json",
		    "authorization: Bearer ".$api,
		    "content-type: application/x-www-form-urlencoded",
		    "User-Agent: ".$_SERVER['HTTP_USER_AGENT']
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  return "cURL Error #:" . $err;
		} else {
		  return $response;
		}
	}
}
