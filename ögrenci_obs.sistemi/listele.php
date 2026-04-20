<?php
header("Content-Type: application/json; charset=UTF-8");
$baglanti = new mysqli("localhost", "root", "", "obs_db");

if ($baglanti->connect_error) {
    echo json_encode(["hata" => "Bağlantı hatası"]);
    exit;
}
$baglanti->set_charset("utf8");

$sql = "SELECT * FROM ogrenciler ORDER BY id DESC";
$sonuc = $baglanti->query($sql);

$ogrenciler = [];
if ($sonuc) {
    while ($row = $sonuc->fetch_assoc()) {
        $row['ad'] = htmlspecialchars($row['ad'], ENT_QUOTES, 'UTF-8');
        $row['numara'] = htmlspecialchars($row['numara'], ENT_QUOTES, 'UTF-8');
        $ogrenciler[] = $row;
    }
}

echo json_encode($ogrenciler);
$baglanti->close();
?>