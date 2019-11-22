<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $this->lang->line('data_user'); ?>
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
            <h3 class="box-title"><?= $this->lang->line('tambah_user'); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <center>
              <a class="btn btn-app btn-lg" data-toggle="modal" id="btn_add_modal" data-target="#modal_add">
                <i class="fa fa-plus"></i> <?= $this->lang->line('tambah'); ?>
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
            <h3 class="box-title"><?= $this->lang->line('data_user'); ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cog"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#" id="a_operator">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
            </div>
          </div>


          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th><?= $this->lang->line('no'); ?></th>
                  <th><?= $this->lang->line('email'); ?></th>
                  <th><?= $this->lang->line('username'); ?></th>
                  <th><?= $this->lang->line('level'); ?></th>
                  <th><?= $this->lang->line('status'); ?></th>
                  <th width="15%"><?= $this->lang->line('aksi'); ?></th>
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
        <h4 class="modal-title" name="show_in_add"><?= $this->lang->line('tambah_user'); ?></h4>
        <h4 class="modal-title" name="show_in_edit"><?= $this->lang->line('edit_user'); ?></h4>
      </div>
      <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
        <div class="modal-body">
          <input type="hidden" id="id_user" name="id_user">
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="email"><?= $this->lang->line('email'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="email" name="email" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="username"><?= $this->lang->line('username'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="username" name="username" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <br name="show_in_add">
          <div class="row" name="show_in_add">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="password1" name="password1"><?= $this->lang->line('password'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="password" id="password1" name="password1" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <br name="show_in_add">
          <div class="row" name="show_in_add">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="password2" name="password2"><?= $this->lang->line('konfirmasi_password'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="password" id="password2" name="password2" required class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="level"><?= $this->lang->line('level'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select class="form-control" name="level" id="level">
                  <optgroup label="Admin">
                    <option value="1">Super Admin</option>
                    <option value="2">Manager</option>
                    <option value="3">HRD</option>
                  </optgroup>
                  <optgroup label="Operator">
                    <option value="4">Operator Absen & SPL</option>
                    <option value="5">Operator Payroll</option>
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          <br>
          <div class="row" name="show_in_edit">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="is_active"><?= $this->lang->line('status'); ?> <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select class="form-control" name="is_active" id="is_active">
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('bt_batal'); ?></button>
          <input type="submit" name="btn_simpan" id="btn_simpan" value="<?= $this->lang->line('bt_simpan'); ?>" class="btn btn-primary">
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
        <h4 class="modal-title"><?= $this->lang->line('hapus_data'); ?></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_data" id="id_data">
        <h5><?= $this->lang->line('yakin'); ?></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('bt_tidak'); ?></button>
        <button type="button" id="btn_hapus" class="btn btn-outline"><?= $this->lang->line('bt_ya'); ?></button>
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
        url: '<?= base_url() ?>user/get_data',
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
              '<td>' + data[i].email + '</td>' +
              '<td>' + data[i].username + '</td>' +
              '<td>' + data[i].level + '</td>' +
              '<td>' + data[i].is_active + '</td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].id_user + '"><?= $this->lang->line('bt_edit'); ?></a>' + ' ' +
              '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].id_user + '"><?= $this->lang->line('bt_hapus'); ?></a>' +
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
      $('#email').attr('readonly', false);
      $('#username').attr('readonly', false);
      $('#modal_add').on('shown.bs.modal', function() {
        $('#email').focus()
      });
    });

    //TOMBOL EDIT -> GET KODE & ATUR HIDE AND SHOW
    $('#show_data').on('click', '.item_edit', function() {
      kondisi = "edit";
      var id = $(this).attr('data');
      $.ajax({
        type: "GET",
        url: "<?= base_url() ?>user/get_kode",
        dataType: "JSON",
        data: {
          id: id
        },
        success: function(data) {
          $.each(data, function(id_user, email, username, level, is_active) {
            $('#modal_add').modal('show');
            $('[name="show_in_add"]').hide();
            $('[name="show_in_edit"]').show();
            $('#id_user').val(data.id_user);
            $('#email').val(data.email).attr('readonly', true);
            $('#username').val(data.username).attr('readonly', false);
            $('#level').val(data.level);
            $('#is_active').val(data.is_active);
            $('#modal_add').on('shown.bs.modal', function() {
              $('#username').focus()
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
      $('[name="id_data"]').val(id);
    });

    //SIMPAN DATA
    $('#btn_simpan').on('click', function() {
      if (kondisi == "tambah") {
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>user/simpan_data",
          dataType: "JSON",
          data: {
            email: $('#email').val(),
            username: $('#username').val(),
            password1: $('#password1').val(),
            password2: $('#password2').val(),
            level: $('#level').val()
          },
          success: function(data) {
            if (data.success == true) {
              $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
                ' <?= $this->lang->line('notif_simpan'); ?> ' + '</div>');
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
          url: "<?= base_url() ?>user/update_data",
          dataType: "JSON",
          data: {
            id_user: $('#id_user').val(),
            username: $('#username').val(),
            level: $('#level').val(),
            is_active: $('#is_active').val()
          },
          success: function(data) {
            if (data.success == true) {
              $('#info').append('<div class="alert alert-success"><i class="fa fa-check"></i>' +
                ' <?= $this->lang->line('notif_update'); ?> ' + '</div>');
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
      var kode = $('#id_data').val();
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>user/hapus_data",
        dataType: "JSON",
        data: {
          kode: kode
        },
        success: function(data) {
          $('#modal_delete').modal('hide');
          tampil_data();
          $('#info').append('<div class="alert alert-danger"><i class="fa fa-trash-o"></i>' +
            ' <?= $this->lang->line('notif_hapus'); ?>' + '</div>');
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