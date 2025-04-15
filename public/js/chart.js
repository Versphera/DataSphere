window.onload = function () {
    // Grafik Jumlah Sekolah
    const ctxSekolah = document.getElementById('chartSekolah');
    if (ctxSekolah) {
        new Chart(ctxSekolah.getContext('2d'), {
            type: 'line',
            data: {
                labels: tahunSekolah,
                datasets: [{
                    label: 'Jumlah Sekolah',
                    data: jumlahSekolah,
                    borderColor: 'rgb(24, 218, 127)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            }
        });
    }

    // Grafik Jumlah Siswa
    const ctxSiswa = document.getElementById('chartSiswa');
    if (ctxSiswa) {
        new Chart(ctxSiswa.getContext('2d'), {
            type: 'line',
            data: {
                labels: tahunSiswa,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: jumlahSiswa,
                    borderColor: 'rgb(24, 218, 127)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            }
        });
    }

     // Grafik Jumlah Fasilitas Kesehatan
const ctxFaskes = document.getElementById('chartFaskes');
if (ctxFaskes) {
    new Chart(ctxFaskes.getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunFaskes,
            datasets: [{
                label: 'Jumlah Fasilitas Kesehatan',
                data: jumlahFaskes,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        }
    });
}

// Grafik Jumlah Tenaga Medis
const ctxMedis = document.getElementById('chartMedis');
if (ctxMedis) {
    new Chart(ctxMedis.getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunMedis,
            datasets: [{
                label: 'Jumlah Tenaga Medis',
                data: jumlahMedis,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        }
    });
}

    // Grafik Jumlah Industri
    const ctxIndustri = document.getElementById('chartIndustri');
    if (ctxIndustri) {
        new Chart(ctxIndustri.getContext('2d'), {
            type: 'line',
            data: {
                labels: tahunIndustri,
                datasets: [{
                    label: 'Jumlah Industri',
                    data: jumlahIndustri,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            }
        });
    }

    // Grafik Pertumbuhan Ekonomi
const ctxEkonomi = document.getElementById('chartEkonomi');
if (ctxEkonomi) {
    new Chart(ctxEkonomi.getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunEkonomi,
            datasets: [
                {
                    label: 'Pengeluaran Konsumsi Rumah Tangga',
                    data: dataPengeluaranRT,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Pengeluaran Konsumsi LNPRT',
                    data: dataPengeluaranLNPRT,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Pengeluaran Konsumsi Pemerintah',
                    data: dataPengeluaranPemerintah,
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Pembentukan Modal Tetap Bruto',
                    data: dataModalTetap,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'PDRB',
                    data: jumlahEkonomi,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    min: -30,
                    max: 20
                }
            }
        }
    });
}


    // Grafik IPM
const ctxIPM = document.getElementById('chartIPM');
if (ctxIPM) {
    new Chart(ctxIPM.getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunIPM,
            datasets: [{
                label: 'Indeks Pembangunan Manusia (IPM)',
                data: jumlahIPM,
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        }
    });
}

// Grafik UHH
const ctxUHH = document.getElementById('chartUHH');
if (ctxUHH) {
    new Chart(ctxUHH.getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunUHH,
            datasets: [{
                label: 'Umur Harapan Hidup (UHH)',
                data: jumlahUHH,
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        }
    });
}

};
