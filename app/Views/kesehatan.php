<!-- Hero Section -->
<section class="hero bg-light py-5">
    <div class="container text-center">
        <i class="fas fa-heartbeat fa-4x text-danger mb-3"></i>
        <h1 class="display-5 fw-bold text-danger">Kesehatan Kabupaten Batang</h1>
        <p class="lead text-muted">
            Menyajikan informasi jumlah fasilitas kesehatan dan tenaga medis, dilengkapi insight dan prediksi hingga tahun 2025.
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
                        <h5 class="card-title text-muted">Total Fasilitas Kesehatan (Terakhir)</h5>
                        <h2 class="text-danger"><?= end($data_faskes)['Jumlah Fasilitas Kesehatan'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_faskes)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Total Tenaga Medis (Terakhir)</h5>
                        <h2 class="text-danger"><?= end($data_medis)['Jumlah Tenaga Medis'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_medis)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Data & Grafik -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- Fasilitas Kesehatan -->
        <div class="row align-items-start mb-5">
            <div class="col-lg-6">
                <h3 class="text-danger mb-3">Tabel Fasilitas Kesehatan</h3>
                <button class="btn btn-danger mb-2" onclick="exportTableToExcel('table-faskes', 'Data_Fasilitas_Kesehatan')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-faskes" class="table table-bordered table-hover text-center">
                        <thead class="table-danger">
                            <tr>
                                <?php foreach (array_keys($data_faskes[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_faskes as $row): ?>
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
                <h3 class="text-danger mb-3">Grafik Fasilitas Kesehatan</h3>
                <canvas id="chartFaskes" height="200"></canvas>
            </div>
        </div>

        <!-- Tenaga Medis -->
        <div class="row align-items-start">
            <div class="col-lg-6">
                <h3 class="text-danger mb-3">Tabel Tenaga Medis</h3>
                <button class="btn btn-danger mb-2" onclick="exportTableToExcel('table-medis', 'Data_Tenaga_Medis')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-medis" class="table table-bordered table-hover text-center">
                        <thead class="table-danger">
                            <tr>
                                <?php foreach (array_keys($data_medis[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_medis as $row): ?>
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
                <h3 class="text-danger mb-3">Grafik Tenaga Medis</h3>
                <canvas id="chartMedis" height="200"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Insight & Prediksi -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="alert alert-danger shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight Fasilitas Kesehatan</h5>
                    <p><?= $insight_prediksi['insight_faskes'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-danger shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight Tenaga Medis</h5>
                    <p><?= $insight_prediksi['insight_medis'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi Fasilitas Kesehatan 2025</h5>
                    <p><?= $insight_prediksi['prediksi_faskes'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi Tenaga Medis 2025</h5>
                    <p><?= $insight_prediksi['prediksi_medis'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart -->
<script>
    const tahunFaskes = <?= json_encode(array_column($data_faskes, 'Tahun')) ?>;
    const jumlahFaskes = <?= json_encode(array_column($data_faskes, 'Jumlah Fasilitas Kesehatan')) ?>;

    const tahunMedis = <?= json_encode(array_column($data_medis, 'Tahun')) ?>;
    const jumlahMedis = <?= json_encode(array_column($data_medis, 'Jumlah Tenaga Medis')) ?>;
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
