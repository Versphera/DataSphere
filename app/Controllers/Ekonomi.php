<?php
namespace App\Controllers;

use League\Csv\Reader;

class Ekonomi extends BaseController
{
    public function index()
    {
        try {
            // Baca data CSV untuk jumlah Industri
            $csvIndustri = Reader::createFromPath(ROOTPATH . 'public/data/Jumlah_Industri.csv', 'r');
            $csvIndustri->setHeaderOffset(0);

            // Baca data CSV untuk laju pertumbuhan PDRB
            $csvEkonomi = Reader::createFromPath(ROOTPATH . 'public/data/Laju_Pertumbuhan_PDRB.csv', 'r');
            $csvEkonomi->setHeaderOffset(0);

            // Baca data insight dan prediksi ekonomi
            $jsonPath = ROOTPATH . 'public/data/insight_prediksi_ekonomi.json';
            if (!file_exists($jsonPath)) {
                return "Error: File insight_prediksi_ekonomi.json tidak ditemukan.";
            }

            $jsonData = file_get_contents($jsonPath);
            $insightPrediksi = json_decode($jsonData, true);

            $data = [
                'data_Industri'        => array_values(iterator_to_array($csvIndustri->getRecords())),
                'data_ekonomi'         => array_values(iterator_to_array($csvEkonomi->getRecords())),
                'insight_prediksi'     => $insightPrediksi
            ];

            return view('template/header')
                . view('template/navbar')
                . view('ekonomi', $data)
                . view('template/footer');

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
