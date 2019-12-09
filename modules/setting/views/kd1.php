<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kode Segmen 1
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12" id="info"></div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-2">
        <div class="box box-solid box-default">
          <div class="box-header">
            <h3 class="box-title">Tambah Kode</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <center>
              <a class="btn btn-app btn-lg" data-toggle="modal" id="btn_add_modal" data-target="#modal_add">
                <i class="fa fa-plus"></i> Tambah
              </a>
            </center>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-xs-12 col-md-12 col-lg-10">
        <div class="box box-solid box-default">
          <div class="box-header">
            <h3 class="box-title">Jurnal</h3>
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
                  <th>Kode</th>
                  <th>nama</th>
                  <th width="15%">Aksi</th>
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
        <h4 class="modal-title" name="show_in_add">Tambah Kode</h4>
        <h4 class="modal-title" name="show_in_edit">Edit Kode</h4>
      </div>
      <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
        <div class="modal-body">
          <input type="hidden" id="id_1" name="id_1">
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kode">Kode <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="kd_1" name="kd_1" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="nama" name="nama" required class="form-control col-md-7 col-xs-12">
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
        <input type="hidden" name="id_1" id="id_1">
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
        url: '<?= base_url() ?>setting/getSegmen1',
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#example2').dataTable().fnDestroy();
          var html = '';
          var i;
          var no = 1;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + no++ + '</td>' +
              '<td>' + data[i].kd_1 + '</td>' +
              '<td>' + data[i].nama + '</td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].id_1 + '">Edit</a>' + ' ' +
              '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id_1 + '">Hapus</a>' +
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
      $('#kd_1').attr('readonly', false);
      $('#nama').attr('readonly', false);
      $('#modal_add').on('shown.bs.modal', function() {
        $('#kode').focus()
      });
    });

    //TOMBOL EDIT -> GET KODE & ATUR HIDE AND SHOW
    $('#show_data').on('click', '.item_edit', function() {
      kondisi = "edit";
      var id = $(this).attr('data');
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>setting/getDataByKode1",
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(data) {
          $.each(data, function(id_1, kd_1, nama) {
            $('#modal_add').modal('show');
            $('[name="show_in_add"]').hide();
            $('[name="show_in_edit"]').show();
            $('#id_1').val(data.id_1);
            $('#kd_1').val(data.kd_1).attr('readonly', true);
            $('#nama').val(data.nama);
            $('#modal_add').on('shown.bs.modal', function() {
              $('#nama').focus()
            });
          });
        }
      });
      return false;
    });

    //TOMBOL HAPUS -> GET KODE
    $('#show_data').on('click', '.item_hapus', function() {
      var id = $(this).attr('data');
      $('#modal_delete').modal('show');
      $('[name="id_1"]').val(id);
    });

    //SIMPAN DATA
    $('#btn_simpan').on('click', function() {
      if (kondisi == "tambah") {
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>setting/setSegmen1",
          dataType: "JSON",
          data: {
            kd_1: $('#kd_1').val(),
            nama: $('#nama').val(),
          },
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
          type: "POST",
          url: "<?= base_url() ?>setting/updateSegmen1",
          dataType: "JSON",
          data: {
            id_1: $('#id_1').val(),
            kd_1: $('#kd_1').val(),
            nama: $('#nama').val()
          },
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
      var kode = $('#id_1').val();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>setting/deleteSegmen1",
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