<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $this->lang->line('dashboard'); ?>
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
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">Kode</th>
                <th style="width: 200px">Keterangan</th>
                <th>Jumlah</th>
                <th style="width: 50px">Detail</th>
              </tr>
              <tr>
                <td><b>A01</b></td>
                <td><b>ASET</b></td>
                <td></td>
              </tr>
              <tr>
                <td><b>A01.01</b></td>
                <td><b>ASET LANCAR</b></td>
                <td></td>
              </tr>
              <tr>
                <td>A1.01.01</td>
                <td>KAS</td>
                <td></td>
              </tr>
              <tr>
                <td>A01.01.01.01</td>
                <td>KAS ZAKAT</td>
                <td></td>
              </tr>
              <tr>
                <td>A01.01.01.01</td>
                <td>KAS ZAKAT FITRAH</td>
                <td></td>              
              </tr>
              <tr>
                <td><b>A01.02</b></td>
                <td><b>BANK</b></td>
                <td></td>
              </tr>
              <tr>
                <td>A01.01.02.01</td>
                <td>BANK BTN</td>
                <td></td>
              </tr>
              <tr>
                <td>A01.01.02.02</td>
                <td>BANK MANDIRI SYARIAH</td>
                <td>Rp. 1.000.000.000.000</td>
                <td><a href="#" class="btn btn-danger btn-xs item_hapus">Detail</a></td>
              </tr>
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
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
              </tr>
              <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                  </div>
                </td>
                <td><span class="badge bg-red">55%</span></td>
              </tr>
              <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                  </div>
                </td>
                <td><span class="badge bg-yellow">70%</span></td>
              </tr>
              <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                  <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                  </div>
                </td>
                <td><span class="badge bg-light-blue">30%</span></td>
              </tr>
              <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                  <div class="progress progress-xs progress-striped active">
                    <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                  </div>
                </td>
                <td><span class="badge bg-green">90%</span></td>
              </tr>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
        <!-- /.box -->
      </div>
  </section>
</div>
<!-- /.content-wrapper -->