<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
    <li class="nav-item">
        <a href="<?= base_url('/applications') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'applications' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Applications</p>
        </a>
        <a href="<?= base_url('/qr') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'qr' ? 'active' : '' ?>" style="display: none">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>QR Code</p>
        </a>
    </li>
</ul>