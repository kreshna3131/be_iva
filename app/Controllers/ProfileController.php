<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ProfileController extends ResourceController
{
    use ResponseTrait;

    public function profile()
    {
        $profileModel = new ProfileModel();
        $profile = $profileModel->first(); // Ambil data profil pertama (jika ada)

        if ($profile) {
            $response = [
                'status' => 200,
                'message' => 'Profile data retrieved successfully',
                'data' => $profile,
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => 'Profile data not found',
                'data' => null,
            ];
        }

        return $this->respond($response, $response['status']);
    }

    public function create_profile()
    {
        // Ambil data dari form atau inputan
        $data = [
            'username' => $this->request->getVar('username'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'org_name' => $this->request->getVar('org_name'),
            'location' => $this->request->getVar('location'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'birthday' => $this->request->getVar('birthday'),
        ];

        $profileModel = new ProfileModel();
        $profileModel->insert($data);

        $response = [
            'status' => 201,
            'message' => 'Profile data created successfully',
            'data' => $data,
        ];

        return $this->respondCreated($response);
    }

    public function edit_profile()
    {
        // Ambil data dari form atau inputan
        $data = [
            'username' => $this->request->getVar('username'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'org_name' => $this->request->getVar('org_name'),
            'location' => $this->request->getVar('location'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'birthday' => $this->request->getVar('birthday'),
        ];

        $profileModel = new ProfileModel();
        $profileModel->update(1, $data); // Mengupdate profil pertama, sesuaikan dengan kebutuhan Anda

        $response = [
            'status' => 200,
            'message' => 'Profile data updated successfully',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function delete_profile()
    {
        $profileModel = new ProfileModel();
        $profileModel->delete(1); // Menghapus profil pertama, sesuaikan dengan kebutuhan Anda

        $response = [
            'status' => 200,
            'message' => 'Profile data deleted successfully',
        ];

        return $this->respondDeleted($response);
    }
}
