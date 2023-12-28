<?php

namespace App\Controllers;

use App\Models\LowkerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Files\UploadedFile;

class LowkerController extends BaseController
{
    use ResponseTrait;

    public function lowker()
    {
        $lowkerModel = new LowkerModel();
        $data = $lowkerModel->findAll();

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

    public function create_lowker()
    {
        $lowkerModel = new LowkerModel();
        $data = $this->request->getPost();

        $validationRules = [
            'logo' => 'uploaded[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,10240]',
            // Add other validation rules for other fields
        ];

        if (!$this->validate($validationRules)) {
            return $this->respond(['status' => 400, 'error' => $this->validator->getErrors()]);
        }

        // Handle file upload for logo
        $logo = $this->request->getFile('logo');
        $logoName = $logo->getRandomName();
        $logo->move(WRITEPATH . 'uploads', $logoName);

        // Set the logo field in the $data array to the uploaded file name
        $data['logo'] = $logoName;

        // Save data to the database
        $lowkerModel->save($data);

        return $this->respondCreated(['status' => 201, 'message' => 'Data created successfully', 'data' => $data]);
    }

    public function update_lowker($id = null)
    {
        $lowkerModel = new LowkerModel();
        $data = $this->request->getRawInput();

        $validationRules = [
            'logo' => 'mime_in[logo,image/jpg,image/jpeg,image/png]|max_size[logo,10240]',
            // Add other validation rules for other fields
        ];

        if (!$this->validate($validationRules)) {
            return $this->respond(['status' => 400, 'error' => $this->validator->getErrors()]);
        }

        // Handle file upload for logo
        $logo = $this->request->getFile('logo');
        if ($logo->isValid()) {
            $logoName = $logo->getRandomName();
            $logo->move(WRITEPATH . 'uploads', $logoName);
            // Set the logo field in the $data array to the uploaded file name
            $data['logo'] = $logoName;
        }

        // Update data in the database
        $lowkerModel->update($id, $data);

        return $this->respond(['status' => 200, 'message' => 'Data updated successfully', 'data' => $data]);
    }

    public function delete_lowker($id = null)
    {
        $lowkerModel = new LowkerModel();
        $lowker = $lowkerModel->find($id);

        if ($lowker) {
            // Delete logo file from the uploads directory
            if ($lowker['logo']) {
                $logoPath = WRITEPATH . 'uploads/' . $lowker['logo'];
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            // Delete data from the database
            $lowkerModel->delete($id);

            return $this->respond(['status' => 200, 'message' => 'Data deleted successfully']);
        }

        return $this->respond(['status' => 404, 'message' => 'Data not found']);
    }
}
