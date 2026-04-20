<?php
header("Content-Type: application/json; charset=UTF-8");
$baglanti = new mysqli("localhost", "root", "", "obs_db");

if ($baglanti->connect_error) {
    echo json_encode(["status" => "error", "message" => "Bağlantı hatası"]);
    exit();
}

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "Geçersiz ID"]);
    exit();
}

$sql = "DELETE FROM ogrenciler WHERE id = ?";
$stmt = $baglanti->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Kayıt silindi"]);
} else {
    echo json_encode(["status" => "error", "message" => "Silme işlemi başarısız"]);
}

$stmt->close();
$baglanti->close();
?>