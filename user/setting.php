  <?php
    include '../library/session.php';
    include '../koneksi.php';
    $session = (new Session())->cek_session();
    if(!$session){
        header('location:../login.php');
    }
    $title = 'Data Profile';
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
            <h6 class="h2 d-inline-block mb-0">Profile Setting</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">

    <?php
        $query = "SELECT * FROM users WHERE id='$session->id'";      
        $result = mysqli_query($koneksi,$query);
        while($users = mysqli_fetch_array($result)){ 
            $avatar = "default.jpeg";
            if(!empty($users['avatar'])){
                $avatar = $users['avatar'];
            }
    ?>
    <div class="row">
      <div class="col-xl-3">
        <div class="card p-2">
            <h5>Poto Profile</h5>
            <img src="../assets/img/imageProfile/<?=$avatar?>" width="200" class="mb-2 ml-2" alt="user_img" id="user_img">
            <button type="button" 
						data-toggle='modal' data-target='#modalForm'
            class="btn btn-secondary" ><i class="far fa-save"></i> Upload</button> <br/>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card p-2">
            <h5>Personal information</h5><br>
            <div class="form-group row mb-3">
                <label for="inputNama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" value="<?=$users['nama']?>" class="form-control form-control-sm" id="inputNama">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputTglLahir" class="col-sm-2 col-form-label col-form-label-sm">Tgl Lahir</label>
                <div class="col-sm-10">
                    <input type="date" value="<?=$users['tgl_lahir']?>" name="tgl_lahir" class="form-control form-control-sm" id="inputTglLahir">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputAlamat" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" value="<?=$users['alamat']?>" name="alamat" class="form-control form-control-sm" id="inputAlamat">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputOldPassword" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                <div class="col-sm-10">
                    <input type="text" value="<?=$users['password']?>" name="old_password" placeholder="Password Lama" class="form-control form-control-sm" id="inputOldPassword">
                </div>
            </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="card p-2">
            <h5>Personal information</h5><br>
            <button onclick="save()" class="btn btn-secondary" ><i class="far fa-save"></i> Simpan Data</button> <br/>
            <button class="btn btn-secondary"><i class="far fa-times-circle"></i> Batalkan</button> <br/>
            <button onclick="logout()" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Logout</button><br><br><br>
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
            <form id="formUpdateData"  action="../function/setting_image.php" method="post" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="id" value="<?=$users['id']?>" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputGroupFile01">Image</label>
                        <div class="custom-file">
                            <input type="file" required name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
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


<?php }?>

<?php include './script.php';?>
  <script>

    function logout(){
      Swal.fire({
        title: 'Anda yakin?',
        text: "Apakah anda yakin mau LogOut ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
          window.location.href = "../logout.php";
        }
      })
    }

    function save(){
      const nama = $('#inputNama').val()
      const tgl_lahir = $('#inputTglLahir').val()
      const alamat = $('#inputAlamat').val()
      const new_password = $('#inputOldPassword').val()
      var dataJson = {
        nama : nama,
        tgl_lahir : tgl_lahir,
        alamat : alamat,
        password: new_password
      }
      $.ajax({
            url: "../function/update_users.php",
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            data: dataJson,
        }).done(function (data, textStatus, jqXHR){
          window.location.reload();
        }).fail(function (jqXHR, textStatus, errorThrown){
            Swal.fire(
                'Gagal!',
                errorThrown,
                'error'
            )
        })
    }

    function clearForm(data){
      document.getElementById(data).reset();
    }
  </script>
</body>

</html>