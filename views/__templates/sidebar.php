<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" id="section">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
        <a href="#" data-target="dashboard">
          <i class="fa fa-balance-scale"></i> <span>Neraca</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'jurnal' ? 'active' : '' ?>">
        <a href="#" data-target="jurnal">
          <i class="fa fa-list-ol"></i>
          <span>Jurnal</span>
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(1) == 'donasiMasuk' ? 'active' : '' ?>">
        <a href="#" data-target="donasiMasuk">
          <i class="fa fa-calculator"></i>
          <span>Donasi Masuk</span>
        </a>
      </li>
      <li id="mustahik" class="treeview <?php echo $this->uri->segment(1) == 'mustahik' ? 'active' : '' ?>">
        <a href="#" data-target="mustahik">
          <i class="fa fa-child"></i>
          <span>Mustahik</span>
        </a>
      </li>
      <li id="b2" class="treeview <?php echo $this->uri->segment(1) == 'b2' ? 'active' : '' ?>">
        <a href="#" data-target="mustahik/b2">
          <i class="fa fa-child"></i>
          <span>Survey Mustahik</span>
        </a>
      </li>
      <li id="mustahikKhusus" class="treeview <?php echo $this->uri->segment(1) == 'mustahikKhusus' ? 'active' : '' ?>">
        <a href="#" data-target="mustahikKhusus">
          <i class="fa fa-child"></i>
          <span>Mustahik Khusus</span>
        </a>
      </li>
      <li id="muzaki" class="treeview <?php echo $this->uri->segment(1) == 'muzaki' ? 'active' : '' ?>">
        <a href="#" data-target="muzaki">
          <i class="fa  fa-smile-o"></i>
          <span>Muzaki</span>
        </a>
      </li>


      <li class="treeview  <?php echo $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
        <a href="#" data-target="tree">
          <i class="fa fa-user"></i><span> User</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" data-target="user/admin"><i class="fa fa-circle-o"></i> Admin</a></li>
          <li><a href="#" data-target="user"><i class="fa fa-circle-o"></i> User</a></li>
        </ul>
      </li>

      <li class="treeview  <?php echo $this->uri->segment(1) == 'setting' ? 'active' : '' ?>">
        <a href="#" data-target="tree">
          <i class="fa fa-cog"></i><span> Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#" data-target="setting/viewSegmen1"><i class="fa fa-circle-o"></i> Kode Segmen 1</a></li>
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
  $(document).ready(function() {
    var temp;
    $('#section ul li a').on('click', function() {
      var $this = $(this),
      target = $this.data('target');
      // if (temp != target) {
      //   $('#' + target).removeClass("active");
      // }
      if (target != "tree") {
        $('#isi').load('<?= base_url() ?>' + target);
        // $('#' + target).addClass("active");
        // temp = target;
        return false;
      }
    });
  });
</script>