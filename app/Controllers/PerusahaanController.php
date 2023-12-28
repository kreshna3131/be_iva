<?php

namespace App\Controllers;

use App\Models\PerusahaanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class PerusahaanController extends ResourceController
{
    use ResponseTrait;

    public function perusahaan()
    {
        $perusahaanModel = new PerusahaanModel();
        $data = $perusahaanModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 200, // OK
                'message' => 'Data retrieved successfully',
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 404, // Not Found
                'message' => 'No data found',
                'data' => [],
            ];
        }

        return $this->respond($response, $response['status']);
    }

    public function create_perusahaan()
    {
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $url = $this->request->getVar('url'); // Tambahkan ini untuk mendapatkan URL

        // Validate input data
        if (empty($username) || empty($email) || empty($password) || empty($url)) {
            $response = [
                'status' => 400,
                'message' => 'Bad Request - Missing required data',
            ];
        } else {
            // Check if the user already exists
            $perusahaanModel = new PerusahaanModel();
            $existingUser = $perusahaanModel->where('email', $email)->first();

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
                    'url' => $url, // Tambahkan ini untuk menyimpan URL
                ];
                $perusahaanModel->save($data);

                $response = [
                    'status' => 201,
                    'message' => 'Created - Data berhasil ditambahkan',
                    'data' => $data,
                ];
            }
        }

        return $this->respond($response);
    }

    public function login_perusahaan()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $perusahaanModel = new PerusahaanModel();
        $existingUser = $perusahaanModel->where('email', $email)->first();

        if ($existingUser) {
            if ($password != $existingUser->password) {
                $response = [
                    'code' => 402,
                    'status' => 'failed',
                    'messages' => 'Login Failed, password wrong',
                ];
            } else {
                $response = [
                    'code' => 200,
                    'status' => 'success',
                    'messages' => 'Login successfully',
                    'data' => $existingUser,
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

    public function update_perusahaan($id = null)
    {
        $perusahaanModel = new PerusahaanModel();
        $registrasi = $perusahaanModel->find($id);
        if ($registrasi) {
            $data = [
                'id' => $id,
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'url' => $this->request->getVar('url'),
            ];
            $proses = $perusahaanModel->save($data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data,
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

    public function delete_perusahaan($id = null)
    {
        $perusahaanModel = new PerusahaanModel();
        $perusahaan = $perusahaanModel->find($id);

        if ($perusahaan) {
            $perusahaanModel->delete($id);
            $response = [
                'status' => 200,
                'message' => 'Data berhasil dihapus',
            ];
            return $this->respond($response);
        }

        return $this->failNotFound('Data tidak ditemukan');
    }
}
