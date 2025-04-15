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
data_faskes = pd.read_csv("./public/data/Jumlah_Faskes.csv")
data_medis = pd.read_csv("./public/data/Jumlah_Tenaga_Medis.csv")

# Insight
insight_faskes = generate_insight(data_faskes, "Jumlah Fasilitas Kesehatan") + " " + generate_reason(data_faskes, "Jumlah Fasilitas Kesehatan")
insight_medis = generate_insight(data_medis, "Jumlah Tenaga Medis") + " " + generate_reason(data_medis, "Jumlah Tenaga Medis")

# Prediksi
tahun_prediksi = 2025
prediksi_faskes = predict_data(data_faskes, tahun_prediksi)
prediksi_medis = predict_data(data_medis, tahun_prediksi)

# Simpan hasil ke file JSON agar bisa dipakai di CodeIgniter
insight_prediksi = {
    "insight_faskes": insight_faskes,
    "insight_medis": insight_medis,
    "prediksi_faskes": prediksi_faskes,
    "prediksi_medis": prediksi_medis
}

import json
with open("./public/data/insight_prediksi_kesehatan.json", "w") as f:
    json.dump(insight_prediksi, f)
