 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item">
                 <a href="<?= site_url('Dashboard_Admin') ?>">
                     <i class="fas fa-fw fa-tachometer-alt"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
         </ol>
     </nav>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
         </div>
         <div class="card-body">

             <?php if ($this->session->flashdata('notification_berhasil') != '') { ?>
                 <div class="alert alert-success alert-dismissable">
                     <i class="glyphicon glyphicon-ok"></i>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <?php echo $this->session->flashdata('notification_berhasil'); ?>
                 </div>
             <?php } else if ($this->session->flashdata('notification_gagal') != '') { ?>
                 <div class="alert alert-danger alert-dismissable">
                     <i class="glyphicon glyphicon-ok"></i>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <?php echo $this->session->flashdata('notification_gagal'); ?>
                 </div>
             <?php } ?>

             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-operator">
                 <span btn-icon-left>
                     <i class="fa fa-plus"></i> Tambah Data
                 </span>
             </button>
             <br>
             <br>

             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th style="width: 100px; text-align: center;">No</th>
                             <th style="width: 500px; text-align: center;">Nama</th>
                             <th style="width: 500px; text-align: center;">Username</th>
                             <th style="text-align: center;">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 0;
                            foreach ($operator as $item) {
                                $no++;
                            ?>
                             <tr>
                                 <td style="text-align: center;"><?= $no ?></td>
                                 <td><?= $item['nama'] ?></td>
                                 <td><?= $item['username'] ?></td>
                                 <td style="text-align: center;">
                                     <!-- Tombol Edit -->
                                     <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-operator<?= $item['id'] ?>">
                                         <span btn-icon-left>
                                             <i class="fa fa-edit"></i>
                                         </span>
                                         Edit</button>
                                     &emsp;
                                     <!-- Tombol Reset Password -->
                                     <button onclick="reset_repositori_ajax(<?= $item['id'] ?>)" type="submit" class="btn btn-warning btn-sm">
                                         <span btn-icon-left>
                                             <i class="fa fa-key"></i>
                                         </span>
                                         Reset Password</button>
                                     &emsp;
                                     <!-- Tombol Hapus -->
                                     <button onclick="delete_repositori_ajax(<?= $item['id'] ?>)" type="submit" class="btn btn-danger btn-sm">
                                         <span btn-icon-left>
                                             <i class="fa fa-trash"></i>
                                         </span>
                                         Hapus</button>
                                 </td>
                             </tr>
                         <?php
                            }
                            ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <!-- MODAL -->
 <!--Modal dialog box for edit operator-->
 <?php foreach ($operator as $item) { ?>
     <div class="modal modal-primary fade" id="modal-edit-operator<?= $item['id']; ?>">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Edit Operator</h4>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form role="form" enctype="multipart/form-data" action="<?= site_url('Operator/edit_operator'); ?>" method="POST">
                         <input hidden type="text" class="form-control" id="id" name="id" value="<?= $item['id'] ?>" required>
                         <div class="form-group">
                             <label for="name" class="col-form-label">Nama :</label>
                             <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="name" name="name" value="<?= $item['nama'] ?>" minlength="4" maxlength="100" required>
                             <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                         </div>
                         <div class="form-group">
                             <label for="username" class="col-form-label">Username:</label>
                             <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>), bersifat <strong>unik</strong></small>
                             <input type="text" class="form-control" id="username" name="username" value="<?= $item['username'] ?>" minlength="4" maxlength="100" required>
                         </div>
                         <div class="modal-footer">
                             <button type="submit" value="1" name="simpan" class="btn btn-primary">Simpan</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>

 <!--Modal dialog box for tambah penulis-->
 <div class="modal modal-primary fade" id="modal-tambah-operator">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Tambah Operator</h4>
                 <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form role="form" enctype="multipart/form-data" action="<?= site_url('Operator/tambah_operator'); ?>" method="POST">
                     <div class="form-group">
                         <label for="name" class="col-form-label">Nama :</label>
                         <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="name" name="name" minlength="4" maxlength="100" required>
                         <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                     </div>
                     <div class="form-group">
                         <label for="username" class="col-form-label">Username:</label>
                         <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>), bersifat <strong>unik</strong></small>
                         <input type="text" class="form-control" id="username" name="username" minlength="4" maxlength="100" required>
                     </div>
                     <div class="form-group">
                         <label for="nama" class="col-form-label">Password Default:</label>
                         <small style="color: red;">* password awal</small>
                         <input type="text" readonly class="form-control-plaintext" id="password" name="password" value="operator">
                     </div>
                     <div class="modal-footer">
                         <button type="submit" value="1" name="tambah" class="btn btn-primary">Tambah Data</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script type="text/javascript">
     function delete_repositori_ajax(id) {
         if (confirm("Anda yakin ingin menghapus data ini ?")) {
             ;
             $.ajax({
                 url: 'Operator/delete_operator',
                 type: 'POST',
                 data: {
                     id: id
                 },
                 success: function() {
                     alert('Delete data berhasil');
                     location.reload();
                 },
                 error: function() {
                     alert('Delete data gagal');
                 }
             });
         }
     }
 </script>

 <script type="text/javascript">
     function reset_repositori_ajax(id) {
         if (confirm("Anda yakin ingin mereset password menjadi 'operator' ?")) {
             ;
             $.ajax({
                 url: 'Operator/reset_password',
                 type: 'POST',
                 data: {
                     id: id
                 },
                 success: function() {
                     alert('Reset data berhasil');
                     location.reload();
                 },
                 error: function() {
                     alert('Reset data gagal');
                 }
             });
         }
     }
 </script>