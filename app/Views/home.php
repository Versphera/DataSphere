    <!-- ABOUT -->
    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                    <div class="about-text">
                        <small class="small-text">Selamat Datang di <span class="mobile-block">DataSphere</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">Menampilkan Data</span>
                                <div class="animated-info">
                                    <span class="animated-item">Pendidikan</span>
                                    <span class="animated-item">Kesehatan</span>
                                    <span class="animated-item">Ekonomi</span>
                                    <span class="animated-item">Kependudukan</span>
                                </div>
                        </h1>

                        <p>
                            DataSphere adalah platform yang dirancang untuk memberikan informasi dan analisis terkini mengenai berbagai aspek penting dalam kehidupan masyarakat. Dengan fokus pada pendidikan, kesehatan, ekonomi, dan kependudukan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12">
                    <div class="about-image svg">
                        <img src="images/undraw/undraw_data-trends_kv5v.svg" class="img-fluid" alt="svg image">
                    </div>
                </div>

            </div>
        </div>
    </section>
<!-- DATA YANG DITAMPILKAN -->
<section class="py-5 bg-light" id="data">
    <div class="container text-center">
        <h2 class="text fw-bold mb-5">Data yang Ditampilkan</h2>
        <div class="row g-4">
            <?php 
                $cards = [
                    [
                        "image" => "undraw_professor_d7zn.svg", "color" => "#28a745", "title" => "Pendidikan",
                        "desc" => "Menampilkan data sekolah dan data siswa serta tren pendidikan tahunan.",
                        "link" => base_url('pendidikan')
                    ],
                    [
                        "image" => "undraw_medicine_hqqg.svg", "color" => "#ff6347", "title" => "Kesehatan",
                        "desc" => "Menampilkan data Fasilitas kesehatan, dan tenaga Medis yang tersedia.",
                        "link" => base_url('kesehatan')
                    ],
                    [
                        "image" => "undraw_investing_kncz.svg", "color" => "#1e90ff", "title" => "Ekonomi",
                        "desc" => "Menampilkan data Jumlah Industri, dan data pertumbuhan Produk Domestik Regional Bruto.",
                        "link" => base_url('ekonomi')
                    ],
                    [
                        "image" => "undraw_conference-call_ccsp.svg", "color" => "#ffc107", "title" => "Kependudukan",
                        "desc" => "Menampilkan data indeks pembangunan manusia, dan Usia Harapan Hidup.",
                        "link" => base_url('kependudukan')
                    ]
                ];
                foreach ($cards as $card):
            ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow border-0 card-hover transition rounded-4">
                    <div class="card-body px-4 py-5 position-relative bg-white">
                        <!-- Badge -->
                        <span class="position-absolute top-0 start-50 translate-middle rounded-pill px-3 py-1 shadow-sm" style="top: -15px; background-color: <?= $card['color'] ?>; color: white;">
                            <?= $card['title'] ?>
                        </span>
                        <!-- Image -->
                        <div class="mx-auto mb-4" style="width: 80px; height: 80px;">
                            <img src="<?= base_url('images/undraw/' . $card['image']) ?>" alt="<?= $card['title'] ?>" class="img-fluid">
                        </div>
                        <!-- Title & Description -->
                        <h5 class="fw-semibold"><?= $card['title'] ?></h5>
                        <p class="text-muted small"><?= $card['desc'] ?></p>
                        <a href="<?= $card['link'] ?>" 
                          class="btn btn-sm mt-3 rounded-pill btn-color-hover"
                          style="border-color: <?= $card['color'] ?>; color: <?= $card['color'] ?>; --btn-color: <?= $card['color'] ?>;">
                          Lihat Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TENTANG PENULIS -->
<section class="py-5 bg-white" id="tentang-penulis">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center">
                <div class="position-relative d-inline-block">
                    <img src="<?= base_url('images/20250118_195433_857.jpg') ?>" class="img-fluid rounded-4 shadow-lg" alt="Foto Penulis" style="max-width: 280px; transition: transform 0.3s ease;">
                </div>
                <div class="mt-1">
                <strong>Fariq Ahnaf Syahlan</strong> 
                </div>
                <div class="mt-4">
                    <!-- Optional: Add more icons if needed -->
                    <a href="https://github.com/Versphera" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle me-2" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://instagram.com/ahnaffs" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <h2 class="fw-bold text-dark mb-3">Tentang Penulis</h2>
                <p class="text-muted">
                    Halo! Saya seorang <strong>Mahasiswa Teknik Informatika</strong> yang antusias dalam dunia <strong>visualisasi data</strong> dan <strong>pengolahan informasi publik.</strong>
                </p>
                <p class="text-muted">
                    Proyek ini merupakan bagian dari <strong>program magang saya di Diskominfo Kabupaten Batang</strong>, dan saya dedikasikan untuk mendukung transparansi serta keterbukaan informasi bagi masyarakat.
                </p>
                <p class="text-muted">
                Saya percaya bahwa teknologi dan penyajian data yang tepat dapat membantu menyampaikan informasi dengan lebih jelas dan mudah dipahami.
                </p>
            </div>
        </div>
    </div>
</section>
