<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
		if (session()->get('adminData')) {
			return redirect()->to(base_url('admin/dashboard'));
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
