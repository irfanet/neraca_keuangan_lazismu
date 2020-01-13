<?php
$title = "Mustahik";
$url = base_url() . 'mustahik/';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data <?= $title ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?= $title ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12" id="info"></div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-2">
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Tambah Data</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <center>
              <a class="btn btn-app btn-lg" data-toggle="modal" id="btn_add_modal" data-target="#modal_add">
                <i class="fa fa-plus text-primary"></i> Tambah
              </a><br>
              <a class="btn btn-app btn-lg" data-toggle="modal" id="btn_import_modal" data-target="#modal_import">
                <i class="fa  fa-file-excel-o text-primary"></i> Import
              </a>
            </center>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- /.box-header -->
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Keterangan</h3>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#"><i class="fa fa-pencil text-primary"></i> <span>Edit</span></a></li>
              <li><a href="#"><i class="fa fa-trash text-red"></i> <span> Hapus</span></a></li>
            </ul>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="col-xs-12 col-md-12 col-lg-10">
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= $title ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th width="10px">No</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Detail Pengajuan</th>
                  <th>Pekerjaan</th>
                  <th>Pendapatan</th>
                  <th width="15px">Aksi</th>
                </tr>
              </thead>
              <tbody id="show_data">
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.modal tambah dan edit -->
<div class="modal fade" id="modal_add">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" name="show_in_add">Tambah Data</h4>
        <h4 class="modal-title" name="show_in_edit">Edit Data</h4>
      </div>
      <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
        <div class="modal-body">
          <!-- <input type="hidden" id="kd_mustahik" name="kd_mustahik"> -->
          <input type="hidden" id="no_registrasi" name="no_registrasi">
          <input type="hidden" name="old_image" id="old_image">
          <!-- <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_registrasi">Nomor Registrasi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="no_registrasi" name="no_registrasi" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div> -->

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_kk">Nomor KK <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="no_kk" name="no_kk" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="nik">Nomor NIK KTP <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="nik" name="nik" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="nama">Nama Lengkap <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="nama" name="nama" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="tempat_lahir">Tempat , Tanggal Lahir <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                <input type="date" id="tgl_lahir" name="tgl_lahir" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="alamat" name="alamat" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="dusun">Dusun <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="dusun" name="dusun" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="desa">Desa / Kelurahan<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="desa" name="desa" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kecamatan">Kecamatan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="kecamatan" name="kecamatan" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kota">Kota / Kabupaten<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="kota" name="kota" placeholder="*data berdasarkan KTP" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="propinsi">Provinsi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="propinsi" placeholder="*data berdasarkan KTP" name="propinsi" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jenis_kelamin">Jenis Kelamin <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="radio" id="L" class="minimal" value="L" name="jenis_kelamin" /> Laki - laki
                <input type="radio" id="P" class="minimal" value="P" name="jenis_kelamin" /> Perempuan
              </div>
            </div>
          </div>


          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="agama">Agama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="agama" name="agama" required>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katholik">Katholik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Budha">Budha</option>
                </select>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="status_marital">Status Marital <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="status_marital" name="status_marital" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="status_pendidikan">Status Pendidikan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php foreach ($pendidikan as $pend) { ?>
                    <input type="radio" id="<?= $pend ?>" class="minimal" value="<?= $pend ?>" name="status_pendidikan" /> <?= $pend." "?>
                  <?php } ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="pekerjaan">Pekerjaan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="pekerjaan" name="pekerjaan" required>
                  <?php foreach ($pekerjaan as $pek) { ?>
                    <option value="<?= $pek; ?>"><?= $pek; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="penghasilan">Penghasilan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="penghasilan" name="penghasilan" required>
                  <?php foreach ($penghasilan as $p) { ?>
                      <option value="<?= $p; ?>"><?= $p; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_telp">No Telp <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="no_telp" name="no_telp" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_keluarga">Jumlah Keluarga <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="jumlah_keluarga" name="jumlah_keluarga" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="detail_pengajuan">Detail Pengajuan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="detail_pengajuan" name="detail_pengajuan" required>
                  <?php foreach ($detail_pengajuan as $dp) { ?>
                      <option value="<?= $dp; ?>"><?= $dp; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="Persyaratan">Persyaratan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="persyaratan" name="persyaratan" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <?php
            if($this->session->userdata('status')!='admin'){
          ?>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="sekolah">Sekolah <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="sekolah" readonly value="<?= $this->session->userdata('sekolah') ?>" name="sekolah" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <?php
            }else{
          ?>
            <input type="hidden" id="sekolah" name="sekolah">
          <?php
            }
          ?>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" class="btn btn-primary">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal tambah dan edit -->

<!-- /.modal import -->
<div class="modal fade" id="modal_import">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Import Data</h4>
      </div>
      <!-- enctype="multipart/form-data" -->
      <form id="form_import" data-parsley-validate class="form-horizontal form-label-left">
        <input type="hidden" name="dummy" id="dummy" value="<?= uniqid()?>">
        <div class="modal-body">
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="excel">Pilih Excel <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="file" id="excel" name="excel" accept=".xlsx" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" name="btn_import" id="btn_import" value="Simpan" class="btn btn-primary">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal import -->

<!-- /.modal hapus -->
<div class="modal modal-danger fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Data</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="kd_data" id="kd_data">
        <h5>Apakah Anda Yakin ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="button" id="btn_hapus" class="btn btn-outline">Ya</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal hapus -->


<script type="text/javascript">
  $(document).ready(function() {
    tampil_data();
    $('.select2').select2();
    var kondisi;

    //icheck
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })

    //fungsi tampil data
    function tampil_data() {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getData',
        async: true,
        dataType: 'json',
        success: function(data) {
          $('#example2').dataTable().fnDestroy();
          var html = '';
          var i;
          var no = 1;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + no++ + '</td>' +
              '<td>' + data[i].nik + '</td>' +
              '<td>' + data[i].nama + '</td>' +
              '<td>' + data[i].alamat + '</td>' +
              '<td>' + data[i].detail_pengajuan + '</td>' +
              '<td>' + data[i].pekerjaan + '</td>' +
              '<td>' + data[i].penghasilan + '</td>' +
              // '<td><img src="<?= base_url() ?>assets/uploads/mustahik_khusus/' + data[i].foto + '" width="64"></td>' +
              '<td style="text-align:center;">' +
              // '<a href="javascript:;" class="btn btn-primary btn-xs item_edit" data="' + data[i].no_registrasi + '"><i class="fa fa-pencil "></i></a>' + ' ' +
              '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].no_registrasi + '"><i class="fa fa-trash "></i></a>' +
              '</td>' +
              '</tr>';
          }
          $('#show_data').html(html);
          $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
          });
        }
      });
    }

    //Import Data
    $('#btn_import').on('click', function() {
      var myform = new FormData($('#form_import')[0]);
        $.ajax({
          async: true,
          type: "POST",
          url: "<?= $url ?>importData",
          dataType: "JSON",
          data: myform,
          cache: false,
          processData: false,
          contentType: false,
          success: function(data) {
            if (data.success == true) {
              $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
                ' <b>Bershasil ! </b>Data telah disimpan ! ' + '</div>');
              $('.form-group').removeClass('has-error')
                .removeClass('has-success');
              $('.text-danger').remove();
              $('.alert-success').delay(500).show(1000, function() {
                $(this).delay(2000).slideUp(500, function() {
                  $(this).remove();
                });
              })
              $('#form_import')[0].reset();
              $('#modal_import').modal('hide');
              tampil_data();
            } else {
              $.each(data.messages, function(key, value) {
                var element = $('#' + key);
                element.closest('div.form-group')
                  .removeClass('has-error')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success')
                  .find('.text-danger')
                  .remove();
                element.after(value);
              });
            }
          }
        });
        return false;
    });

    //ATUR HIDE AND SHOW
    $('#btn_add_modal').on('click', function() {
      kondisi = "tambah";
      $('#form_add')[0].reset();
      $('[name="show_in_add"]').show();
      $('[name="show_in_edit"]').hide();
      $('#no_registrasi').attr('readonly', false);
      $('#no_kk').attr('readonly', false);
    });

    //TOMBOL EDIT -> GET KODE & ATUR HIDE AND SHOW
    $('#show_data').on('click', '.item_edit', function() {
      kondisi = "edit";
      var id = $(this).attr('data');
      $.ajax({
        async: true,
        type: "GET",
        url: "<?= $url ?>getDataByKode",
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(data) {
          $.each(data, function(no_registrasi, no_kk,nik, nama, tempat_lahir, tgl_lahir, alamat, dusun, desa, kecamatan, kota, propinsi, jenis_kelamin) {
            $('#modal_add').modal('show');
            $('[name="show_in_add"]').hide();
            $('[name="show_in_edit"]').show();
            $('#old_image').val(data.foto);
            $('#no_registrasi').val(data.no_registrasi).attr('readonly', true);
            $('#no_kk').val(data.no_kk);
            $('#nik').val(data.nik);
            $('#nama').val(data.nama);
            $('#tempat_lahir').val(data.tempat_lahir);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#'+ data.jenis_kelamin).attr('checked',true);
          });
        }
      });
      return false;
    });

    //TOMBOL HAPUS -> GET KODE
    $('#show_data').on('click', '.item_hapus', function() {
      var id = $(this).attr('data');
      $('#modal_delete').modal('show');
      $('#kd_data').val(id);
    });

    //SIMPAN DATA
    $('#btn_simpan').on('click', function() {
      var myform = new FormData($('#form_add')[0]);
      if (kondisi == "tambah") {
        $.ajax({
          async: true,
          type: "POST",
          url: "<?= $url ?>setData",
          dataType: "JSON",
          data: myform,
          cache: false,
          processData: false,
          contentType: false,
          success: function(data) {
            if (data.success == true) {
              $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
                ' <b>Bershasil ! </b>Data telah disimpan ! ' + '</div>');
              $('.form-group').removeClass('has-error')
                .removeClass('has-success');
              $('.text-danger').remove();
              $('.alert-success').delay(500).show(1000, function() {
                $(this).delay(2000).slideUp(500, function() {
                  $(this).remove();
                });
              })
              $('#form_add')[0].reset();
              $('#modal_add').modal('hide');
              tampil_data();
            } else {
              $.each(data.messages, function(key, value) {
                var element = $('#' + key);
                element.closest('div.form-group')
                  .removeClass('has-error')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success')
                  .find('.text-danger')
                  .remove();
                element.after(value);
              });
            }
          }
        });
        return false;
      }
      //EDIT DATA
      else if (kondisi == "edit") {
        $.ajax({
          async: true,
          type: "POST",
          url: "<?= $url ?>updateData",
          dataType: "JSON",
          data: myform,
          cache: false,
          processData: false,
          contentType: false,
          success: function(data) {
            if (data.success == true) {
              $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
                ' <b>Berhasil !</b> Data telah diedit !' + '</div>');
              $('.form-group').removeClass('has-error')
                .removeClass('has-success');
              $('.text-danger').remove();
              $('.alert-success').delay(500).show(1000, function() {
                $(this).delay(2000).slideUp(500, function() {
                  $(this).remove();
                });
              })
              $('#form_add')[0].reset();
              $('#modal_add').modal('hide');
              tampil_data();
            } else {
              $.each(data.messages, function(key, value) {
                var element = $('#' + key);
                element.closest('div.form-group')
                  .removeClass('has-error')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success')
                  .find('.text-danger')
                  .remove();
                element.after(value);
              });
            }
          }

        });
        return false;
      }
    });

    //HAPUS DATA
    $('#btn_hapus').on('click', function() {
      var kode = $('#kd_data').val();
      $.ajax({
        async: true,
        type: "POST",
        url: "<?= $url ?>deleteData",
        dataType: "JSON",
        data: {
          kode: kode
        },
        success: function(data) {
          $('#modal_delete').modal('hide');
          tampil_data();
          $('#info').append('<div class="alert alert-danger"><i class="fa fa-trash-o"></i>' +
            ' <b>Berhasil !</b> Data telah dihapus !</b>' + '</div>');
          $('.alert-danger').delay(500).show(1000, function() {
            $(this).delay(2000).slideUp(500, function() {
              $(this).remove();
            });
          })
        }
      });
      return false;
    });

  });
</script>