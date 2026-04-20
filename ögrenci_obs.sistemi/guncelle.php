<?php
header("Content-Type: application/json; charset=UTF-8");
$baglanti = new mysqli("localhost", "root", "", "obs_db");

if ($baglanti->connect_error) {
    echo json_encode(["status" => "error", "message" => "Bağlantı hatası"]);
    exit;
}
$baglanti->set_charset("utf8");

$id = intval($_POST['id'] ?? 0);
$ad = $_POST['ad'] ?? '';
$vize = floatval($_POST['vize'] ?? 0);
$final = floatval($_POST['final'] ?? 0);
$ortalama = floatval($_POST['ortalama'] ?? 0);
$harf = $_POST['harf'] ?? '';

if($id <= 0 || empty($ad)) {
    echo json_encode(["status" => "error", "message" => "Eksik veya geçersiz bilgi."]);
    exit;
}

$sql = "UPDATE ogrenciler SET ad=?, vize=?, final=?, ortalama=?, harf=? WHERE id=?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("siddsi", $ad, $vize, $final, $ortalama, $harf, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Öğrenci bilgileri güncellendi."]);
} else {
    echo json_encode(["status" => "error", "message" => "Güncelleme hatası: " . $stmt->error]);
}

$stmt->close();
$baglanti->close();
?>