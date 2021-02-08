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

             <!-- Basic Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                 </div>
                 <div class="card-body">
                     <form action="<?= site_url('Auth/change_password_operator') ?>" method="POST" autocomplete="on" enctype="multipart/form-data">
                         <input hidden type="text" class="form-control" id="password" name="password" value="<?= $password->password ?>">
                         <div class="form-group row">
                             <label for="nama" class="col-sm-2 col-form-label">Current Password:</label>
                             <div class="col-sm-10">
                                 <input type="password" class="form-control" id="current_password" name="current_password" value="<?= set_value('current_password'); ?>">
                                 <?= form_error('current_password', '<small class="text-danger">', '</small>') ?>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="nama" class="col-sm-2 col-form-label">New Password:</label>
                             <div class="col-sm-10">
                                 <input type="password" class="form-control" id="new_password" name="new_password" value="<?= set_value('new_password'); ?>">
                                 <?= form_error('new_password', '<small class="text-danger">', '</small>') ?>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="nama" class="col-sm-2 col-form-label">Retype Password:</label>
                             <div class="col-sm-10">
                                 <input type="password" class="form-control" id="retype_password" name="retype_password" value="<?= set_value('retype_password'); ?>">
                                 <?= form_error('retype_password', '<small class="text-danger">', '</small>') ?>
                             </div>
                         </div>
                         <button type="submit" name="simpan" href="<?= site_url('Auth/change_password_operator') ?>" class="btn btn-primary">
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