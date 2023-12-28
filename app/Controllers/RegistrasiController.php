<?php

namespace App\Controllers;

use App\Models\RegistrasiModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Api\ResponseTrait;

class RegistrasiController extends ResourceController
{
    use ResponseTrait;
    public function registrasi()
    {
        $registrasiModel = new RegistrasiModel();
        $data = $registrasiModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 200, // OK
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 404, // Not Found
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response, $response['status']);
    }

    public function create()
    {
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Validate input data
        if (empty($username) || empty($email) || empty($password)) {
            $response = [
                'status' => 400,
                'message' => 'Bad Request - Missing required data',
            ];
        } else {
            // Check if the user already exists
            $registrasiModel = new RegistrasiModel();
            $existingUser = $registrasiModel->where('email', $email)->first();

            if ($existingUser) {
                $response = [
                    'status' => 409,
                    'message' => 'Conflict - User with this email already exists',
                ];
            } else {
                // Save the new user
                $data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                ];
                $registrasiModel->save($data);

                $response = [
                    'status' => 201,
                    'message' => 'Created - Data berhasil ditambahkan',
                    'data' => $data,
                ];
            }
        }

        return $this->respond($response);
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

            $registrasiModel = new RegistrasiModel();
            $existingUser = $registrasiModel->where('email', $email)->first();

            if ($existingUser) {
                if ( $password != $existingUser->password) {
            // return $this->failUnauthorized('Login Failed, Invalid email or password');
            $response = [
                'code' => 402,
                'status'=> 'failed',
                'messages' => 'Login Failed, password wrong',
            ];
                }else{
                    $response = [
                'code' => 200,
                'status'=> 'success',
                'messages' => 'Login successfully',
                'data' => $existingUser,
				// 'redirect_url' => 'http://localhost:3000/landing'
            ];

                }
            } else {
                $response = [
                    'status' => 401,
                    'message' => 'Akun belum didaftarkan',
                ];
            }
        

        return $this->respond($response);
    }
        
    // function untuk mengedit data
    public function update($id = null)
    {
        $registrasiModel = new RegistrasiModel();
        $registrasi = $registrasiModel->find($id);
        if ($registrasi) {
            $data = [
                'id' => $id,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $proses = $registrasiModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data
                ];
            } else {
                $response = [
                    'status' => 402,
                    'messages' => 'Gagal diubah',
                ];
            }
            return $this->respond($response);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }
	
    public function delete($id = null)
    {
        $registrasiModel = new RegistrasiModel();
        $registrasi = $registrasiModel->find($id);

        if ($registrasi) {
            $registrasiModel->delete($id);
            $response = [
                'status' => 200,
                'message' => 'Data berhasil dihapus',
            ];
            return $this->respond($response);
        }

        return $this->failNotFound('Data tidak ditemukan');
    }
}
// UserController.php

    //public function getUserById($id)
    //{
       // $this->load->model('User_model');
       // $userData = $this->User_model->getUserById($id);

        // Kembalikan data pengguna sebagai JSON
       // $this->output
       //     ->set_content_type('application/json')
        //    ->set_output(json_encode($userData));
    //}
