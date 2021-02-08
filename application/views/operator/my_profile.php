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

             <div class="card mb-3" style="max-width: 800px;">
                 <div class="row no-gutters">
                     <div class="col-md-4">
                         <img src="<?= base_url('assets/upload/avatar/'), $user_loged->file_gambar ?>" class="card-img">
                     </div>
                     <div class="col-md-8">
                         <div class="card-body">
                             <!-- <p class="card-text"> -->
                             <table class="table table-borderless">
                                 <tbody>
                                     <tr>
                                         <th scope="row">Nama</th>
                                         <td><?= $user_loged->nama; ?></td>
                                     </tr>
                                     <tr>
                                         <th scope="row">Username</th>
                                         <td><?= $user_loged->username; ?></td>
                                     </tr>
                                 </tbody>
                             </table>
                             <!-- </p> -->
                         </div>
                     </div>
                 </div>
             </div>

         </div>

     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->