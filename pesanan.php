<?php
    $style = 'style="background:#001970;"';
    include './library/session.php';
    $session = (new Session())->cek_session();
    if(!$session){
        header('location:./login.php');
    }
    $id_user = $session->id;
    include './koneksi.php';
    include "./template/header.php";
?>
<div class="row ml-0 mr-0" style="background:#DDE3F5;height:500px">
    <div class="container mt-4 mb-4">
        <div class="row ml-0 mr-0 pt-md-4 mb-md-4 rounded shadow justify-content-md-center bg-light" style="color:#707070;">
            <div class="col-md-12 pb-3 text-center">
                <h4 style="font-weight:bold;">Keranjang</h4>
            </div>
            <div class="col-md-12 pb-3 pt-2">
                <!-- <p class=""><b>Pesanan Berhasil</b></p> -->
                <div class="row ml-0 mr-0">
                    <div class="col text-center"><b>Order</b></div>
                    <div class="col text-center"><b>Produk</b></div>
                    <div class="col text-center"><b>Status</b></div>
                    <div class="col text-center"><b>Action</b></div>
                </div>
                <?php 
                    $res = mysqli_query($koneksi,"SELECT * FROM v_pemesanan WHERE user_id=$id_user");
                    while($pesanan = mysqli_fetch_array($res)){ ?>
                    <div class="row ml-0 mr-0 mt-2">
                        <div class="col"><?=$pesanan['invoice']?></div>
                        <div class="col"><?=$pesanan['model']?></div>
                        <div class="col">
                            <?php
                                if($pesanan['status'] == 1){
                                    echo "Waiting";
                                }elseif($pesanan['status'] == 2){
                                    echo "Sedang Diproses";
                                }elseif($pesanan['status'] == 3){
                                    echo "Gagal";
                                }elseif($pesanan['status'] == 4){
                                    echo "Menunggu Pembayaran";
                                }elseif($pesanan['status'] == 5){
                                    echo "Selesai";
                                }
                            ?>
                        </div>
                        <div class="col">
                            <?php
                                if($pesanan['status'] != 3){
                                    $id = $pesanan['id'];
                                        echo  "
                                        <a href='user/pesanan.php' class='btn btn-sm btn-outline-primary'>Lihat RAB</a>
                                        <button data-toggle='modal' onClick='setID(`$id`)' data-target='#modalForm' class='btn btn-sm btn-outline-primary'>Bayar</button>";
                                }else {
                                    echo "<br><br>";
                                }
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <hr>
            </div>
            <!-- <div class="col-md-12 pb-3 pt-2">
                <p class=""><b>Pesanan Menunggu</b></p>
                <div class="row ml-0 mr-0">
                    <div class="col text-center"><b>Order</b></div>
                    <div class="col text-center"><b>Produk</b></div>
                    <div class="col text-center"><b>Status</b></div>
                    <div class="col text-center"><b>Action</b></div>
                </div>
                <div class="row ml-0 mr-0 mt-2">
                    <div class="col">Order</div>
                    <div class="col">Produk</div>
                    <div class="col">Status</div>
                    <div class="col">
                        <button data-toggle='modal' data-target='#modalForm' class="btn btn-sm btn-outline-primary">Lihat Detail</button>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-12 pb-3 pt-2">
                <p class=""><b>Pesanan Gagal</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="col text-center"><b>Order</b></div>
                    <div class="col text-center"><b>Produk</b></div>
                    <div class="col text-center"><b>Status</b></div>
                    <div class="col text-center"><b>Action</b></div>
                </div>
                <div class="row ml-0 mr-0 mt-2">
                    <div class="col">Order</div>
                    <div class="col">Produk</div>
                    <div class="col">Status</div>
                    <div class="col">
                        <button data-toggle='modal' data-target='#modalForm' class="btn btn-sm btn-outline-primary">Lihat Detail</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpdateData" class="modal-content" action="./function/upload_bukti.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Pembayaran</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span><b>Bank Transfer Manual</b></span><br>
                    <span>Pembayaran menggunakan bank transfer tanpa virtual account dapat dilakukan dengan transfer ke: <br> <br> <b>Bank Mandiri Nama Pemilik Rekening</b>  : PT. Kontruksi Indo Perkasa <br> <b>Nomor Rekening</b>  : 155-000-4463-793 <br> <b>Cabang</b>  : Cikokol-Tangerang, Indonesia <br><br> Setelah melakukan transfer, mohon melakukan <b>upload slip pembayaran</b> dan konfirmasi dinomor Telepon +6281 7268 8373 pembayaran agar pesanan anda dapat diproses melalui halaman konfirmasi pembayaran</span> <br> <br>


                    <div class="form-group">
                        <label for="inputGroupFile01">Upload Slip Pembayaran Di sini</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpdateData')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

<?php
    include "./template/footer.php";
?>
<script>

function setID(id){
    $('#id').val(id)
}

function clearForm(data){
    $('#id').val('')
    document.getElementById(data).reset();
}

$('#inputGroupFile01').on('change',function(){
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})

</script>