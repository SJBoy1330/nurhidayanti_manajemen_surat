<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-fluid">
    <!--begin::Timeline-->
    <div class="card">
        <!--begin::Card head-->
        <div class="card-header card-header-stretch">
            <!--begin::Title-->
            <div class="card-title d-flex align-items-center">
                <i class="ki-outline ki-calendar-8 fs-1 text-primary me-3 lh-0"></i>
                <h3 class="fw-bold m-0 text-gray-800"><?= date('M d, Y',strtotime($nowdate)); ?></h3>
            </div>
            <!--end::Title-->
            <!--begin::Toolbar-->
            <form class="card-toolbar m-0">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="input-group">
                        <!--begin::Input-->
                        <input type="date" name="filter_date" class="form-control form-control-solid mb-3 mb-lg-0" max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d',strtotime($nowdate)); ?>" placeholder="Masukkan Tanggal" autocomplete="off" />
                        <!--end::Input-->
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
                
            </form>
            <!--end::Toolbar-->
        </div>
        <!--end::Card head-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Timeline-->
            <div class="timeline timeline-border-dashed">
                <?php if($result) : ?>
                    <?php foreach($result AS $row) : ?>
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon me-4">
                            <?php if($row->type == 'add') : ?>
                            <i class="fa-solid fa-feather-pointed fs-2 text-gray-500"></i>
                            <?php endif;?>
                            <?php if($row->type == 'edt') : ?>
                            <i class="fa-solid fa-pencil fs-2 text-gray-500"></i>
                            <?php endif;?>
                            <?php if($row->type == 'dlt') : ?>
                            <i class="fa-solid fa-trash fs-2 text-gray-500"></i>
                            <?php endif;?>
                            <?php if($row->type == 'apv') : ?>
                                <i class="fa-solid fa-check-double  fs-2 text-gray-500"></i>
                            <?php endif;?>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-n2">
                            <!--begin::Timeline heading-->
                            <div class="overflow-auto pe-3">
                                <!--begin::Title-->
                                <div class="fs-5 fw-semibold mb-2"><?= $row->description; ?></div>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <!--begin::Info-->
                                    <div class="text-muted me-2 fs-7">Dilakukan pada <?= date('H:i',strtotime($row->create_date)); ?></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                    <?php endforeach;?>
                <?php else :?>
                    <div class="w-100 d-flex justify-content-center align-items-center flex-column">
                        <div class="background-partisi-contain" style="width : 200px;height: 200px;background-image : url('<?= image_check('notfound.svg','default') ?>')"></div>

                        <h3 class="text-primary text-center fs-3">Tidak Ada Aktivitas</h3>
                        <p class="text-muted text-center">Tidak ada aktivitas pada hari ini! Silahkan beraktifitas atau lihat aktifitas pada hari lain</p>
                    </div>
                <?php endif;?>
            </div>
            <!--end::Timeline-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Timeline-->
</div>
<!--end::Content container-->