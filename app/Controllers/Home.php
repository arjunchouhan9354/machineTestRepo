<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public $session;
	public function __construct()
	{
		$session = \Config\Services::session();
		$this->session = session();
	}
	public function index()
	{
		return view('index');
	}
	public function loginPage()
	{
		return view('login');
	}
	public function register()
	{
		return view('register');
	}
	public function profile()
	{
		$session = session()->get('userData');
        $userId = $session['data']['user_id'];

    	$url = base_url('api/get/user/profile');
		$method = "POST";
		$auth = $session['data']['token_code'];
		$data = ["user_id" => $userId];

		$response = curlCall($url, $method, $data, $auth);
		$response_Data = json_decode($response, true);	
		if ($response_Data['status'] == 200) 
		{
			return view("profile",$response_Data);
		} else {
			$url = base_url('api/inser/user/profile');
			$method = "POST";
			$auth = $session['data']['token_code'];
			$data = ["user_id" => $userId];

			$response = curlCall($url, $method, $data, $auth);
			$response_Data = json_decode($response, true);	
			return view("profile",$response_Data);
		}
	}
	public function UserLogin()
	{
		$submit = $this->request->getVar('submit');
		if (isset($submit)) {
			$data = $this->request->getVar();
			// print_r($data);die();
			$url = base_url('api/login');

			$method = "POST";
			$auth = '';
			$response = curlCall($url, $method, $data, $auth);
			$response_Data = json_decode($response, true);
			if ($response_Data['status'] == 200) 
			{
				$this->session->set('userData', $response_Data);
				return redirect()->to(base_url('user/dashboard'));
			} else {
				return view('login', $response_Data);
			}
		} else {
			return view('login');
		}
	}
	public function UserRegistration()
	{

		$data = $this->request->getVar();
		$url = base_url('api/register');
		$method = "POST";
		$auth = '';
		$response = curlCall($url, $method, $data, $auth);
		$response_Data = json_decode($response,true);
		// print_r($response_Data);
		return $response;

	}
	/*----------------|Admin/Trainer Api curl call|----------------*/
	public function adminLogin(){
		return view('admin/login');
	}
	public function adminDashboard(){
		return view('admin/index');
	}
	public function usersListDetails()
	{
		$session = session()->get('adminData');
		$url = base_url('api/getAllUsersListDetails');
		$method = "GET";
		$auth = $session['data']['token_code'];
		$data = "";
		$response = curlCall($url, $method, $data, $auth);
		$response_Data = json_decode($response, true);
		return view('admin/userList',$response_Data);
	}
	public function jobListMapping()
	{
		$session = session()->get('adminData');
		$url = base_url('api/getAllJobListMapping');
		$method = "GET";
		$auth = $session['data']['token_code'];
		$data = "";
		$response = curlCall($url, $method, $data, $auth);
		$response_Data = json_decode($response, true);
		return view('admin/jobListMapping',$response_Data);
	}
	
	public function AuthLogin()
	{
		$submit = $this->request->getVar('submit');
		if (isset($submit)) {
			$data = $this->request->getVar();
			$url = base_url('api/login/auth');

			$method = "POST";
			$auth = '';
			$response = curlCall($url, $method, $data, $auth);
			$response_Data = json_decode($response, true);
			if ($response_Data["status"] == 200) {
					$this->session->set("adminData", $response_Data);
					return redirect()->to(base_url('admin/dashboard'));
				}else {
				return view('admin/login', ['data' => $response_Data]);
			}
		} else {
			return view('admin/login');
		}
	}
	/*-------------function for logout and unset sessions-----------*/
	function logout()
	{
		$array_items = ['userData'];
		$this->session->remove($array_items);
		return redirect()->to(base_url('login'));
	}
		function adminLogout()
	{
		$array_items = ['adminData'];
		$this->session->remove($array_items);
		return redirect()->to(base_url('admin/login'));
	}
}
