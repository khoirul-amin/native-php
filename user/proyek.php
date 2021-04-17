
  <?php
    include '../library/session.php';
    include '../koneksi.php';
    $session = (new Session())->cek_session();
    if(!$session){
        header('location:../login.php');
    }
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
            <h6 class="h2 d-inline-block mb-0">Pemesanan Belum Diperiksa</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card p-2">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tables" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Kode Invoice</th>
                  <th scope="col">Nama Pelanggan</th>
                  <th scope="col">Tgl. Pemesanan</th>
                  <!-- <th scope="col">File RAB</th> -->
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $query = "SELECT * FROM v_pesan_menunggu";      
                $result = mysqli_query($koneksi,$query);
                $no = 0;
                while($pesanan = mysqli_fetch_array($result)){ 
                $no++;
            ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?=$pesanan['invoice'];?></td>
                    <td><?=$pesanan['nama'];?></td>
                    <td><?=$pesanan['tanggal'];?></td>
                    <td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick="updateInformasi('<?=$pesanan['id']?>','<?=$pesanan['status']?>','<?=$pesanan['ket_ditolak']?>')"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i> Rubah Status</button>
						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick="viewInformasi('<?=$pesanan['nama']?>','<?=$pesanan['nik']?>','<?=$pesanan['model']?>','<?=$pesanan['ukuran']?>','<?=$pesanan['kamar']?>','<?=$pesanan['kamar_mandi']?>','<?=$pesanan['alamat']?>','<?=$pesanan['no_telp']?>','<?=$pesanan['lantai']?>','<?=$pesanan['luas_bangunan']?>','<?=$pesanan['garasi']?>','<?=$pesanan['referensi']?>','<?=$pesanan['pesan']?>','<?=$pesanan['id']?>')"
						><i class='fas fa-eye'></i></button>
                    </td>
                </tr>
            <?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Pemesanan Sudah Diperiksa</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card p-2">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tables1" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Kode Invoice</th>
                  <th scope="col">Nama Pelanggan</th>
                  <th scope="col">Tgl. Pemesanan</th>
                  <th scope="col">Admin</th>
                  <th scope="col">Status</th>
                  <!-- <th scope="col">File RAB</th> -->
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $query = "SELECT * FROM v_pemesanan WHERE status!='1'";      
                $result = mysqli_query($koneksi,$query);
                $no = 0;
                while($pesanan = mysqli_fetch_array($result)){ 
                $no++;
                $btn_rab = "";
    
                if($pesanan['status'] == 2){
                    $status = "Proses";
                    $id = $pesanan['id'];
                    $url_desain = $pesanan['desain_rumah'];
                    $btn_url_desain = "";
                    if(!empty($url_desain)){
                        $btn_url_desain = "
                        <a  download href='..//assets/pdfUpload/$url_desain'
                        class='btn btn-success btn-sm'>
                        <i class='fas fa-eye'></i> Desain
                        </a>";
                    }
                    $btn_rab = "<button type='button' 
                            onClick=\"setIDForm('$id')\" 
                            data-toggle='modal' data-target='#modalUpload'
                            class='btn btn-success btn-sm'>
                            <i class='far fa-file-alt'></i> Upload Desain
                            </button>
                            <a href='../user/rab.php?id=$id' class='btn btn-success btn-sm'><i class='far fa-file-alt'></i> RAB</a>";
                }elseif($pesanan['status'] == 3){
                    $status = "Reject";
                }elseif($pesanan['status'] == 4){
                    $status = "Menunggu Pembayaran";
                }elseif($pesanan['status'] == 5){
                    $status = "Selesai";
                }
                $button_bukti = "";
                if(!empty($pesanan['bukti_pembayaran'])){
                    $bukti = $pesanan['bukti_pembayaran'];
                    $button_bukti = "<button type='button' class='btn btn-success btn-sm'
                    data-toggle='modal' data-target='#modalBukti'
                    onclick=\"viewBukti('$bukti')\"
                    ><i class='fas fa-eye'></i> Bukti Pembayaran</button>";
                }
            ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?=$pesanan['invoice'];?></td>
                    <td><?=$pesanan['nama'];?></td>
                    <td><?=$pesanan['tanggal'];?></td>
                    <td><?=$pesanan['admin'];?></td>
			        <td><?=$status?></td>
                    <td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick="updateInformasi('<?=$pesanan['id']?>','<?=$pesanan['status']?>','<?=$pesanan['ket_ditolak']?>')"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i> Rubah Status</button>
						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick="viewInformasi('<?=$pesanan['nama']?>','<?=$pesanan['nik']?>','<?=$pesanan['model']?>','<?=$pesanan['ukuran']?>','<?=$pesanan['kamar']?>','<?=$pesanan['kamar_mandi']?>','<?=$pesanan['alamat']?>','<?=$pesanan['no_telp']?>','<?=$pesanan['lantai']?>','<?=$pesanan['luas_bangunan']?>','<?=$pesanan['garasi']?>','<?=$pesanan['referensi']?>','<?=$pesanan['pesan']?>','<?=$pesanan['id']?>')"
						><i class='fas fa-eye'></i></button>
                        <?=$btn_rab.$button_bukti.$btn_url_desain?>
                    </td>
                </tr>
            <?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    
  <?php
    include './footer.php';
  ?>
  </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form action="../function/rubah_status.php" method="post" id="formUpdateData" class="modal-content">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Proses Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="proses">Proses</label>
                        <select name="proses" class="form-control" id="proses">
                            <option value=2>Proses</option>
                            <option value=3>Tolak</option>
                            <option value=4>Menunggu Pembayaran</option>
                            <option value=5>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="inputKeterangan" placeholder="..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpdateData')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal view -->
    <div class="modal fade" id="modalView" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">View Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Nama</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="nama"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>NIK</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="nik"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Alamat</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="alamat"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Telpon</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="no_telp"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Rumah Tipe</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="type"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Luas Tanah</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="tanah"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Kamar Tidur</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="kamar"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Kamar Mandi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="kamar_mandi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Luas Bangunan</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="bangunan"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Garasi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="garasi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Referensi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="referensi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Lantai</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="lantai"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Pesan</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="pesan"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" target="new" class="btn btn-primary btn-sm" id="btn-cetak">Cetak</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bukti -->
    <div class="modal fade" id="modalBukti" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Bukti Pembayaran</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" width="300px" alt="bukti" id="img_bukti">
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Upload Berkas -->
    <div class="modal fade" id="modalUpload" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpload" class="modal-content"  action="../function/upload_desain.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id_upload" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Upload Desain Dan Sketsa Rumah</h5>
                    <button type="button" onclick="clearForm('formUpload')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukkan file dalam bentuk pdf</label>
                        <input type="file" name="pdf" class="form-control-file" id="exampleFormControlFile1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpload')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include './script.php';?>
  <script>
    getData()
    function getData(){
        $('#tables').DataTable();
        $('#tables1').DataTable();
    }

    function viewBukti(url){
        var url = '../assets/img/imageUpload/'+url;
        $('#img_bukti').attr("src", url)
    }
    function updateInformasi(id,status,pesan){
        $('#id').val(id);
        $('#proses').val(status);
        $('#inputKeterangan').val(pesan);
    }

    function viewInformasi(nama,nik,model,ukuran,kamar,kamar_mandi,alamat,no_telp,lantai,luas_bangunan,garasi,referensi,pesan,id){
        $('#nama').html(nama)
        $('#nik').html(nik)
        $('#type').html(model)
        $('#tanah').html(ukuran)
        $('#kamar').html(kamar)
        $('#kamar_mandi').html(kamar_mandi)
        $('#alamat').html(alamat)
        $('#no_telp').html(no_telp)
        $('#lantai').html(lantai)
        $('#bangunan').html(luas_bangunan)
        $('#garasi').html(garasi)
        $('#referensi').html(referensi)
        $('#pesan').html(pesan)
        $('#btn-cetak').attr("href", '../function/cetak_pesanan.php?id='+id)
    }

    function setIDForm(id){
        $('#id_upload').val(id)
    }
  
    function clearForm(data){
        $('#id_upload').val('')
      document.getElementById(data).reset();
    }
  
  </script>
</body>

</html>