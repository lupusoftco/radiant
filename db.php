<?php
$dbn = "lupusoft";
$dbs = "localhost";
$dbu = "root";
$dbp = "";
$db = mysqli_connect($dbs,$dbu,$dbp,$dbn);
mysqli_set_charset($db, "utf8mb4");
if (mysqli_connect_errno()) {
  echo "Yöneticinize başvurun. Veritabanı bağlantı hatası : " . mysqli_connect_error();
  exit();
}
$ayarlarsorgu = "select * from ayarlar where id = 1";
$ayarlarsorgugonder = mysqli_query($db,$ayarlarsorgu);
$ayarlarsatir = mysqli_fetch_array($ayarlarsorgugonder);

$parabirimsorgu = "SELECT * FROM parabirimleri WHERE id =".$ayarlarsatir["parabirimi"];
$parabirimsorgugonder = mysqli_query($db,$parabirimsorgu);
$parabirimsatir = mysqli_fetch_array($parabirimsorgugonder);
function escape_sql_string($data) {
    if ( !isset($data) or empty($data) ) return '';
    if ( is_numeric($data) ) return $data;

    $non_displayables = array(
        '/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/',             // url encoded 16-31
        '/[\x00-\x08]/',            // 00-08
        '/\x0b/',                   // 11
        '/\x0c/',                   // 12
        '/[\x0e-\x1f]/'             // 14-31
    );
    foreach ( $non_displayables as $regex )
        $data = preg_replace( $regex, '', $data );
    $data = str_replace("'", "''", $data );
    return $data;
}
?>