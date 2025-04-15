<?php
namespace App\Controllers;

use League\Csv\Reader;

class Pendidikan extends BaseController
{
    public function index()
    {
        try {
            // Baca data CSV untuk jumlah sekolah
            $csvSekolah = Reader::createFromPath(ROOTPATH . 'public/data/Jumlah_Sekolah.csv', 'r');
            $csvSekolah->setHeaderOffset(0);

            // Baca data CSV untuk jumlah siswa
            $csvSiswa = Reader::createFromPath(ROOTPATH . 'public/data/Jumlah_Siswa.csv', 'r');
            $csvSiswa->setHeaderOffset(0);

            // Baca data insight dan prediksi
            $jsonPath = ROOTPATH . 'public/data/insight_prediksi.json';
            if (!file_exists($jsonPath)) {
                return "Error: File insight_prediksi.json tidak ditemukan.";
            }

            $jsonData = file_get_contents($jsonPath);
            $insightPrediksi = json_decode($jsonData, true);

            $data = [
                'data_sekolah' => array_values(iterator_to_array($csvSekolah->getRecords())),
                'data_siswa'   => array_values(iterator_to_array($csvSiswa->getRecords())),
                'insight_prediksi' => $insightPrediksi
            ];

            return view('template/header')
                . view('template/navbar')
                . view('pendidikan', $data)
                . view('template/footer');

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage(); // Menampilkan pesan error jika terjadi kesalahan
        }
    }
}
