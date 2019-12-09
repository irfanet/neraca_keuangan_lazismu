<?php
$title = "Muzaki";
$url = base_url() . 'muzaki/';
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
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No. HP</th>
                  <th>Jenis Muzaki</th>
                  <th>Agama</th>
                  <th>Email</th>
                  <th>No. KTP</th>
                  <th>Keterangan</th>
                  <th>Foto</th>
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
      <!-- enctype="multipart/form-data" -->
      <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
        <div class="modal-body">
          <input type="hidden" id="kd_muzaki" name="kd_muzaki">
          <input type="hidden" name="old_image" id="old_image">
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="nama_muzaki">Nama Muzaki <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="nama_muzaki" name="nama_muzaki" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="alamat" name="alamat" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_hp">No. HP <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="no_hp" name="no_hp" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jenis_muzaki">Jenis Muzaki <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control" id="jenis_muzaki" name="jenis_muzaki" required>
                  <option value="Pribadi">Pribadi</option>
                  <option value="Entitas">Entitas</option>
                  <option value="Lembaga">Lembaga</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="agama">Agama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control" id="agama" name="agama" required>
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
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="email">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="email" name="email" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_ktp">No. KTP <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="no_ktp" name="no_ktp" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="npwp">NPWP <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="npwp" name="npwp" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="keterangan">Keterangan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="keterangan" name="keterangan" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="foto">Foto <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="file" id="foto" name="foto" required>
              </div>
            </div>
          </div>

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
    var kondisi;

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
              '<td>' + data[i].nama_muzaki + '</td>' +
              '<td>' + data[i].alamat + '</td>' +
              '<td>' + data[i].no_hp + '</td>' +
              '<td>' + data[i].jenis_muzaki + '</td>' +
              '<td>' + data[i].agama + '</td>' +
              '<td>' + data[i].email + '</td>' +
              '<td>' + data[i].no_ktp + '</td>' +
              '<td>' + data[i].keterangan + '</td>' +
              '<td><img src="<?= base_url() ?>assets/uploads/muzaki/' + data[i].foto + '" width="64"></td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-primary btn-xs item_edit" data="' + data[i].kd_muzaki + '"><i class="fa fa-pencil "></i></a>' + ' ' +
              '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].kd_muzaki + '"><i class="fa fa-trash "></i></a>' +
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

    //ATUR HIDE AND SHOW
    $('#btn_add_modal').on('click', function() {
      kondisi = "tambah";
      $('#form_add')[0].reset();
      $('[name="show_in_add"]').show();
      $('[name="show_in_edit"]').hide();
      $('#nama_muzaki').attr('readonly', false);
      $('#alamat').attr('readonly', false);
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
          $.each(data, function(kd_muzaki, nama_muzaki, alamat, no_hp, jenis_muzaki, agama, email, no_ktp,npwp, keterangan, foto) {
            $('#modal_add').modal('show');
            $('[name="show_in_add"]').hide();
            $('[name="show_in_edit"]').show();
            $('#old_image').val(data.foto);
            $('#kd_muzaki').val(data.kd_muzaki);
            // $('#nama_muzaki').val(data.nama_muzaki).attr('readonly', true);
            $('#nama_muzaki').val(data.nama_muzaki);
            $('#alamat').val(data.alamat);
            $('#no_hp').val(data.no_hp);
            $('#jenis_muzaki').val(data.jenis_muzaki);
            $('#agama').val(data.agama);
            $('#email').val(data.email);
            $('#no_ktp').val(data.no_ktp);
            $('#npwp').val(data.npwp);
            $('#keterangan').val(data.keterangan);
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