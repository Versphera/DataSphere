import pandas as pd
from sklearn.linear_model import LinearRegression
import numpy as np
import json

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
        reason = f"Kenaikan ini kemungkinan disebabkan oleh peningkatan fasilitas, kebijakan baru, atau kondisi sosial yang lebih baik."
    elif perubahan < 0:
        reason = f"Penurunan ini kemungkinan akibat faktor eksternal seperti krisis ekonomi, perubahan kebijakan, atau kondisi sosial yang kurang mendukung."
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
    
    return round(prediksi[0], 2)

# Baca data CSV
data_ipm = pd.read_csv("./public/data/Indeks_Pembangunan_Manusia.csv")
data_uhh = pd.read_csv("./public/data/Umur_Harapan_Hidup.csv")

# Insight dengan alasan
insight_ipm = generate_insight(data_ipm, "Indeks Pembangunan Manusia") + " " + generate_reason(data_ipm, "Indeks Pembangunan Manusia")
insight_uhh = generate_insight(data_uhh, "Umur Harapan Hidup") + " " + generate_reason(data_uhh, "Umur Harapan Hidup")

# Prediksi
tahun_prediksi = 2025
prediksi_ipm = predict_data(data_ipm, tahun_prediksi)
prediksi_uhh = predict_data(data_uhh, tahun_prediksi)

# Simpan hasil ke file JSON agar bisa dipakai di CodeIgniter
insight_prediksi_kependudukan = {
    "insight_ipm": insight_ipm,
    "insight_uhh": insight_uhh,
    "prediksi_ipm": prediksi_ipm,
    "prediksi_uhh": prediksi_uhh
}

with open("./public/data/insight_prediksi_kependudukan.json", "w") as f:
    json.dump(insight_prediksi_kependudukan, f)
