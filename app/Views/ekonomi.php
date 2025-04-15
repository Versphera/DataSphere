<!-- Hero Section -->
<section class="hero bg-light py-5">
    <div class="container text-center">
        <i class="fas fa-chart-line fa-4x text-primary mb-3"></i>
        <h1 class="display-5 fw-bold text-primary">Ekonomi Kabupaten Batang</h1>
        <p class="lead text-muted">
            Menyajikan data dan analisis perkembangan ekonomi Kabupaten Batang, termasuk industri dan pertumbuhan ekonomi.
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
                        <h5 class="card-title text-muted">Jumlah Industri (Terakhir)</h5>
                        <h2 class="text-primary"><?= end($data_Industri)['Jumlah Industri'] ?></h2>
                        <p class="card-text">Tahun <?= end($data_Industri)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-muted">Pertumbuhan PDRB (Terakhir)</h5>
                        <h2 class="text-primary"><?= end($data_ekonomi)['PDRB'] ?>%</h2>
                        <p class="card-text">Tahun <?= end($data_ekonomi)['Tahun'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Data & Grafik -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- INDUSTRI -->
        <div class="row align-items-start mb-5">
            <div class="col-lg-6">
                <h3 class="text-primary mb-3">Tabel Jumlah Industri</h3>
                <button class="btn btn-primary mb-2" onclick="exportTableToExcel('table-industri', 'Data_Jumlah_Industri')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-industri" class="table table-bordered table-hover text-center">
                        <thead class="table-success">
                            <tr>
                                <?php foreach (array_keys($data_Industri[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_Industri as $row): ?>
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
                <h3 class="text-primary mb-3">Grafik Jumlah Industri</h3>
                <canvas id="chartIndustri" height="200"></canvas>
            </div>
        </div>

        <!-- PERTUMBUHAN PDRB -->
        <div class="row align-items-start">
            <div class="col-lg-6">
                <h3 class="text-primary mb-3">Tabel Laju Pertumbuhan PDRB</h3>
                <button class="btn btn-primary mb-2" onclick="exportTableToExcel('table-pdrb', 'Data_Pertumbuhan_PDRB')">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <div class="table-responsive">
                    <table id="table-pdrb" class="table table-bordered table-hover text-center">
                        <thead class="table-success">
                            <tr>
                                <?php foreach (array_keys($data_ekonomi[0]) as $header): ?>
                                    <th><?= $header ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_ekonomi as $row): ?>
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
                <h3 class="text-primary mb-3">Grafik Laju Pertumbuhan PDRB</h3>
                <canvas id="chartEkonomi" height="200"></canvas>
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
                    <h5 class="fw-bold mb-2">Insight Jumlah Industri</h5>
                    <p><?= $insight_prediksi['insight_industri'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-success shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Insight PDRB</h5>
                    <p><?= $insight_prediksi['insight_ekonomi'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi Jumlah Industri Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_industri'] ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-warning shadow-sm h-100">
                    <h5 class="fw-bold mb-2">Prediksi PDRB Tahun 2025</h5>
                    <p><?= $insight_prediksi['prediksi_ekonomi'] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script Chart -->
<script>
    const tahunIndustri = <?= json_encode(array_column($data_Industri, 'Tahun')) ?>;
    const jumlahIndustri = <?= json_encode(array_column($data_Industri, 'Jumlah Industri')) ?>;

    const tahunEkonomi = <?= json_encode(array_column($data_ekonomi, 'Tahun')) ?>;
    const dataPengeluaranRT = <?= json_encode(array_column($data_ekonomi, 'Pengeluaran Konsumsi Rumah Tangga')) ?>;
    const dataPengeluaranLNPRT = <?= json_encode(array_column($data_ekonomi, 'Pengeluaran Konsumsi LNPRT')) ?>;
    const dataPengeluaranPemerintah = <?= json_encode(array_column($data_ekonomi, 'Pengeluaran Konsumsi Pemerintah')) ?>;
    const dataModalTetap = <?= json_encode(array_column($data_ekonomi, 'Pembentukan Modal Tetap Bruto')) ?>;
    const jumlahEkonomi = <?= json_encode(array_column($data_ekonomi, 'PDRB')) ?>;
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