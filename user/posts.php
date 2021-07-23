
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
    $title = 'Data Posts';
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
            <h6 class="h2 d-inline-block mb-0">Posts</h6>
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
                  <th scope="col">Jenis Posts</th>
                  <th scope="col">Judul Posts</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $query = "SELECT * FROM posts";      
                $result = mysqli_query($koneksi,$query);
                $no = 0;
                while($posts = mysqli_fetch_array($result)){ 
                $no++;
            ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><?php
                        if($posts['jenis'] == 1){
                            echo "Portofolio";
                        }else{
                            echo "Model Bangunan";
                        }
                    ?></td>
                    <td><?=$posts['judul'];?></td>
                    <td><?=substr($posts['isi'], 0, 50);?></td>
                    <td>
						<button type='button' class='btn btn-primary btn-sm'
						onclick="updateInformasi('<?=$posts['id']?>','<?=$posts['judul']?>',`<?=$posts['isi']?>`,'<?=$posts['jenis']?>',)"
						data-toggle='modal' data-target='#modalForm'
						><i class='fas fa-pencil-alt'></i></button>

						<button type='button' class='btn btn-danger btn-sm'
						onclick="hapusData(<?=$posts['id']?>)"
						><i class='fas fa-trash'></i></button>

						<button type='button' class='btn btn-success btn-sm'
						data-toggle='modal' data-target='#modalView'
						onclick="viewInformasi('<?=$posts['judul']?>','<?=$posts['image']?>',`<?=$posts['isi']?>`)"
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
    <!-- Footer -->
    
  <?php
    include './footer.php';
  ?>
  </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <form id="formUpdateData" class="modal-content" action="../function/posts.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama">Judul Konstruksi (Jika mau menambah type rumah maka isi dengan type.)</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputGroupFile01">Image</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Post</label>
                        <select name="jenis" class="form-control" id="jenis">
                            <option value=1>Portofolio</option>
                            <option value=2>Model Bangunan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputIsi">Deskripsi post</label>
                        <input type="text" name="isi" class="form-control" id="inputIsi" placeholder="..." required>
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
                    <h5 class="modal-title" id="modalFormLabel">View Post</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Judul</b>
                        </div>
                        <div class="col-lg-8">
                            <span id="judul"></span>
                        </div>
                    </div><br>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Images</b>
                        </div>
                        <div class="col-lg-8">
                            <img src="" width="300px" id="gambar" alt="image">
                        </div>
                    </div><br>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Deskripsi</b>
                        </div>
                        <div class="col-lg-8">
                            <p style="text-align:justify;" id="desk"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './script.php';?>
  <script>
    // $(document).ready( function () {
    //   $('#tables').DataTable();
    // });
    
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

    function updateInformasi(id,judul,isi,jenis){
        $('#id').val(id);
        $('#inputNama').val(judul);
        $('#inputIsi').val(isi);
        $('#jenis').val(jenis);
    }
    
    function viewInformasi(judul,image,isi){
        $('#judul').html(judul)
        $('#gambar').attr("src", '../assets/img/imageUpload/'+image)
        $('#desk').html(isi)
    }

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
          window.location.href = `../function/hapus_posts.php?id=${id}`;
          // $.ajax({
          //     type: "GET",
          //     url: `../function/hapus_posts.php?id=${id}`,
          //     cache: false,
          //     success: function(data){
          //       window.location.reload();
          //     }
          // })
        }
      })
    }
  
    function clearForm(data){
      $('#id').val('')
      document.getElementById(data).reset();
    }
  </script>
</body>

</html>