<?php
header('Content-Type: application/json');

// 1. Pengaturan Data (Ganti slug dengan milik Anda)
$api_key = "URaa2XAwEHwXrO0LTZcFUfLBozUQqdON";
$slug    = "reyz"; // <--- GANTI INI dengan slug project Pak Kasir Anda
$order_id = "INV-" . time();

// 2. Ambil input dari Frontend
$input  = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'] ?? 0;

if ($amount < 1000) {
    echo json_encode(['status' => 'error', 'message' => 'Nominal minimal Rp 1.000']);
    exit;
}

// 3. Susun URL sesuai format yang Anda berikan
$url = "https://app.pakasir.com/api/transactiondetail?project=$slug&amount=$amount&order_id=$order_id&api_key=$api_key";

// 4. Ambil data menggunakan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Lewati verifikasi SSL jika di localhost

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(['status' => 'error', 'message' => 'CURL Error: ' . $err]);
} else {
    // Kirim hasil respon mentah dari Pak Kasir ke Frontend
    echo $response;
}
?>
