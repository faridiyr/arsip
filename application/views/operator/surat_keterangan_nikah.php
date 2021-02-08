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

             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah-surat">
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
                             <th style="text-align: center;">No</th>
                             <th style="text-align: center;">Nomor Surat</th>
                             <th style="text-align: center;">Tanggal</th>
                             <th style="text-align: center;">Nama Suami</th>
                             <th style="text-align: center;">Tempat Lahir Suami</th>
                             <th style="text-align: center;">Tanggal Lahir Suami</th>
                             <th style="text-align: center;">Suku Suami</th>
                             <th style="text-align: center;">Pekerjaan Suami</th>
                             <th style="text-align: center;">Nama Ortu Suami</th>
                             <th style="text-align: center;">Alamat Suami</th>
                             <th style="text-align: center;">Nama Istri</th>
                             <th style="text-align: center;">Tempat Lahir Istri</th>
                             <th style="text-align: center;">Tanggal Lahir Istri</th>
                             <th style="text-align: center;">Suku Istri</th>
                             <th style="text-align: center;">Pekerjaan Istri</th>
                             <th style="text-align: center;">Nama Ortu istri</th>
                             <th style="text-align: center;">Alamat Istri</th>
                             <th style="width:200px; text-align: center;">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 0;
                            foreach ($surat_keterangan_nikah as $item) {
                                $date = $item['tanggal'];
                                $dateformat_database = date("d M Y", strtotime($date));
                                $date_suami = $item['tanggal_lahir_suami'];
                                $dateformat_database_suami = date("d M Y", strtotime($date_suami));
                                $date_istri = $item['tanggal_lahir_istri'];
                                $dateformat_database_istri = date("d M Y", strtotime($date_istri));
                                $no++;
                            ?>
                             <tr>
                                 <td style="text-align: center;"><?= $no ?></td>
                                 <td><?= $item['nomor'] ?></td>
                                 <td><?= $dateformat_database ?></td>
                                 <td><?= $item['nama_suami'] ?></td>
                                 <td><?= $item['tempat_lahir_suami'] ?></td>
                                 <td><?= $dateformat_database_suami ?></td>
                                 <td><?= $item['suku_suami'] ?></td>
                                 <td><?= $item['pekerjaan_suami'] ?></td>
                                 <td><?= $item['nama_ortu_suami'] ?></td>
                                 <td><?= $item['alamat_suami'] ?></td>
                                 <td><?= $item['nama_istri'] ?></td>
                                 <td><?= $item['tempat_lahir_istri'] ?></td>
                                 <td><?= $dateformat_database_istri ?></td>
                                 <td><?= $item['suku_istri'] ?></td>
                                 <td><?= $item['pekerjaan_istri'] ?></td>
                                 <td><?= $item['nama_ortu_istri'] ?></td>
                                 <td><?= $item['alamat_istri'] ?></td>
                                 <td style="text-align: center;">
                                     <!-- Tombol File -->
                                     <a href="<?= base_url('assets/upload/surat_keterangan_nikah/' . $item['file']) ?>" class="btn btn-warning btn-sm">
                                         <span btn-icon-left>
                                             <i class="fa fa-file-download"></i>
                                         </span>
                                         File</a>
                                     &emsp;
                                     <!-- Tombol Edit -->
                                     <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit-surat<?= $item['id'] ?>">
                                         <span btn-icon-left>
                                             <i class="fa fa-edit"></i>
                                         </span>
                                         Edit</button>
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
 <!--Modal dialog box for edit surat-->
 <?php foreach ($surat_keterangan_nikah as $item) { ?>
     <div class="modal modal-primary fade" id="modal-edit-surat<?= $item['id']; ?>">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Edit Data</h4>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form role="form" enctype="multipart/form-data" action="<?= site_url('Operator_Surat_Keterangan_Nikah/edit_surat'); ?>" method="POST">
                         <input hidden type="text" class="form-control" id="id" name="id" value="<?= $item['id']; ?>" required>
                         <div class="form-group">
                             <label for="nomor" class="col-form-label">Nomor Surat :</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nomor" name="nomor" maxlength="50" value="<?= $item['nomor']; ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="tanggal" class="col-form-label">Tanggal:</label>
                             <small style="color: red;">* Wajib diisi</small>
                             <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $item['tanggal'] ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="nama_suami" class="col-form-label">Nama Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_suami" name="nama_suami" value="<?= $item['nama_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="tempat_lahir_suami" class="col-form-label">Tempat Lahir Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="tempat_lahir_suami" name="tempat_lahir_suami" value="<?= $item['tempat_lahir_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="tanggal_lahir_suami" class="col-form-label">Tanggal Lahir Suami:</label>
                             <small style="color: red;">* Wajib diisi</small>
                             <input type="date" class="form-control" id="tanggal_lahir_suami" name="tanggal_lahir_suami" value="<?= $item['tanggal_lahir_suami'] ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="suku_suami" class="col-form-label">Suku Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="suku_suami" name="suku_suami" value="<?= $item['suku_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="pekerjaan_suami" class="col-form-label">Pekerjaan Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="pekerjaan_suami" name="pekerjaan_suami" value="<?= $item['pekerjaan_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="nama_ortu_suami" class="col-form-label">Nama Ortu Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_ortu_suami" name="nama_ortu_suami" value="<?= $item['nama_ortu_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="alamat_suami" class="col-form-label">Alamat Suami:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="alamat_suami" name="alamat_suami" value="<?= $item['alamat_suami'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="nama_istri" class="col-form-label">Nama Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_istri" name="nama_istri" value="<?= $item['nama_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="tempat_lahir_istri" class="col-form-label">Tempat Lahir Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="tempat_lahir_istri" name="tempat_lahir_istri" value="<?= $item['tempat_lahir_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="tanggal_lahir_istri" class="col-form-label">Tanggal Lahir Istri:</label>
                             <small style="color: red;">* Wajib diisi</small>
                             <input type="date" class="form-control" id="tanggal_lahir_istri" name="tanggal_lahir_istri" value="<?= $item['tanggal_lahir_istri'] ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="suku_istri" class="col-form-label">Suku Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="suku_istri" name="suku_istri" value="<?= $item['suku_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="pekerjaan_istri" class="col-form-label">Pekerjaan Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="pekerjaan_istri" name="pekerjaan_istri" value="<?= $item['pekerjaan_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="nama_ortu_istri" class="col-form-label">Nama Ortu Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_ortu_istri" name="nama_ortu_istri" value="<?= $item['nama_ortu_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="alamat_istri" class="col-form-label">Alamat Istri:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="alamat_istri" name="alamat_istri" value="<?= $item['alamat_istri'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="file" class="col-form-label">File:</label>
                             <small style="color: red;">* Wajib diisi, Maks 2Mb, Jenis File (<strong>.pdf .doc .docx .xls .xlsx .png .jpg .jpeg</strong>)</small>
                             <input readonly class="form-control-plaintext" type="text" id="file_lama" name="file_lama" value="<?= $item['file'] ?>" required>
                             <input type="file" id="file" name="file_baru" id="file_baru">
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

 <!--Modal dialog box for tambah surat-->
 <div class="modal modal-primary fade" id="modal-tambah-surat">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Tambah Data</h4>
                 <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form role="form" enctype="multipart/form-data" action="<?= site_url('Operator_Surat_Keterangan_Nikah/tambah_surat'); ?>" method="POST">
                     <div class="form-group">
                         <label for="nomor" class="col-form-label">Nomor Surat :</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nomor" name="nomor" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="tanggal" class="col-form-label">Tanggal:</label>
                         <small style="color: red;">* Wajib diisi</small>
                         <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                     </div>
                     <div class="form-group">
                         <label for="nama_suami" class="col-form-label">Nama Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_suami" name="nama_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="tempat_lahir_suami" class="col-form-label">Tempat Lahir Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="tempat_lahir_suami" name="tempat_lahir_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="tanggal_lahir_suami" class="col-form-label">Tanggal Lahir Suami:</label>
                         <small style="color: red;">* Wajib diisi</small>
                         <input type="date" class="form-control" id="tanggal_lahir_suami" name="tanggal_lahir_suami" required>
                     </div>
                     <div class="form-group">
                         <label for="suku_suami" class="col-form-label">Suku Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="suku_suami" name="suku_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="pekerjaan_suami" class="col-form-label">Pekerjaan Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="pekerjaan_suami" name="pekerjaan_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="nama_ortu_suami" class="col-form-label">Nama Ortu Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_ortu_suami" name="nama_ortu_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="alamat_suami" class="col-form-label">Alamat Suami:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="alamat_suami" name="alamat_suami" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="nama_istri" class="col-form-label">Nama Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_istri" name="nama_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="tempat_lahir_istri" class="col-form-label">Tempat Lahir Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="tempat_lahir_istri" name="tempat_lahir_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="tanggal_lahir_istri" class="col-form-label">Tanggal Lahir Istri:</label>
                         <small style="color: red;">* Wajib diisi</small>
                         <input type="date" class="form-control" id="tanggal_lahir_istri" name="tanggal_lahir_istri" required>
                     </div>
                     <div class="form-group">
                         <label for="suku_istri" class="col-form-label">Suku Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="suku_istri" name="suku_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="pekerjaan_istri" class="col-form-label">Pekerjaan Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="pekerjaan_istri" name="pekerjaan_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="nama_ortu_istri" class="col-form-label">Nama Ortu Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_ortu_istri" name="nama_ortu_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="alamat_istri" class="col-form-label">Alamat Istri:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="alamat_istri" name="alamat_istri" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="file" class="col-form-label">File:</label>
                         <small style="color: red;">* Wajib diisi, Maks 2Mb, Jenis File (<strong>.pdf .doc .docx .xls .xlsx .png .jpg .jpeg</strong>)</small>
                         <input type="file" id="file" name="file" required>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" value="1" name="tambah" class="btn btn-primary">Tambah Data</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>