<?php
header('Content-Type: application/json');

// Ambil input nominal dari frontend
$input = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'] ?? 0;

if ($amount < 1000) {
    echo json_encode(['status' => 'error', 'message' => 'Nominal minimal Rp 1.000']);
    exit;
}

// Konfigurasi sesuai data yang Anda berikan
$api_key  = "URaa2XAwEHwXrO0LTZcFUfLBozUQqdON"; // API Key asli Anda
$slug     = "reyz";
$order_id = "DEP-" . strtoupper(bin2hex(random_bytes(4))); // Generate ID unik otomatis

// Susun URL pemanggilan
$url = "https://app.pakasir.com/api/transactiondetail?project=$slug&amount=$amount&order_id=$order_id&api_key=$api_key";

// Eksekusi menggunakan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghubungi server Pak Kasir']);
} else {
    echo $response; // Mengirimkan hasil JSON dari Pak Kasir ke browser
}
