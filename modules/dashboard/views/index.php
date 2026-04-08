<!--begin::Container-->
<div class="container-xxl" id="kt_content_container">
	<!--begin::Row-->

    <div class="row gx-5 gx-xl-10 mb-xl-10">
         <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-4">
        <!--begin::Card widget 16-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-100 mb-3 mb-xl-6 shadow-sm">
            <!--begin::Card body-->
            <div class="card-body d-flex justify-content-center py-7 flex-column">
                 <!--begin::Amount-->
                <div class="fs-1 fw-bold text-dark me-2 lh-1 ls-n2"><i class="fa-solid <?= (salamWaktu()->dark == true) ? 'fa-cloud-moon' : 'fa-cloud-sun'; ?>"></i> <?= salamWaktu()->message; ?> <span class="text-primary"><?= $_SESSION[PREFIX_SESSION.'_name'] ?? ''; ?></span></div>
                <!--end::Amount-->
                <span class="text-dark opacity-50 pt-1 mt-3 fw-semibold fs-6">Selamat Datang di Sistem Arsip Digital</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->
    </div>
    
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-5">
        <!--begin::Card widget 16-->
        <div class="card card-custom bgi-no-repeat gutter-b card-stretch border-0 h-md-100 mb-5 mb-xl-10 shadow-sm bgi-size-contain bgi-position-x-center" style="background-position: right top; background-size: 30% auto; background-image: url(<?= base_url('assets/admin/svg/abstract.svg') ?>);background-color: var(--bs-primary);">
            <!--begin::Card body-->
            <div class="card-body d-flex justify-content-center py-7 flex-column">
                 <!--begin::Amount-->
                <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"><?= (isset($cnt_petugas) && $cnt_petugas) ? number_format($cnt_petugas,0,',','.') : 0 ?></span>
                <!--end::Amount-->
                <span class="text-white opacity-50 pt-1 mt-3 fw-semibold fs-6">Jumlah Petugas Aktif</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->

        
        <!--begin::Col-->
        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-5">
        <!--begin::Card widget 16-->
        <div class="card card-custom bgi-no-repeat gutter-b card-stretch border-0 h-md-100 mb-5 mb-xl-10 shadow-sm bgi-size-contain bgi-position-x-center" style="background-position: calc(100% + 20px) calc(0% + 10px);background-size: 30% auto; background-image: url(<?= base_url('assets/admin/svg/database.svg') ?>);">
            <!--begin::Card body-->
            <div class="card-body d-flex justify-content-center py-7 flex-column">
                  <!--begin::Amount-->
                <span class="fw-bold text-primary me-2 lh-1 ls-n2" style="font-size : 25px;"><?= (isset($cnt_admin) && $cnt_admin) ? number_format($cnt_admin,0,',','.') : 0 ?></span>
                <!--end::Amount-->
                <!--begin::Subtitle-->
                <span class="text-dark opacity-50 pt-1 mt-3 fw-semibold fs-6">Jumlah Admin Aktif</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-5">
        <!--begin::Card widget 16-->
        <div class="card card-custom bgi-no-repeat gutter-b card-stretch border-0 h-md-100 mb-5 mb-xl-10 shadow-sm bgi-size-contain bgi-position-x-center" style="background-position: calc(100% + 20px) calc(0% + 10px);background-size: 30% auto; background-image: url(<?= base_url('assets/admin/svg/users.svg') ?>);">
            <!--begin::Card body-->
            <div class="card-body d-flex justify-content-center py-7 flex-column">
                  <!--begin::Amount-->
                <span class="fw-bold text-primary me-2 lh-1 ls-n2" style="font-size : 25px;"><?= (isset($cnt_arsip) && $cnt_arsip) ? number_format($cnt_arsip,0,',','.') : 0 ?></span>
                <!--end::Amount-->
                <!--begin::Subtitle-->
                <span class="text-dark opacity-50 pt-1 mt-3 fw-semibold fs-6">Total Arsip</span>
                <!--end::Subtitle-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->

    </div>

</div>
<!--end::Container-->


<!-- Styles -->