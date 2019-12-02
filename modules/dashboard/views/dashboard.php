<?php
$title = 'Neraca Keuangan';
$url = base_url() . 'dashboard/';
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

  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Aktiva</h3>
            <div class="pull-right">
              <h3 class="box-title" id="total_aktiva"></h3>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover" id="tb_aktiva">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th style="width: 80%">Keterangan</th>
                  <th style="width: 15%">Saldo</th>
                  <th><i class="fa fa-ellipsis-v"></i> </th>
                </tr>
              </thead>
              <tbody id="show_data1">
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->

        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Pasiva</h3>
            <div class="pull-right">
              <h3 class="box-title" id="total_pasiva"></h3>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover" id="tb_pasiva">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th style="width: 80%">Keterangan</th>
                  <th style="width: 15%">Saldo</th>
                  <th><i class="fa fa-ellipsis-v"></i> </th>
                </tr>
              </thead>
              <tbody id="show_data2">
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
  </section>
</div>
<!-- /.content-wrapper -->

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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary" id="btn_ok">Posting</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function() {
    tampil_data_aktiva();
    tampil_data_pasiva();
    var kondisi;

    //TOMBOL DETAIL -> GET KODE
    $('#tb_aktiva').on('click', '.item_detail', function() {
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
        }
      });
    });

    //TOMBOL DETAIL -> GET KODE
    $('#tb_pasiva').on('click', '.item_detail', function() {
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
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': true
          });
          $('#kd_transaksi').val(kd_transaksi);
          $('#jml_data').val(data.length);
        }
      });
    });

    //fungsi tampil data
    function tampil_data_aktiva() {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getAktiva',
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#tb_aktiva').dataTable().fnDestroy();
          var html = '';
          var kode_akun;
          var saldo;
          var total_aktiva = 0;
          var i;
          var no = 1;
          var a, b, c, g;
          var d = '',
            e = '',
            f = '';
          for (i = 0; i < data.length; i++, no++) {
            kode_akun = data[i].kd_akun;
            saldo = toRupiah(data[i].saldo)
            total_aktiva += parseFloat(data[i].saldo);
            if (i == 0) {
              a = data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2];
              b = data[i].kd_akun[4] + data[i].kd_akun[5];
              c = data[i].kd_akun[7] + data[i].kd_akun[8];
              g = data[i].kd_akun[10] + data[i].kd_akun[11];
            }
            if (data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2] == a && a != '00' && i != 0) {
              d = "&nbsp ";
              if (data[i].kd_akun[4] + data[i].kd_akun[5] == b && b != '00') {
                e = "&nbsp ";
                if (data[i].kd_akun[7] + data[i].kd_akun[8] == c && c != '00') {
                  f = "&nbsp ";
                } else {
                  c = data[i].kd_akun[7] + data[i].kd_akun[8];
                  f = "";
                }
              } else {
                b = data[i].kd_akun[4] + data[i].kd_akun[5];
                e = "";
              }
            } else {
              a = data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2];
              d = "";
            }
            if (b == '00')
              data[i].kd_akun = a;
            else if (c == '00')
              data[i].kd_akun = a + "." + b;
            else if (g == '00')
              data[i].kd_akun = a + "." + b + "." + c;
            html += '<tr>' +
              '<td>' + no + '</td>' +
              '<td><b>' + d + e + f + data[i].kd_akun + "</b> " + data[i].nama_akun + '</td>' +
              '<td style="text-align:right;">' + saldo + '</td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-info btn-xs item_detail" data="' + kode_akun + '"><i class="fa  fa-list-ul"></i></a>' + ' ' +
              '</td>' +
              '</tr>';
          }
          $('#total_aktiva').html(toRupiah(total_aktiva,1));
          $('#show_data1').html(html);
          $('#tb_aktiva').DataTable({
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

    function tampil_data_pasiva() {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getPasiva',
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#tb_pasiva').dataTable().fnDestroy();
          var html = '';
          var kode_akun;
          var saldo;
          var total_pasiva = 0;
          var i;
          var no = 1;
          var a, b, c, g;
          var d = '',
            e = '',
            f = '';
          for (i = 0; i < data.length; i++, no++) {
            kode_akun = data[i].kd_akun;
            saldo = toRupiah(data[i].saldo)
            total_pasiva += parseFloat(data[i].saldo);
            if (i == 0) {
              a = data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2];
              b = data[i].kd_akun[4] + data[i].kd_akun[5];
              c = data[i].kd_akun[7] + data[i].kd_akun[8];
              g = data[i].kd_akun[10] + data[i].kd_akun[11];
            }
            if (data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2] == a && a != '00' && i != 0) {
              d = "&nbsp ";
              if (data[i].kd_akun[4] + data[i].kd_akun[5] == b && b != '00') {
                e = "&nbsp ";
                if (data[i].kd_akun[7] + data[i].kd_akun[8] == c && c != '00') {
                  f = "&nbsp ";
                } else {
                  c = data[i].kd_akun[7] + data[i].kd_akun[8];
                  f = "";
                }
              } else {
                b = data[i].kd_akun[4] + data[i].kd_akun[5];
                e = "";
              }
            } else {
              a = data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2];
              d = "";
            }
            if (b == '00')
              data[i].kd_akun = a;
            else if (c == '00')
              data[i].kd_akun = a + "." + b;
            else if (g == '00')
              data[i].kd_akun = a + "." + b + "." + c;
            html += '<tr>' +
              '<td>' + no + '</td>' +
              '<td><b>' + d + e + f + data[i].kd_akun + "</b> " + data[i].nama_akun + '</td>' +
              '<td style="text-align:right;">' + saldo + '</td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-info btn-xs item_detail" data="' + kode_akun + '"><i class="fa  fa-list-ul"></i></a>' + ' ' +
              '</td>' +
              '</tr>';
          }
          $('#total_pasiva').html(toRupiah(total_pasiva,1));
          $('#show_data2').html(html);
          $('#tb_pasiva').DataTable({
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

    function toRupiah(nominal, rp = 0) {
      var reverse = nominal.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      if(rp == 1)
        ribuan = 'Rp. ' + ribuan.join('.').split('').reverse().join('');
      else
        ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan
    }

  });
</script>