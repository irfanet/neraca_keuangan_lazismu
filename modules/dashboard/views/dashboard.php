<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Neraca Keuangan
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Aktiva</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered" id="tb_aktiva">
              <thead>
                <tr>
                  <th style="width: 10px">Kode</th>
                  <th style="width: 200px">Keterangan</th>
                  <th style="width: 50px">Detail</th>
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
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered" id="tb_pasiva">
              <thead>
                <tr>
                  <th style="width: 10px">Kode</th>
                  <th style="width: 200px">Keterangan</th>
                  <th>Jumlah</th>
                  <th style="width: 50px">Detail</th>
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

<script type="text/javascript">
  $(document).ready(function() {
    tampil_data_aktiva();
    tampil_data_pasiva();
    var kondisi;

    //fungsi tampil data
    function tampil_data_aktiva() {
      $.ajax({
        type: 'ajax',
        url: '<?= base_url() ?>dashboard/getAktiva',
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#tb_aktiva').dataTable().fnDestroy();
          var html = '';
          var i;
          var no = 1;
          var a, b, c, g;
          var d = '', e = '', f = '';
          for (i = 0; i < data.length; i++, no++) {
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
                if(data[i].kd_akun[7] + data[i].kd_akun[8] == c && c != '00'){
                  f = "&nbsp ";
                }
                else{
                  c = data[i].kd_akun[7] + data[i].kd_akun[8];
                  f = "";
                }
              }
              else{
                b = data[i].kd_akun[4] + data[i].kd_akun[5];
                e = "";
              }
            } else {
              a = data[i].kd_akun[0] + data[i].kd_akun[1] + data[i].kd_akun[2];
              d = "";
            }
            if(b == '00')
              data[i].kd_akun = a;
            else if(c == '00')
              data[i].kd_akun = a+"."+b;
            else if(g == '00')
              data[i].kd_akun = a+"."+b+"."+c;

            html += '<tr>' +
                  '<td>' + no + '</td>' +
                  '<td>' + d + e + f + data[i].kd_akun + " " + data[i].nama_akun + '</td>' +
                  '<td style="text-align:center;">' +
                  '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].kd_akun + '">Detail</a>' + ' ' +

                  '</td>' +
                  '</tr>';
          }
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
        url: '<?= base_url() ?>dashboard/getPasiva',
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#tb_pasiva').dataTable().fnDestroy();
          var html = '';
          var i;
          var no = 1;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + no++ + '</td>' +
              '<td>' + data[i].nama_4 + '</td>' +
              '<td>' + +'</td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].id_1 + '">Detail</a>' + ' ' +
              '</td>' +
              '</tr>';
          }
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
  });
</script>