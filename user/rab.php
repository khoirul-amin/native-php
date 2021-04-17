
  <?php
    include '../library/session.php';
    include '../koneksi.php';
    $session = (new Session())->cek_session();
    if(!$session){
        header('location:../login.php');
    }
    $id = $session->id;
    $title = 'Data Proyek';
    include './header.php';
  ?>

<!-- Main content -->

<div class="main-content" id="panel">
<?php 
    include './topnav.php';
?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">1. Form RAB Pelanggan</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
          <button type="button" class="btn btn-success mb-2 btn-sm"
          data-toggle='modal' data-target='#modalForm'>
            <i class="fas fa-plus"></i> Tambah
          </button>
          <a href="../function/cetak.php?id=<?=$id;?>" target="new" class="btn btn-danger mb-2 btn-sm">
            <i class="fas fa-plus"></i> Print
          </a>
        <div class="card p-2">
            <?php
                $kategori =  mysqli_query($koneksi, "SELECT * FROM kategori");
                $id = $_GET['id'];
                $title =  array();
                while($gol = mysqli_fetch_array($kategori)){
                    $id_kategori = $gol['id'];
                    $rabs =  mysqli_query($koneksi,"SELECT * FROM detail_konstruksi WHERE id_kategori='$id_kategori' AND id_pemesanan='$id'");
                    $col = "";
                    while($rab = mysqli_fetch_array($rabs)){
                        $rab_id = $rab['id'];
                        $keterangan = $rab['keterangan'];
                        $satuan = $rab['satuan'];
                        $harga_satuan = $rab['harga_satuan'];
                        $volume = $rab['volume'];
                        $total = $rab['total'];
                        $col = $col."<tr>
                            <td class='mr-auto'>$keterangan</td>
                            <td class='mr-2'>$satuan</td>
                            <td class='mr-2'>Rp. ".number_format($harga_satuan)."</td>
                            <td class='mr-2'>$volume</td>
                            <td class='mr-2'>Rp. ".number_format($total)."</td>
                            <td class='mr-2'><a href='../function/hapus_rab.php?id=$rab_id&id_pem=$id' class='btn btn-primary btn-sm text-white' >Hapus</a></td>
                        </tr>"; 
                    }
                    $nama_kategori = $gol['nama_kategori'];
                    $table = "<table class='table'>$col</table>";
                    $title[] = "<h4 class='text-center'>$nama_kategori</h4>".$table; 
                }
                for($i=0; $i<count($title);$i++){
                    echo $title[$i];
                }; 
            ?>
        </div>
        <div class="card p-3">
            <div class="row ml-0 mr-0">
                <div class="mr-auto">Jumlah</div>
                <?php
                    $total = mysqli_query($koneksi,"SELECT SUM(total) AS total FROM detail_konstruksi WHERE id_pemesanan='$id'");
                    while($total = mysqli_fetch_array($total)){
                ?>
                <div><b><?="Rp. ".number_format($total['total'])?></b></div>
                <?php } ?>
            </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    
    <?php include './footer.php';?>
  </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpdateData" action="../function/tambah_rab.php" method="post" class="modal-content">
                <input type="hidden" name="id" value=<?=$id;?> id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Proses Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="inputKeterangan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="Kategori">Kategori</label>
                        <select name="kategori" class="form-control" id="Kategori">
                            <?php
                            $kategori1 =  mysqli_query($koneksi, "SELECT * FROM kategori");
                            while($kategori = mysqli_fetch_array($kategori1)){ ?>
                                <option value=<?=$kategori['id']?>><?=$kategori['nama_kategori'];?></option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputSatuan">Satuan</label>
                        <input type="text" name="satuan" class="form-control" id="inputSatuan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputHargaSatuan">Harga Satuan</label>
                        <input type="number" name="harga" class="form-control" id="inputHargaSatuan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputVolume">Volume</label>
                        <input type="number" name="volume" class="form-control" id="inputVolume" placeholder="..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpdateData')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>


<?php include './script.php';?>