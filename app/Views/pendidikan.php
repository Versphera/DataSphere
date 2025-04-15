<!-- Tambahkan di bagian <head> atau sebelum </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- Hero Section -->
<section class="hero bg-light py-5">
    <div class="container text-center">
        <i class="fas fa-graduation-cap fa-4x text-success mb-3"></i>
        <h1 class="display-5 fw-bold text-success">Pendidikan Kabupaten Batang</h1>
        <p class="lead text-muted">
            Menyajikan data dan analisis lengkap seputar pendidikan di Kabupaten Batang, termasuk visualisasi, insight, dan prediksi.
        </p>
    </div>
</section>

<!-- Statistik Singkat -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Sekolah (Terakhir)</h5>
                        <h2 class="text-success"><?= end($data_sekolah)['Jumlah Sekolah'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_sekolah)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Siswa (Terakhir)</h5>
                        <h2 class="text-success"><?= end($data_siswa)['Jumlah Siswa'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_siswa)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Data & Grafik -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- JUMLAH SEKOLAH -->
        <div class="row align-items-start mb-5">
            <div class="col-lg-6">
                <h3 class="text-success mb-3">Tabel Jumlah Sekolah</h3>
                <button class="btn btn-success mb-2" onclick="exportTableToExcel('table-sekolah', 'Data_Jumlah_Sekolah')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-sekolah" class="table table-bordered table-hover text-center">
                        <thead class="table-success">
                            <tr>
                                <?php foreach (array_keys($data_sekolah[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_sekolah as $row): ?>
                                <tr>
                                    <?php foreach ($row as $cell): ?>
                                        <td><?= $cell ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="text-success mb-3">Grafik Jumlah Sekolah</h3>
                <canvas id="chartSekolah" height="200"></canvas>
            </div>
        </div>

        <!-- JUMLAH SISWA -->
        <div class="row align-items-start">
            <div class="col-lg-6">
                <h3 class="text-success mb-3">Tabel Jumlah Siswa</h3>
                <button class="btn btn-success mb-2" onclick="exportTableToExcel('table-siswa', 'Data_Jumlah_Siswa')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-siswa" class="table table-bordered table-hover text-center">
                        <thead class="table-success">
                            <tr>
                                <?php foreach (array_keys($data_siswa[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $row): ?>
                                <tr>
                                    <?php foreach ($row as $cell): ?>
                                        <td><?= $cell ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="text-success mb-3">Grafik Jumlah Siswa</h3>
                <canvas id="chartSiswa" height="200"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Insight & Prediksi -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="alert alert-success shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight Jumlah Sekolah</h5>
                    <p><?= $insight_prediksi['insight_sekolah'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-success shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight Jumlah Siswa</h5>
                    <p><?= $insight_prediksi['insight_siswa'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi Sekolah Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_sekolah'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi Siswa Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_siswa'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart -->
<script>
    const tahunSekolah = <?= json_encode(array_column($data_sekolah, 'Tahun')) ?>;
    const jumlahSekolah = <?= json_encode(array_column($data_sekolah, 'Jumlah Sekolah')) ?>;

    const tahunSiswa = <?= json_encode(array_column($data_siswa, 'Tahun')) ?>;
    const jumlahSiswa = <?= json_encode(array_column($data_siswa, 'Jumlah Siswa')) ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('js/chart.js') ?>"></script>

<!-- Script Export Excel -->
<script>
    function exportTableToExcel(tableID, filename = '') {
        const table = document.getElementById(tableID);
        const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
        XLSX.writeFile(wb, filename ? filename + ".xlsx" : "data.xlsx");
    }
</script>
