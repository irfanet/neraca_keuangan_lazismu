<?php
$title = 'Jurnal Umum';
$url = base_url() . 'jurnalUmum/';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $title ?>
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
            <h3 class="box-title">ke_akun</h3>
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
                  <th>Tanggal</th>
                  <th>Kode Akun</th>
                  <th>Keterangan</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <!-- <th width="80px">Aksi</th> -->
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
          <input type="hidden" id="kd_mutasi" name="kd_mutasi">
          <!-- <input type="hidden" name="old_image" id="old_image"> -->
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="tgl_mutasi">Tanggal Mutasi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="date" id="tgl_mutasi" name="tgl_mutasi" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="dari_akun">Dari Akun <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="dari_akun" name="dari_akun" required>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="ke_akun">Ke Akun <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
              <select type="text" class="form-control select2" style="width: 100%;" id="ke_akun" name="ke_akun" required>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="nominal">Nominal <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="nominal" name="nominal" required class="form-control col-md-7 col-xs-12">
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

<!-- /.modal detail -->
<div class="modal fade" id="modal_detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Data</h4>
      </div>
      <form id="form_jurnal">
        <div class="modal-body">
          <input type="hidden" id="jml_data">
          <input type="hidden" id="kd_transaksi">
          <div class="callout callout-primary">
            <!-- <h4 id="info_jurnal_judul"></h4> -->
            <p id="info_jurnal"></p>
          </div>
          <table id="detail_table" class="table table-bordered">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Tanggal</th>
                <th>Kode Akun</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody id="show_detail">
            </tbody>
          </table>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn_posting">Posting</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function() {
    var kondisi;
    var paymentMethod;
    paymentMethod = "getKasAktiva";

    $('.select2').select2();
    tampil_data();
    getCash('dari_akun');
    getBank('dari_akun');
    getAsetLancar('dari_akun');
    getLibilitas();

    //get muzaki
    function getCash(ke) {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getCash',
        type: "GET",
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '<optgroup label="CASH">';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].kd_akun + '">' + data[i].kd_akun + ' - ' + data[i].nama_akun + '</option>';
          }
          html += '</optgroup>';
          $('#'+ke).html(html);
        }
      });
    }

    //get aktiva
    function getBank(ke) {
      $.ajax({
        type: 'ajax',
        url: "<?= $url ?>getBank",
        type: "GET",
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '<optgroup label="BANK">';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].kd_akun + '">' + data[i].kd_akun + ' - ' + data[i].nama_akun + '</option>';
          }
          html += '</optgroup>';
          $('#'+ke).append(html);
        }
      });
    }

    //get Aset
    function getAsetLancar(ke) {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getAsetLancar',
        type: "GET",
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '<optgroup label="ASET LANCAR">';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].kd_akun + '">' + data[i].kd_akun + ' - ' + data[i].nama_akun + '</option>';
          }
          html += '</optgroup>';
          $('#'+ke).append(html);
        }
      });
    }

    //get pasiva
    function getLibilitas() {
      $.ajax({
        type: 'ajax',
        url: "<?= $url ?>getLiabilitas",
        type: "GET",
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '<option selected disabled>--- Pilih Satu ---</option>';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].kd_akun + '">' + data[i].kd_akun + ' - ' + data[i].nama_akun + '</option>';
          }
          $('#ke_akun').html(html);
        }
      });
    }

    //to Rupiah
    function toRupiah(nominal, rp = 0) {
      var reverse = nominal.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      if(rp == 1)
        ribuan = 'Rp. ' + ribuan.join('.').split('').reverse().join('');
      else
        ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan
    }

    //fungsi tampil data
    function tampil_data() {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getData',
        type: "GET",
        async: true,
        dataType: 'json',
        success: function(data) {
          $('#example2').dataTable().fnDestroy();
          var html = '';
          var i;
          var btn;
          var no = 1;
          for (i = 0; i < data.length; i++) {
            if (data[i].status == "1") {
              btn = "disabled";
            } else {
              btn = "";
            }
            var debit = toRupiah(data[i].debit);
            var kredit = toRupiah(data[i].kredit);
            html += '<tr>' +
              '<td>' + no++ + '</td>' +
              '<td>' + data[i].tgl + '</td>' +
              '<td>' + data[i].kd_akun + '</td>' +
              '<td>' + data[i].keterangan + '</td>' +
              '<td>' + debit + '</td>' +
              '<td>' + kredit + '</td>' +
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

    //TOMBOL DETAIL -> GET KODE
    $('#show_data').on('click', '.item_detail', function() {
      var id = $(this).attr('data');
      $('#modal_detail').modal('show');
      $.ajax({
        async: true,
        type: "GET",
        url: "<?= $url ?>getDetailByKode",
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(data) {
          $('#detail_table').dataTable().fnDestroy();
          var html = '';
          var i;
          var kd_transaksi;
          var status;
          var no = 1;
          for (i = 0; i < data.length; i++) {
            status = data[i].status;
            kd_transaksi = data[i].kd_transaksi;
            var debit = toRupiah(data[i].debit);
            var kredit = toRupiah(data[i].kredit);
            html += '<tr>' +
              '<td>' + no++ + '</td>' +
              '<td>' + data[i].tgl + '</td>' +
              '<td>' + data[i].kd_akun + '</td>' +
              '<td>' + data[i].keterangan + '</td>' +
              '<td style="text-align:right;">' + debit + '</td>' +
              '<td style="text-align:right;">' + kredit + '</td>' +
              '</tr>';
          }
          $('#show_detail').html(html);
          $('#detail_table').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': true
          });
          $('#kd_transaksi').val(kd_transaksi);
          $('#jml_data').val(data.length);
          if (status == "1") {
            $('#btn_posting').attr("disabled", true);
            $('#info_jurnal').html("<i class='fa fa-check'></i> <b>Jurnal sudah diposting !</b>");
          } else {
            $('#btn_posting').attr("disabled", false);
            $('#info_jurnal').html("<i class='fa fa-warning'></i> <b>Jurnal belum diposting !</b> Pastikan data sudah benar sebelum memposting !");
          }
        }
      });
    });

    //POSTING JURNAL
    $('#btn_posting').on('click', function() {
      // var myform = new FormData($('#form_add')[0]);
      // if (kondisi == "tambah") {
      $.ajax({
        async: true,
        type: "POST",
        url: "<?= $url ?>postJurnal",
        dataType: "JSON",
        data: {
          kd_transaksi: $('#kd_transaksi').val(),
          jml_data: $('#jml_data').val()
        },
        success: function(data) {
          if (data.success == true) {
            $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
              ' <b>Berhasil ! </b>Data telah disimpan ! ' + '</div>');
            $('.form-group').removeClass('has-error')
              .removeClass('has-success');
            $('.text-danger').remove();
            $('.alert-success').delay(500).show(1000, function() {
              $(this).delay(2000).slideUp(500, function() {
                $(this).remove();
              });
            })
            $('#form_jurnal')[0].reset();
            $('#modal_detail').modal('hide');
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
      // }
    });

    //ATUR HIDE AND SHOW
    $('#btn_add_modal').on('click', function() {
      kondisi = "tambah";
      $('#form_add')[0].reset();
      $('[name="show_in_add"]').show();
      $('[name="show_in_edit"]').hide();
      $('#tgl_mutasi').attr('readonly', false);
      $('#dari_akun').attr('readonly', false);
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
          $.each(data, function(kd_mutasi, tgl_mutasi, dari_akun, ke_akun, nominal) {
            $('#modal_add').modal('show');
            $('[name="show_in_add"]').hide();
            $('[name="show_in_edit"]').show();
            // $('#old_image').val(data.foto);
            $('#kd_mutasi').val(data.kd_mutasi);
            $('#tgl_mutasi').val(data.tgl_mutasi);
            $('#dari_akun').val(data.dari_akun);
            $('#ke_akun').val(data.ke_akun);
            $('#nominal').val(data.nominal);
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
                ' <b>Berhasil ! </b>Data telah disimpan ! ' + '</div>');
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