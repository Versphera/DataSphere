<?php
namespace App\Controllers;

use League\Csv\Reader;

class Kesehatan extends BaseController
{
    public function index()
    {
        try {
            // Baca data CSV untuk jumlah fasilitas kesehatan
            $csvFaskes = Reader::createFromPath(ROOTPATH . 'public/data/Jumlah_Faskes.csv', 'r');
            $csvFaskes->setHeaderOffset(0);

            // Baca data CSV untuk jumlah tenaga medis
            $csvMedis = Reader::createFromPath(ROOTPATH . 'public/data/Jumlah_Tenaga_Medis.csv', 'r');
            $csvMedis->setHeaderOffset(0);

            // Baca data insight dan prediksi
            $jsonPath = ROOTPATH . 'public/data/insight_prediksi_kesehatan.json';
            if (!file_exists($jsonPath)) {
                return "Error: File insight_prediksi_kesehatan.json tidak ditemukan.";
            }

            $jsonData = file_get_contents($jsonPath);
            $insightPrediksi = json_decode($jsonData, true);

            $data = [
                'data_faskes' => array_values(iterator_to_array($csvFaskes->getRecords())),
                'data_medis'  => array_values(iterator_to_array($csvMedis->getRecords())),
                'insight_prediksi' => $insightPrediksi
            ];

            return view('template/header')
                . view('template/navbar')
                . view('kesehatan', $data)
                . view('template/footer');

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage(); // Menampilkan pesan error jika terjadi kesalahan
        }
    }
}
?>
