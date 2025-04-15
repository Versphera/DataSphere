import pandas as pd
from sklearn.linear_model import LinearRegression
import numpy as np

# Fungsi untuk insight otomatis
def generate_insight(data, data_type):
    perubahan = data.iloc[-1, 1] - data.iloc[0, 1]
    if perubahan > 0:
        tren = "meningkat"
    elif perubahan < 0:
        tren = "menurun"
    else:
        tren = "stabil"

    avg_growth = perubahan / len(data)
    return f"{data_type} cenderung {tren} dengan rata-rata perubahan {avg_growth:.2f} per tahun."

# Fungsi untuk memberikan alasan kemungkinan perubahan
def generate_reason(data, data_type):
    perubahan = data.iloc[-1, 1] - data.iloc[0, 1]
    if perubahan > 0:
        reason = f"Kenaikan ini kemungkinan disebabkan oleh meningkatnya {data_type.lower()} seiring dengan kebijakan baru atau peningkatan fasilitas."
    elif perubahan < 0:
        reason = f"Penurunan ini kemungkinan disebabkan oleh berkurangnya {data_type.lower()} akibat faktor eksternal seperti migrasi, penurunan populasi, atau penutupan fasilitas."
    else:
        reason = f"{data_type} tetap stabil kemungkinan karena kondisi yang konsisten tanpa perubahan signifikan."
    return reason

# Fungsi untuk prediksi data (dengan penyesuaian pada tren data menurun)
def predict_data(data, tahun_prediksi):
    model = LinearRegression()
    X = np.array(data['Tahun']).reshape(-1, 1)
    y = np.array(data.iloc[:, 1])

    # Deteksi tren menurun
    if y[-1] < y[0]:
        model.fit(X, -y)  # Membalik data agar model memahami tren menurun
        prediksi = -model.predict(np.array([[tahun_prediksi]]))
    else:
        model.fit(X, y)
        prediksi = model.predict(np.array([[tahun_prediksi]]))
    
    return round(prediksi[0])

# Baca data CSV
data_sekolah = pd.read_csv("./public/data/Jumlah_Sekolah.csv")
data_siswa = pd.read_csv("./public/data/Jumlah_Siswa.csv")

# Insight
insight_sekolah = generate_insight(data_sekolah, "Jumlah Sekolah") + " " + generate_reason(data_sekolah, "Jumlah Sekolah")
insight_siswa = generate_insight(data_siswa, "Jumlah Siswa") + " " + generate_reason(data_siswa, "Jumlah Siswa")

# Prediksi
tahun_prediksi = 2025
prediksi_sekolah = predict_data(data_sekolah, tahun_prediksi)
prediksi_siswa = predict_data(data_siswa, tahun_prediksi)

# Simpan hasil ke file JSON agar bisa dipakai di CodeIgniter
insight_prediksi = {
    "insight_sekolah": insight_sekolah,
    "insight_siswa": insight_siswa,
    "prediksi_sekolah": prediksi_sekolah,
    "prediksi_siswa": prediksi_siswa
}

import json
with open("./public/data/insight_prediksi.json", "w") as f:
    json.dump(insight_prediksi, f)
