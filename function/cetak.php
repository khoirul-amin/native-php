<?php
include '../koneksi.php';
include '../assets/fpdf/fpdf.php';
$id =  $_GET['id'];

$kategori =  mysqli_query($koneksi, "SELECT * FROM kategori");

$pdf = new FPDF();
$pdf->AddPage();		
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,7,'RENCANAN ANGGARAN BIAYA',0,1,'C');
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(40,6,"KEGIATAN",1,0);
$pdf->Cell(150,6,'Konstruksi',1,1);
$pdf->Cell(40,6,"PEKERJAAN",1,0);
$pdf->Cell(150,6,'Pembuatan bangunan',1,1);
// $pdf->Cell(40,6,"LOKASI",1,0);
// $pdf->Cell(150,6,'Jumlah Keseluruhan',1,1);

$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'NO',1,0);
$pdf->Cell(85,6,'URAIAN PEKERJAAN',1,0);
$pdf->Cell(15,6,'SAT',1,0);
$pdf->Cell(10,6,'VOL',1,0);
$pdf->Cell(25,6,'HARGA SAT.',1,0);
$pdf->Cell(40,6,'TOTAL',1,1);

$pdf->SetFont('Arial','',10);
$no = 0;
$no1 = 0;
while($gol = mysqli_fetch_array($kategori)){
    $no++;
    $id_kategori = $gol['id'];
    $rabs =  mysqli_query($koneksi,"SELECT * FROM detail_konstruksi WHERE id_pemesanan='$id' AND id_kategori='$id_kategori'");
    $col = "";
    $pdf->Cell(15,6,$no,1,0);
    $pdf->Cell(175,6,$gol['nama_kategori'],1,1);
    while($rab = mysqli_fetch_array($rabs)){
        $no1++;
        $pdf->Cell(15,6,'',1,0);
        $pdf->Cell(10,6,$no1,1,0);
        $pdf->Cell(75,6,$rab['keterangan'],1,0);
        $pdf->Cell(15,6,$rab['satuan'],1,0);
        $pdf->Cell(10,6,$rab['volume'],1,0);
        $pdf->Cell(25,6,'Rp. '.number_format($rab['harga_satuan']),1,0);
        $pdf->Cell(40,6,'Rp. '.number_format($rab['total']),1,1);
    }
}
$rab1s =  mysqli_query($koneksi,"SELECT * FROM detail_konstruksi WHERE id_kategori=0 AND id_pemesanan='$id'");
$collain = "";
$pdf->Cell(15,6,$no+1,1,0);
$pdf->Cell(175,6,'PEKERJAAN LAIN-LAIN',1,1);
while($rab1 = mysqli_fetch_array($rab1s)){
    $no1++;
    $pdf->Cell(15,6,'',1,0);
    $pdf->Cell(10,6,$no1,1,0);
    $pdf->Cell(75,6,$rab1['keterangan'],1,0);
    $pdf->Cell(15,6,$rab1['satuan'],1,0);
    $pdf->Cell(10,6,$rab1['volume'],1,0);
    $pdf->Cell(25,6,'Rp. '.number_format($rab1['harga_satuan']),1,0);
    $pdf->Cell(40,6,'Rp. '.number_format($rab1['total']),1,1);
}

$pdf->Cell(150,6,'Jumlah Keseluruhan',1,0);
$totals = mysqli_query($koneksi, "SELECT SUM(total) AS total FROM detail_konstruksi WHERE id_pemesanan='$id'");
while($total = mysqli_fetch_array($totals)){
    $pdf->Cell(40,6,'Rp. '.number_format($total['total']),1,1);
}
$pdf->SetTitle('RAB');

$pdf->Output('D', 'RAB-Bangunan.pdf');