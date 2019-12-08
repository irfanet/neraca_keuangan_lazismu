<?php
$title = "Formulis Survey Calon Mustahik";
$url = base_url() . 'mustahik/b2/';
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
                  <th>no_registrasi</th>
                  <th>no_kk</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
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
      <form id="form_add" data-parsley-validate class="form-horizontal form-label-left">
        <div class="modal-body">
          
        <!-- Data survey -->
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="no_registrasi">Nomor Registrasi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2" style="width: 100%;" id="no_registrasi" name="no_registrasi" required>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="petugas_survey">Petugas Survey <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="petugas_survey" name="petugas_survey" value="<?= $this->session->userdata('username'); ?>" readonly class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </div>

          <!-- Data keluarga -->
          <div>
            <div class="row">
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kondisi_keluarga">Data Keluarga Mustahik
                </label>
            </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_tanggungan_keluarga">Jumlah Tanggungan Keluarga <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="jumlah_tanggungan_keluarga">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_anak_yg_masih_sekolah">Jumlah Anak yg Masih Sekolah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="jumlah_anak_yg_masih_sekolah">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_anak_yg_putus_sekolah">Jumlah Anak yg Putus Sekolah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="jumlah_anak_yg_putus_sekolah">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_pengeluaran_bulanan">Jumlah Pengeluaran Bulanan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="jumlah_pengeluaran_bulanan">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="obat_rutin_anggota_keluarga_yg_sakit">Obat Rutin Anggota Keluarga yg Sakit <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="obat_rutin_anggota_keluarga_yg_sakit">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="biaya_pendidikan_yg_ditanggung">Biaya Pendidikan yg Ditanggung <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="biaya_pendidikan_yg_ditanggung">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="riwayat_hutang_berjalan">Riwayat Hutang Berjalan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="riwayat_hutang_berjalan">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="keperluan_hutang">Keperluan Hutang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="keperluan_hutang">
                </div>
                </div>
            </div>
          </div>
        
          <!-- Kondisi keluarga -->
          <div>
            <div class="row">
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kondisi_keluarga">Kondisi Keluarga
                </label>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="pekerjaan_kepala_keluarga">Pekerjaan Kepala Keluarga <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="pekerjaan_kepala_keluarga">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="merokok">Merokok <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="merokok">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="pekerjaan_suami_istri">Pekerjaan Suami / Istri <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="pekerjaan_suami_istri">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="usia_mustahik">Usia Mustahik <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="usia_mustahik">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kondisi_kepala_keluarga">Kondisi Kepala Keluarga <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="kondisi_kepala_keluarga">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kepemilikan_rumah">Kepemilikan Rumah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="kepemilikan_rumah">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="luas_rumah">Luas Rumah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="luas_rumah">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="dinding_rumah">Dinding Lantai <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="dinding_rumah">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="lantai">Lantai <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="lantai">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="atap">Atap <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="atap">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="sumber_air_minum">Sumber Air Minum <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="sumber_air_minum">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="mck">MCK <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="mck">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="penerangan">Penerangan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="penerangan">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="daya_terpasang">Daya Terpasang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="daya_terpasang">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kelayakan_tidur">Kelayakan Tidur <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="kelayakan_tidur">
                </div>
                </div>
            </div>
          </div>

          <!-- Barang Elektronik -->
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="barang_elektronik_yg_dimiliki">Barang Elektronik yg Dimiliki <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2 tag" style="width: 100%;" id="barang_elektronik_yg_dimiliki" name="barang_elektronik_yg_dimiliki" multiple required>
                </select>
              </div>
            </div>
          </div>

          <!-- Makanan sehari hari -->
          <div>
            <div class="row">
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="kondisi_keluarga">Makanan Sehari - hari
                </label>
            </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="jumlah_makan_perhari">Jumlah Makan / hari <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="jumlah_makan_perhari">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="ayam">Ayam <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="ayam">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="daging">Daging <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="daging">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="susu">Susu <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="susu">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="belanja_harian">Belanja Harian <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="belanja_harian">
                </div>
                </div>
            </div>
          </div>

          <!-- Kepemilikan aset -->
          <div>
            <div class="row">
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4">Kepemilikan aset
                </label>
            </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="aset_tidak_bergerak">Aset Tidak Bergerak <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="aset_tidak_bergerak">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="sawah_pekarangan">Sawah Pekarangan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="sawah_pekarangan">
                </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-4" for="aset_bergerak">Aset Bergerak <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6" id="aset_bergerak">
                </div>
                </div>
            </div>
          </div>

          <!-- Bantuan dari Lembaga lain -->
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="status_bantuan_dari_lembaga_lain">Status Bantuan dari Lembaga Lain <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select type="text" class="form-control select2 tag" style="width: 100%;" id="status_bantuan_dari_lembaga_lain" name="status_bantuan_dari_lembaga_lain" multiple required>
                </select>
              </div>
            </div>
          </div>

          <!-- Catatan tambahan -->
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-4" for="catatan_tambahan">Catatan Tambahan <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <input type="text" id="catatan_tambahan" name="catatan_tambahan" class="form-control col-md-7 col-xs-12">
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
    // tampil_data();
    $('.select2').select2();
    $('#barang_elektronik_yg_dimiliki').select2({
      tags: true
    });
    $('#status_bantuan_dari_lembaga_lain').select2({
      tags: true
    });
    var kondisi;
    getMustahik();
    //get radio
    for (i = 1; i <= 31; i++) {
        getRadio('tb_b2_3',i);
    }

    //get gatot
    function getField(kategori) {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getField/'+kategori,
        async: false,
        dataType: 'json',
        success: function(data) {
          var i;
          var html ='';
          for (i = 0; i < data.length; i++) {
            html += "<div class='row'>" +
                "<div class='form-group'>" +
                "<label class='control-label col-md-4 col-sm-4 col-xs-4' for='penghasilan'> " + data[i].keterangan +" <span class='required'>*</span></label>"+
                "<div class='col-md-6 col-sm-6 col-xs-6 id='"+ data[i].keterangan +"'>"+    
                "</div>"+
            "</div>";
          }
          $('#form_b2').html(html);
        }
      });
    }

    //get radio & keterangan
    function getRadio(name,id) {
    var field;
     $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getKetField/'+id,
        async: false,
        dataType: 'json',
        success: function(data) {
            $.each(data, function(keterangan) {
                field = data.keterangan;
            });
        }
     });   
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getRadio/'+name+'/'+id,
        async: true,
        dataType: 'json',
        success: function(data) {
          var i;
          var html ='';
          for (i = 0; i < data.length; i++) {
            html += "<input type='radio' id='' class='minimal' value='"+ data[i].keterangan + "' name=' "+field+"' /> "+ data[i].keterangan + "&nbsp; ";
          }
          $('#'+field).append(html);
        }
      });
    }

    //get mustahik
    function getMustahik() {
      $.ajax({
        type: 'ajax',
        url: '<?= $url ?>getMustahik',
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '<option selected disabled>--- Pilih Satu ---</option>';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].no_registrasi + '">' + data[i].nama + ' - ' + data[i].alamat + '</option>';
          }
          $('#no_registrasi').html(html);
        }
      });
    }

    
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
              '<td>' + data[i].no_registrasi + '</td>' +
              '<td>' + data[i].no_kk + '</td>' +
              '<td>' + data[i].tempat_lahir + '</td>' +
              '<td>' + data[i].tgl_lahir + '</td>' +
              '<td><img src="<?= base_url() ?>assets/uploads/mustahik_khusus/' + data[i].foto + '" width="64"></td>' +
              '<td style="text-align:center;">' +
              '<a href="javascript:;" class="btn btn-primary btn-xs item_edit" data="' + data[i].no_registrasi + '"><i class="fa fa-pencil "></i></a>' + ' ' +
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