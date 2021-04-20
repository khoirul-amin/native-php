<?php
include '../koneksi.php';
include '../assets/fpdf/fpdf.php';
$id =  $_GET['id'];

$where = array('id' => $id);

$query = "SELECT * FROM v_pemesanan WHERE id='$id'";      
$result = mysqli_query($koneksi,$query);
$pdf = new FPDF();
$pdf->AddPage();
while($result = mysqli_fetch_assoc($result)){

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,7,'Pesanan Pelanggan',0,1,'C');
    $pdf->Cell(10,7,'',0,1);

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,"Invoice",1,0);
    $pdf->Cell(150,6,$result['invoice'],1,1);
    $pdf->Cell(40,6,"Nama",1,0);
    $pdf->Cell(150,6,$result['nama'],1,1);
    $pdf->Cell(40,6,"NIK",1,0);
    $pdf->Cell(150,6,$result['nik'],1,1);
    $pdf->Cell(40,6,"Alamat",1,0);
    $pdf->Cell(150,6,$result['alamat'],1,1);
    $pdf->Cell(40,6,"Telpon",1,0);
    $pdf->Cell(150,6,$result['no_telp'],1,1);
    $pdf->Cell(40,6,"Type Rumah",1,0);
    $pdf->Cell(150,6,$result['model'],1,1);
    $pdf->Cell(40,6,"Luas Tanah",1,0);
    $pdf->Cell(150,6,$result['ukuran'],1,1);
    $pdf->Cell(40,6,"Kamar Tidur",1,0);
    $pdf->Cell(150,6,$result['kamar'],1,1);
    $pdf->Cell(40,6,"Kamar Mandi",1,0);
    $pdf->Cell(150,6,$result['kamar_mandi'],1,1);
    $pdf->Cell(40,6,"Luas Bangunan",1,0);
    $pdf->Cell(150,6,$result['luas_bangunan'],1,1);
    $pdf->Cell(40,6,"Garasi",1,0);
    $pdf->Cell(150,6,$result['garasi'],1,1);
    $pdf->Cell(40,12,"Referensi",1,0);
    $pdf->MultiCell(150,6,$result['referensi'],1,1);

}

$pdf->SetTitle('Pesanan');

// $pdf->Output();
$pdf->Output('D', 'Pesanan'.$result['invoice'].'.pdf');
?>