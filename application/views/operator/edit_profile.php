 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item">
                 <a href="<?= site_url('Dashboard_Operator') ?>">
                     <i class="fas fa-fw fa-tachometer-alt"></i>
                     <span>Dashboard</span>
                 </a>
             </li>
             <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
         </ol>
     </nav>

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

     <div class="row">

         <div class="col-lg-8">

             <div class="card shadow mb-4" style="max-width: 1200px;">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                 </div>
                 <div class="card-body">
                     <form action="<?= site_url('Operator_Profile/edit_profile') ?>" method="POST" autocomplete="on" enctype="multipart/form-data">
                         <div class="form-group row">
                             <div class="col-sm-2">
                                 <label for="nama" class="col-form-label">Nama:</label>
                                 <br>
                                 <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>)</small>
                             </div>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control" id="name" name="name" value="<?= $user_loged->nama ?>" maxlength="100" minlength="4" required>
                             </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-sm-2">
                                 <label for="staticEmail" class="col-form-label">Username:</label>
                                 <br>
                                 <small style="color: red;">* 4 - 100 karakter (termasuk <strong>space</strong>), bersifat <strong>unik</strong></small>
                             </div>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control" id="username" name="username" value="<?= $user_loged->username ?>" maxlength="100" minlength="4" required>
                             </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-sm-2">
                                 <label for="gambar" class="col-form-label">File Gambar Lama:</label>
                             </div>
                             <div class="col-sm-10">
                                 <img src="<?= base_url('assets/upload/avatar/'), $user_loged->file_gambar ?>" style="max-width: 200px; max-height: 200px">
                                 <input type="text" readonly class="form-control-plaintext" id="file_gambar_lama" name="file_gambar_lama" value="<?= $user_loged->file_gambar ?>">
                             </div>
                         </div>
                         <div class="form-group row">
                             <div class="col-sm-2 ">
                                 <label for="gambar" class="col-form-label">File Gambar Baru:</label>
                                 <small style="color: red;">* Maks 2Mb, Jenis File (<strong>.png .jpg .jpeg</strong>)</small>
                             </div>
                             <div class="col-sm-10">
                                 <input type="file" class="form-control-file" id="file_gambar_baru" name="file_gambar_baru">
                             </div>
                         </div>
                         <button type="submit" name="simpan" href="<?= site_url('Operator_Profile/edit_profile') ?>" class="btn btn-primary">
                             Simpan
                         </button>
                     </form>
                 </div>
             </div>




         </div>

     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->