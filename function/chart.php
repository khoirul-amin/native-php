<?php

include '../koneksi.php';
$tahun = $_POST['tahun'];
$bulan = array();
$dataPeriodeBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
$maxTrx = array();
for($i = 1;$i<=date('m');$i++){
    if($i <= 9){
        $month = '0'.$i;
    }else{
        $month = $i;
    }
    $where = $tahun.'-'.$month;
    $query = "SELECT * FROM pemesanan WHERE tanggal LIKE '%$where%'";
    $res = mysqli_query($koneksi,$query);
    $maxTrx[] = mysqli_num_rows($res);;
    $bulan[] = $dataPeriodeBulan[$i];
};
$data['bulan'] = $bulan;
$data['trx'] = $maxTrx;
echo json_encode($data);

?>