

<?php
    include '../library/session.php';
    include '../koneksi.php';
    include '../library/info.php';
    $session = (new Session())->cek_session();
    $info = (new Info())->cek_info();
    (new Info())->info_remove();
    if(!$session){
        header('location:../login.php');
    }
    $title = 'Data Kategori';
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
            <h6 class="h2 d-inline-block mb-0">Kategori</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
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
                  <th scope="col">No</th>
                  <th scope="col">ID Kategori</th>
                  <th scope="col">Jenis RAB/Pekerjaan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $query = "SELECT * FROM kategori";      
                $result = mysqli_query($koneksi,$query);
                $no = 0;
                while($kategori = mysqli_fetch_array($result)){ 
                $no++;
            ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?=$kategori['id'];?></td>
                    <td><?=$kategori['nama_kategori'];?></td>
                    <td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick='updateInformasi(<?=json_encode($kategori)?>)'
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick="hapusData(<?=$kategori['id']?>)"
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
            <form id="formUpdateData" action="../function/tambah_kategori.php" method="post" class="modal-content">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="..." required>
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

</div>

<?php include './script.php';?>

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
          
          window.location.href = `../function/hapus_kategori.php?id=${id}`;
          // $.ajax({
          //     type: "GET",
          //     url: `../function/hapus_kategori.php?id=${id}`,
          //     cache: false,
          //     success: function(data){
          //       window.location.reload();
          //     }
          // })
        }
      })
    }

    function updateInformasi(data){
        $('#id').val(data.id)
        $('#inputNama').val(data.nama_kategori)
    }

    function clearForm(data){
      $('#id').val('')
      document.getElementById(data).reset();
    }
</script>