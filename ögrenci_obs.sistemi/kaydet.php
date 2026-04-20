<?php
header("Content-Type: application/json; charset=UTF-8");
$baglanti = new mysqli("localhost", "root", "", "obs_db");

if ($baglanti->connect_error) {
    echo json_encode(["status" => "error", "message" => "Bağlantı hatası: " . $baglanti->connect_error]);
    exit;
}
$baglanti->set_charset("utf8");

$ad = $_POST['ad'] ?? '';
$numara = $_POST['numara'] ?? '';
$vize = floatval($_POST['vize'] ?? 0);
$final = floatval($_POST['final'] ?? 0);
$ortalama = floatval($_POST['ortalama'] ?? 0);
$harf = $_POST['harf'] ?? '';

if(empty($ad) || empty($numara)) {
    echo json_encode(["status" => "error", "message" => "Eksik bilgi."]);
    exit;
}

$sql = "INSERT INTO ogrenciler (ad, numara, vize, final, ortalama, harf) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("ssidds", $ad, $numara, $vize, $final, $ortalama, $harf);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Kayıt başarıyla eklendi."]); 
} else {
    echo json_encode(["status" => "error", "message" => "Veritabanı hatası: " . $stmt->error]);
}

$stmt->close();
$baglanti->close();
?>