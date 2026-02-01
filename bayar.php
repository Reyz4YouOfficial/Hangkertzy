<?php
// Masukkan API Key Anda di sini (Aman karena tidak terlihat di browser)
$apiKey = "URaa2XAwEHwXrO0LTZcFUfLBozUQqdON";

// Ambil data dari request frontend
$input = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'] ?? 0;

if ($amount < 1000) {
    echo json_encode(['status' => 'error', 'message' => 'Nominal minimal Rp 1.000']);
    exit;
}

// Data transaksi
$data = [
    'amount' => (int)$amount,
    'reference_id' => 'INV-' . time(),
    'description' => 'Pembayaran QRIS',
];

// Inisialisasi CURL untuk panggil API Pak Kasir
$ch = curl_init('https://api.pakkasir.id/v1/transaction/qris'); // Ganti URL jika ada di dokumentasi
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, http_code);
curl_close($ch);

// Kirim balik hasilnya ke HTML
header('Content-Type: application/json');
echo $response;
?>
