<?php
namespace App\Controllers;

use League\Csv\Reader;

class Kependudukan extends BaseController
{
    public function index()
    {
        try {
            // Baca data CSV untuk IPM
            $csvIPM = Reader::createFromPath(ROOTPATH . 'public/data/Indeks_Pembangunan_Manusia.csv', 'r');
            $csvIPM->setHeaderOffset(0);

            // Baca data CSV untuk UHH
            $csvUHH = Reader::createFromPath(ROOTPATH . 'public/data/Umur_Harapan_Hidup.csv', 'r');
            $csvUHH->setHeaderOffset(0);

            // Baca data insight dan prediksi kependudukan
            $jsonPath = ROOTPATH . 'public/data/insight_prediksi_kependudukan.json';
            if (!file_exists($jsonPath)) {
                return "Error: File insight_prediksi_kependudukan.json tidak ditemukan.";
            }

            $jsonData = file_get_contents($jsonPath);
            $insightPrediksi = json_decode($jsonData, true);

            $data = [
                'data_ipm'            => array_values(iterator_to_array($csvIPM->getRecords())),
                'data_uhh'            => array_values(iterator_to_array($csvUHH->getRecords())),
                'insight_prediksi'    => $insightPrediksi
            ];

            return view('template/header')
                . view('template/navbar')
                . view('kependudukan', $data)
                . view('template/footer');

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
