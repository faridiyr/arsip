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
                             <th style="text-align: center;">Nama</th>
                             <th style="text-align: center;">Jenis Kelamin</th>
                             <th style="text-align: center;">Umur</th>
                             <th style="text-align: center;">NIK</th>
                             <th style="text-align: center;">Suku</th>
                             <th style="text-align: center;">Alamat</th>
                             <th style="text-align: center;">Ibu</th>
                             <th style="text-align: center;">Ayah</th>
                             <th style="text-align: center;">Keterangan</th>
                             <th style="width:300px; text-align: center;">Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 0;
                            foreach ($surat_keterangan_kematian as $item) {
                                $date = $item['tanggal'];
                                $dateformat_database = date("d M Y", strtotime($date));
                                $no++;
                            ?>
                             <tr>
                                 <td style="text-align: center;"><?= $no ?></td>
                                 <td><?= $item['nomor'] ?></td>
                                 <td><?= $dateformat_database ?></td>
                                 <td><?= $item['nama'] ?></td>
                                 <td><?= $item['jenis_kelamin'] ?></td>
                                 <td><?= $item['umur'] ?> th</td>
                                 <td><?= $item['nik'] ?></td>
                                 <td><?= $item['suku'] ?></td>
                                 <td><?= $item['alamat'] ?></td>
                                 <td><?= $item['nama_ibu'] ?></td>
                                 <td><?= $item['nama_ayah'] ?></td>
                                 <td><?= $item['keterangan'] ?></td>
                                 <td style="text-align: center;">
                                     <!-- Tombol File -->
                                     <a href="<?= base_url('assets/upload/surat_keterangan_kematian/' . $item['file']) ?>" class="btn btn-warning btn-sm">
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
 <!--Modal dialog box for edit surat-->
 <?php foreach ($surat_keterangan_kematian as $item) { ?>
     <div class="modal modal-primary fade" id="modal-edit-surat<?= $item['id']; ?>">
         <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Edit Data</h4>
                     <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form role="form" enctype="multipart/form-data" action="<?= site_url('Surat_Keterangan_Kematian/edit_surat'); ?>" method="POST">
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
                             <label for="nama" class="col-form-label">Nama:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama" name="nama" value="<?= $item['nama'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin:</label>
                             <small style="color: red;">* Wajib diisi</small>
                             <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                 <?php if ($item['jenis_kelamin'] == "Laki-laki") { ?>
                                     <option value="Laki-laki" selected>Laki-laki</option>
                                     <option value="Perempuan">Perempuan</option>
                                 <?php } elseif ($item['jenis_kelamin'] == "Perempuan") { ?>
                                     <option value="Laki-laki">Laki-laki</option>
                                     <option value="Perempuan" selected>Perempuan</option>
                                 <?php  } ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="umur" class="col-form-label">Umur:</label>
                             <small style="color: red;">* Wajib diisi</small>
                             <input type="number" class="form-control" id="umur" name="umur" value="<?= $item['umur'] ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="nik" class="col-form-label">NIK:</label>
                             <small style="color: red;">* Wajib diisi, 16 karakter, berupa angka, jika kosong isi 0000000000000000</small>
                             <input type="number" class="form-control" id="nik" name="nik" value="<?= $item['nik'] ?>" minlength="16" maxlength="16" required>
                         </div>
                         <div class="form-group">
                             <label for="suku" class="col-form-label">Suku:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="suku" name="suku" value="<?= $item['suku'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="alamat" class="col-form-label">Alamat:</label>
                             <small style="color: red;">* Wajib diisi, Maks 100 karakter (termasuk <strong>space</strong>)</small>
                             <textarea class="form-control" name="alamat" id="alamat" rows="3" maxlength="100"><?= $item['alamat'] ?></textarea>
                         </div>
                         <div class="form-group">
                             <label for="nama_ibu" class="col-form-label">Nama Ibu:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $item['nama_ibu'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="nama_ayah" class="col-form-label">Nama Ayah:</label>
                             <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                             <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $item['nama_ayah'] ?>" maxlength="50" required>
                         </div>
                         <div class="form-group">
                             <label for="keterangan" class="col-form-label">Keterangan:</label>
                             <small style="color: red;">* Wajib diisi, Maks 250 karakter (termasuk <strong>space</strong>)</small>
                             <textarea class="form-control" name="keterangan" id="keterangan" rows="3" maxlength="250"><?= $item['keterangan'] ?></textarea>
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
                 <form role="form" enctype="multipart/form-data" action="<?= site_url('Surat_Keterangan_Kematian/tambah_surat'); ?>" method="POST">
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
                         <label for="nama" class="col-form-label">Nama:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama" name="nama" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin:</label>
                         <small style="color: red;">* Wajib diisi</small>
                         <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                             <option value="Laki-laki" selected>Laki-laki</option>
                             <option value="Perempuan">Perempuan</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="umur" class="col-form-label">Umur:</label>
                         <small style="color: red;">* Wajib diisi</small>
                         <input type="number" class="form-control" id="umur" name="umur" required>
                     </div>
                     <div class="form-group">
                         <label for="nik" class="col-form-label">NIK:</label>
                         <small style="color: red;">* Wajib diisi, 16 karakter, berupa angka, jika kosong isi 0000000000000000</small>
                         <input type="number" class="form-control" id="nik" name="nik" required>
                     </div>
                     <div class="form-group">
                         <label for="suku" class="col-form-label">Suku:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="suku" name="suku" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="alamat" class="col-form-label">Alamat:</label>
                         <small style="color: red;">* Wajib diisi, Maks 100 karakter (termasuk <strong>space</strong>)</small>
                         <textarea class="form-control" name="alamat" id="alamat" rows="3" maxlength="100"></textarea>
                     </div>
                     <div class="form-group">
                         <label for="nama_ibu" class="col-form-label">Nama Ibu:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="nama_ayah" class="col-form-label">Nama Ayah:</label>
                         <small style="color: red;">* Wajib diisi, Maks 50 karakter (termasuk <strong>space</strong>)</small>
                         <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" maxlength="50" required>
                     </div>
                     <div class="form-group">
                         <label for="keterangan" class="col-form-label">Keterangan:</label>
                         <small style="color: red;">* Wajib diisi, Maks 250 karakter (termasuk <strong>space</strong>)</small>
                         <textarea class="form-control" name="keterangan" id="keterangan" rows="3" maxlength="250"></textarea>
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

 <script type="text/javascript">
     function delete_repositori_ajax(id) {
         if (confirm("Anda yakin ingin menghapus data ini ?")) {
             ;
             $.ajax({
                 url: 'Surat_Keterangan_Kematian/delete_surat',
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