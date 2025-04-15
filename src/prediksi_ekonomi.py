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
    return f"{data_type} cenderung {tren} dengan rata-rata perubahan {avg_growth:.2f}% per tahun."

# Fungsi untuk memberikan alasan kemungkinan perubahan
def generate_reason(data, data_type):
    perubahan = data.iloc[-1, 1] - data.iloc[0, 1]
    if perubahan > 0:
        reason = f"Kenaikan ini kemungkinan disebabkan oleh meningkatnya aktivitas {data_type.lower()} seiring dengan kebijakan baru atau pertumbuhan sektor terkait."
    elif perubahan < 0:
        reason = f"Penurunan ini kemungkinan disebabkan oleh berkurangnya aktivitas {data_type.lower()} akibat faktor eksternal seperti krisis ekonomi, pandemi, atau kebijakan tertentu."
    else:
        reason = f"{data_type} tetap stabil kemungkinan karena kondisi pasar yang konsisten tanpa perubahan signifikan."
    return reason

# Fungsi untuk prediksi data (dengan penyesuaian pada tren data menurun)
def predict_data(data, tahun_prediksi):
    model = LinearRegression()
    X = np.array(data['Tahun']).reshape(-1, 1)
    y = np.array(data.iloc[:, 1])

    if y[-1] < y[0]:  
        model.fit(X, -y)  # Membalik data agar model memahami tren menurun
        prediksi = -model.predict(np.array([[tahun_prediksi]]))
    else:
        model.fit(X, y)
        prediksi = model.predict(np.array([[tahun_prediksi]]))
    
    return round(prediksi[0], 2)

# Baca data CSV
data_industri = pd.read_csv("./public/data/Jumlah_Industri.csv")
data_ekonomi = pd.read_csv("./public/data/Laju_Pertumbuhan_PDRB.csv")

# Insight
insight_industri = generate_insight(data_industri, "Jumlah Industri") + " " + generate_reason(data_industri, "Jumlah Industri")
insight_ekonomi = generate_insight(data_ekonomi, "Laju Pertumbuhan PDRB") + " " + generate_reason(data_ekonomi, "Laju Pertumbuhan PDRB")

# Prediksi
tahun_prediksi = 2025
prediksi_industri = predict_data(data_industri, tahun_prediksi)
prediksi_ekonomi = predict_data(data_ekonomi, tahun_prediksi)

# Simpan hasil ke file JSON agar bisa dipakai di CodeIgniter
insight_prediksi_ekonomi = {
    "insight_industri": insight_industri,
    "insight_ekonomi": insight_ekonomi,
    "prediksi_industri": prediksi_industri,
    "prediksi_ekonomi": prediksi_ekonomi
}

with open("./public/data/insight_prediksi_ekonomi.json", "w") as f:
    json.dump(insight_prediksi_ekonomi, f)
