<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" id="section">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active': '' ?>">
        <a href="#" data-target="dashboard">
          <i class="fa fa-balance-scale"></i> <span>Neraca</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'jurnal' ? 'active': '' ?>">
        <a href="#" data-target="jurnal">
          <i class="fa   fa-list-ol"></i>
          <span>Jurnal</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'donasiMasuk' ? 'active': '' ?>">
        <a href="#" data-target="donasiMasuk">
          <i class="fa fa-calculator"></i>
          <span>Donasi Masuk</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'mustahikKhusus' ? 'active': '' ?>">
        <a href="#" data-target="mustahikKhusus">
          <i class="fa fa-child"></i>
          <span>Mustahik Khusus</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'muzaki' ? 'active': '' ?>">
        <a href="#" data-target="muzaki">
          <i class="fa  fa-smile-o"></i>
          <span>Muzaki</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'admin' ? 'active': '' ?>">
        <a href="#" data-target="admin">
          <i class="fa fa-user"></i> <span>Admin</span>
        </a>
      </li>
      <li class="treeview  <?php echo $this->uri->segment(1) == 'setting' ? 'active': '' ?>">
        <a href="#">
          <i class="fa fa-cog"></i><span> Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" data-target="setting"><i class="fa fa-circle-o"></i> Kode Segmen 1</a></li>
          <li><a href="#" data-target="setting/viewSegmen2"><i class="fa fa-circle-o"></i> Kode Segmen 2</a></li>
          <li><a href="#" data-target="setting/viewSegmen3"><i class="fa fa-circle-o"></i> Kode Segmen 3</a></li>
          <li><a href="#" data-target="setting/viewSegmen4"><i class="fa fa-circle-o"></i> Kode Segmen 4</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<div id="isi">
  <?php $this->load->view('dashboard'); ?>
</div>

<script>
  $(document).ready(function(){
    $('#section ul li a').on('click', function(){
      var $this = $(this),
      target = $this.data('target');
      $('#isi').load('<?= base_url()?>'+target);
      return false;
    });
  });
</script>