<?php

namespace App\Controllers;

use App\Models\LamaranModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class LamaranController extends ResourceController
{
    use ResponseTrait;
	
	// public function __construct()
    // {
    //     $this->middleware('cors'); // Terapkan filter CORS pada konstruktor controller
    // }

    public function lamaran()
    {
        $lamaranModel = new LamaranModel();
        $data = $lamaranModel->findAll();

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
    public function create_lamaran()
    {
        // Validate file upload
        $validationRules = [
            'surat_lamaran' => 'uploaded[surat_lamaran]|mime_in[surat_lamaran,application/pdf]|max_size[surat_lamaran,10240]',
            'cv' => 'uploaded[cv]|mime_in[cv,application/pdf]|max_size[cv,10240]',
            'ijasah' => 'uploaded[ijasah]|mime_in[ijasah,application/pdf]|max_size[ijasah,10240]',
            'berkas_tambahan' => 'uploaded[berkas_tambahan]|mime_in[berkas_tambahan,application/pdf]|max_size[berkas_tambahan,10240]',
        ];

        if (!$this->validate($validationRules)) {
            $response = [
                'status' => 400,
                'error' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 400);
        }

        // Handle file uploads
        $suratLamaran = $this->request->getFile('surat_lamaran');
        $cv = $this->request->getFile('cv');
        $ijasah = $this->request->getFile('ijasah');
        $berkasTambahan = $this->request->getFile('berkas_tambahan');

        // Move uploaded files to the writable/uploads directory
        $suratLamaran->move(WRITEPATH . 'uploads', $suratLamaran->getName());
        $cv->move(WRITEPATH . 'uploads', $cv->getName());
        $ijasah->move(WRITEPATH . 'uploads', $ijasah->getName());
        $berkasTambahan->move(WRITEPATH . 'uploads', $berkasTambahan->getName());

        // Save data to the database
        $lamaranModel = new LamaranModel();
        $data = [
            'surat_lamaran' => $suratLamaran->getName(),
            'cv' => $cv->getName(),
            'ijasah' => $ijasah->getName(),
            'berkas_tambahan' => $berkasTambahan->getName(),
        ];

        $lamaranModel->insert($data);

        $response = [
            'status' => 201,
            'message' => 'Data created successfully',
            'data' => $data,
        ];

        return $this->respondCreated($response);
    }

    public function update_lamaran($id = null)
    {
        // Validate file upload
        $validationRules = [
            'surat_lamaran' => 'mime_in[surat_lamaran,application/pdf]|max_size[surat_lamaran,10240]',
            'cv' => 'mime_in[cv,application/pdf]|max_size[cv,10240]',
            'ijasah' => 'mime_in[ijasah,application/pdf]|max_size[ijasah,10240]',
            'berkas_tambahan' => 'mime_in[berkas_tambahan,application/pdf]|max_size[berkas_tambahan,10240]',
        ];

        if (!$this->validate($validationRules)) {
            $response = [
                'status' => 400,
                'error' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 400);
        }

        // Handle file uploads if new files are provided
        $suratLamaran = $this->request->getFile('surat_lamaran');
        $cv = $this->request->getFile('cv');
        $ijasah = $this->request->getFile('ijasah');
        $berkasTambahan = $this->request->getFile('berkas_tambahan');

        if ($suratLamaran->isValid()) {
            $suratLamaran->move(WRITEPATH . 'uploads', $suratLamaran->getName());
        }
        if ($cv->isValid()) {
            $cv->move(WRITEPATH . 'uploads', $cv->getName());
        }
        if ($ijasah->isValid()) {
            $ijasah->move(WRITEPATH . 'uploads', $ijasah->getName());
        }
        if ($berkasTambahan->isValid()) {
            $berkasTambahan->move(WRITEPATH . 'uploads', $berkasTambahan->getName());
        }

        // Update data in the database
        $lamaranModel = new LamaranModel();
        $data = [
            'surat_lamaran' => $suratLamaran->getName(),
            'cv' => $cv->getName(),
            'ijasah' => $ijasah->getName(),
            'berkas_tambahan' => $berkasTambahan->getName(),
        ];

        $lamaranModel->update($id, $data);

        $response = [
            'status' => 200,
            'message' => 'Data updated successfully',
            'data' => $data,
        ];

        return $this->respond($response);
    }

    public function delete_lamaran($id = null)
    {
        // Delete files from the writable/uploads directory if needed
        // ...

        // Delete data from the database
        $lamaranModel = new LamaranModel();
        $lamaranModel->delete($id);

        $response = [
            'status' => 200,
            'message' => 'Data deleted successfully',
        ];

        return $this->respondDeleted($response);
    }
}
