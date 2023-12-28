<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Api\ResponseTrait;

class AdminController extends ResourceController
{
    use ResponseTrait;
    public function admin()
    {
        $adminModel = new AdminModel();
        $data = $adminModel->findAll();

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


    public function create_admin()
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
            $adminModel = new AdminModel();
            $existingUser = $adminModel->where('email', $email)->first();

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
                $adminModel->save($data);

                $response = [
                    'status' => 201,
                    'message' => 'Created - Data berhasil ditambahkan',
                    'data' => $data,
                ];
            }
        }

        return $this->respond($response);
    }


    public function login_admin()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

            $adminModel = new AdminModel();
            $existingUser = $adminModel->where('email', $email)->first();

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
                'data' => $existingUser
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


    public function update_admin($id = null)
    {
        $adminModel = new AdminModel();
        $registrasi = $adminModel->find($id);
        if ($registrasi) {
            $data = [
                'id' => $id,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
            $proses = $adminModel->save($data);
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


    public function delete_admin($id = null)
    {
        $adminModel = new AdminModel();
        $admin = $adminModel->find($id);

        if ($admin) {
            $adminModel->delete($id);
            $response = [
                'status' => 200,
                'message' => 'Data berhasil dihapus',
            ];
            return $this->respond($response);
        }

        return $this->failNotFound('Data tidak ditemukan');
    }
}