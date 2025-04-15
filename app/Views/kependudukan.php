<!-- Hero Section -->
<section class="hero bg-light py-5">
    <div class="container text-center">
        <i class="fas fa-users fa-4x text-warning mb-3"></i>
        <h1 class="display-5 fw-bold text-warning">Kependudukan Kabupaten Batang</h1>
        <p class="lead text-muted">
            Menyajikan data, visualisasi, insight, dan prediksi terkait kependudukan di Kabupaten Batang seperti IPM dan UHH.
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
                        <h5 class="card-title text-muted">IPM Terbaru</h5>
                        <h2 class="text-warning"><?= end($data_ipm)['Indeks Pembangunan Manusia'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_ipm)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">UHH Terbaru</h5>
                        <h2 class="text-warning"><?= end($data_uhh)['Umur Harapan Hidup'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_uhh)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Data & Grafik -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- IPM -->
        <div class="row align-items-start mb-5">
            <div class="col-lg-6">
                <h3 class="text-warning mb-3">Tabel IPM</h3>
                <button class="btn btn-warning mb-2" onclick="exportTableToExcel('table-ipm', 'Data_IPM')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-ipm" class="table table-bordered table-hover text-center">
                        <thead class="table-warning">
                            <tr>
                                <?php foreach (array_keys($data_ipm[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_ipm as $row): ?>
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
                <h3 class="text-warning mb-3">Grafik IPM</h3>
                <canvas id="chartIPM" height="200"></canvas>
            </div>
        </div>

        <!-- UHH -->
        <div class="row align-items-start">
            <div class="col-lg-6">
                <h3 class="text-warning mb-3">Tabel Umur Harapan Hidup</h3>
                <button class="btn btn-warning mb-2" onclick="exportTableToExcel('table-uhh', 'Data_UHH')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-uhh" class="table table-bordered table-hover text-center">
                        <thead class="table-warning">
                            <tr>
                                <?php foreach (array_keys($data_uhh[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_uhh as $row): ?>
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
                <h3 class="text-warning mb-3">Grafik Umur Harapan Hidup</h3>
                <canvas id="chartUHH" height="200"></canvas>
            </div>
        </div>
    </div>
</section>

<!-- Insight & Prediksi -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight IPM</h5>
                    <p><?= $insight_prediksi['insight_ipm'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight Umur Harapan Hidup</h5>
                    <p><?= $insight_prediksi['insight_uhh'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-info shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi IPM Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_ipm'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-info shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi UHH Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_uhh'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart -->
<script>
    const tahunIPM = <?= json_encode(array_column($data_ipm, 'Tahun')) ?>;
    const jumlahIPM = <?= json_encode(array_column($data_ipm, 'Indeks Pembangunan Manusia')) ?>;

    const tahunUHH = <?= json_encode(array_column($data_uhh, 'Tahun')) ?>;
    const jumlahUHH = <?= json_encode(array_column($data_uhh, 'Umur Harapan Hidup')) ?>;
</script>

<!-- Library dan Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="<?= base_url('js/chart.js') ?>"></script>

<!-- Script Export Excel -->
<script>
    function exportTableToExcel(tableID, filename = '') {
        const table = document.getElementById(tableID);
        const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
        XLSX.writeFile(wb, filename ? filename + ".xlsx" : "data.xlsx");
    }
</script>
