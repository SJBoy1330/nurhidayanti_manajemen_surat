<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
?>
<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
        <!--begin::Logo-->
        <a href="<?= base_url('dashboard') ?>" class="app-sidebar-logo">
            <?php if(isset($setting->logo) && $setting->logo != '' && file_exists('./data/setting/'.$setting->logo)) : ?>
            <div class="background-partisi-contain" style="width : 200px;height : 50px;background-image : url('<?= image_check($setting->logo,'setting'); ?>')"></div>
            <?php endif;?>
        </a>
        <!--end::Logo-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">

            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                <!--begin::Heading-->
                <div class="menu-item mb-2">
                    <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                    <!--begin::Separator-->
                    <div class="app-sidebar-separator separator"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Heading-->
                <!--begin:Menu item-->
                <a href="<?= base_url('dashboard'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= (!$segment1 || $segment1 == 'dashboard') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="ki-outline ki-home-2 fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Dashboard</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                 <!--begin:Menu item-->
                <a href="<?= base_url('master/admin'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= ($segment1 == 'master' && $segment2 == 'admin') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="fa-solid fa-book-open-reader fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Data Petugas</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="<?= base_url('master/letter/in'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= ($segment1 == 'master' && $segment2 == 'box') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="fa-solid fa-box-open fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Surat Masuk</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="<?= base_url('master/letter/out'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= ($segment1 == 'master' && $segment2 == 'location') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="fa-solid fa-map fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Surat Keluar</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
               
                 <!--begin:Menu item-->
                <a href="<?= base_url('report'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= ($segment1 == 'master' && $segment2 == 'arsip') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="fa-solid fa-file fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Laporan Hasil Pemeriksaan</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="<?= base_url('setting'); ?>" class="menu-item mb-3">
                    <!--begin:Menu link-->
                    <span class="menu-link <?= ($segment1 == 'setting') ? 'active' : ''; ?>">
                        <span class="menu-icon">
                            <i class="fa-solid fa-gear fs-2"></i>
                        </span>
                        <span class="menu-title fs-4">Pengaturan</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Navs-->
</div>
<!--end::Sidebar-->