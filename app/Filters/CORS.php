<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CORS implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
    {
        // Mendapatkan instance dari response
        $response = service('response');

        // Set header CORS
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        // Periksa apakah ini adalah preflight request (OPTIONS)
        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(200);
            $response->setHeader('Content-Length', '0');
            $response->setBody('');
            $response->send();
            exit();
        }
    }
  // public function before(RequestInterface $request, $arguments = null)
  //   {
  //     header("Content-Type: application/json; charset=UTF-8");
  //     header("Access-Control-Allow-Origin: *");
  //     header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Authorization");
  //     header("Access-Control-Allow-Methods: GET, POST, OPTIONS,  MATCH, PATCH, PUT, DELETE");
  //     header("Access-Control-Allow-Credentials: true");
  //     header('Access-Control-Max-Age: 86400');

  //     $method = $_SERVER['REQUEST_METHOD'];
  //     if ($method == "OPTIONS") {
  //     header('Access-Control-Allow-Origin: *');
  //     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, MATCH,  PATCH, PUT, DELETE");
  //     header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Authorization");
  //     header('Access-Control-Max-Age: 86400');
  //     header('Content-Length: 0');
  //     header('Content-Type: application/json; charset=UTF-8');
  //     exit();
  //     }
  //   } 

 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
      // Do something here
    }
}
