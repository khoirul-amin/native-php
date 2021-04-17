

<?php
    include '../library/session.php';
    include '../koneksi.php';
    $session = (new Session())->cek_session();
    if(!$session){
        header('location:../login.php');
    }
    $title = 'Data Karyawan';
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
            <h6 class="h2 d-inline-block mb-0">Karyawan</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <?php if($_GET['pesan'] == 'success'){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Register berhasil !</strong> Silahkan login elalui halaman login.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } 
    else if($_GET['pesan'] == 'password'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Register gagal !</strong> Password tidak sama.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php }
    else if(!empty($_GET['pesan']) && $_GET['pesan'] != 'success'){ ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Register gagal !</strong> Input <?=$_GET['pesan']?> yang anda masukkan sudah terdaftar.
        <button type="button" class="close btn" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-xl-12">
          <button type="button" class="btn btn-success mb-2"
          data-toggle='modal' data-target='#modalForm'>
            <i class="fas fa-plus"></i> Tambah
          </button>
        <div class="card p-2">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tables" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Tgl Lahir</th>
                  <th scope="col">No. KTP</th>
                  <th scope="col">No. Telpon</th>
                  <th scope="col">Email</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $query = "SELECT * FROM users WHERE role=2";      
                $result = mysqli_query($koneksi,$query);
                while($pelanggan = mysqli_fetch_array($result)){?>
                <tr>
                    <td><?=$pelanggan['nama'];?></td>
                    <td><?=$pelanggan['tgl_lahir'];?></td>
                    <td><?=$pelanggan['nik'];?></td>
                    <td><?=$pelanggan['no_telp'];?></td>
                    <td><?=$pelanggan['email'];?></td>
                    <td><?=$pelanggan['alamat'];?></td>
                    <td><?=$pelanggan['username'];?></td>
                    <td><?=$pelanggan['password'];?></td>
                    <td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick='updateInformasi(<?=json_encode($pelanggan)?>)'
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick="hapusData(<?=$pelanggan['id']?>)"
						><i class='fas fa-trash'></i></button>
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
            <form id="formUpdateData" method="post" action="../function/tambah_karyawan.php" class="modal-content">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputLahir">Tgl. Lahir</label>
                        <input type="date" name="lahir" class="form-control" id="inputLahir" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputNIK">No. KTP</label>
                        <input type="text" name="NIK" class="form-control" id="inputNIK" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputNoTelp">No. Telpon</label>
                        <input type="text" name="no_telp" class="form-control" id="inputNoTelp" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="inputAlamat" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="text" name="password" class="form-control" id="inputPassword" placeholder="..." required>
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

<script>
    // $(document).ready( function () {
    //   $('#tables').DataTable();
    // }); 
    $('#tables').DataTable();

    function hapusData(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
              type: "GET",
              url: `../function/hapus_user.php?id=${id}`,
              cache: false,
              success: function(data){
                window.location.reload();
              }
          })
        }
      })
    }
    function updateInformasi(data){
      $('#id').val(data.id)
      $('#inputNama').val(data.nama)
      $('#inputLahir').val(data.tgl_lahir)
      $('#inputNIK').val(data.NIK)
      $('#inputUsername').val(data.username)
      $('#inputEmail').val(data.email)
      $('#inputPassword').val(data.password)
      $('#inputAlamat').val(data.alamat)
      $('#inputNoTelp').val(data.no_telp)
    }
    function clearForm(data){
      $('#id').val('')
      document.getElementById(data).reset();
    }
</script>