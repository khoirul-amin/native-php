<?php
    $style = 'style="background:#001970;"';
    include './library/session.php';
    include './library/info.php';
    $session = (new Session())->cek_session();
    $info = (new Info())->cek_info();
    (new Info())->info_remove();
    if(!$session){
        header('location:./login.php');
    }
    include "./template/header.php";
    include "./koneksi.php";
?>
<div class="row ml-0 mr-0">
    <div class="container mt-4 mb-4">
        <form class="" method="post" action="./function/action_pesan.php" id="formUpdateData">
        <div class="row ml-0 mr-0 pt-md-4 justify-content-md-center" style="color:#707070;">
            <div class="col-md-12 pb-3 text-center">
                <h4 style="font-weight:bold;">Form pemesanan</h4>
            </div>
            <div class="col-md-8 pb-3 pt-2 rounded shadow">
                <p class="text-center"><b>Identitas Pribadi</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Nama</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$session->nama;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Nomor Telepon</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$session->no_telp;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Email</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$session->email;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Alamat Lengkap</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$session->alamat;?>" placeholder="Nama">
                    </div>
                </div>

                <p class="text-center"><b>Ukuran Dan Luas Tanah</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Ukuran Tanah P X L</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="ukuran" placeholder="Ukuran">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Lantai</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="lantai" placeholder="Lantai">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Luas Bangunan M2</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="luas_bangunan" placeholder="Luas">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Model Bangunan</div>
                    <div class="col-lg-6 text-right p-0">
                        <div class="form-group">
                            <select class="form-control" name="model" id="exampleFormControlSelect1">
                                <?php 
                                $models = mysqli_query($koneksi, "SELECT * FROM posts WHERE jenis=2");
                                while($model = mysqli_fetch_array($models)){ ?>
                                <option value=<?=$model['id']?>><?=$model['judul'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <p class="text-center"><b>Desain dan Sketsa</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Kamar</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="kamar" placeholder="Jumlah Kamar">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Kamar Mandi</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="kamar_mandi" placeholder="Kamar mandi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Garasi</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="garasi" placeholder="Garasi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Referensi Desain</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="referensi" placeholder="Masukkan link halaman referensi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Pesan Tambahan</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="Tambahan" placeholder="Pesan Tambahan">
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-right mt-2">
                <button class="btn btn-pesan">Kirim</button>
            </div>
        </div>
        </form>
    </div>
</div>

<?php
    include "./template/footer.php";
?>
<script>
    $(document).ready(function() {
        if('<?=$info["status"]?>' != 'kosong'){
        if('<?=$info['status']?>' == 1){
            Swal.fire(
            'Berhasil',
            '<?=$info["messages"]?>',
            'success'
            )
        }else{
            Swal.fire(
            'Gagal',
            '<?=$info["messages"]?>',
            'error'
            )
        }
        }
    })
</script>