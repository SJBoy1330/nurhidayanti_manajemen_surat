<!--begin::Content-->
<section class="hero py-5">
    <div class="container" id="kt_content_container">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin:::Tabs-->
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a onclick="set_url_params('umum')" class="nav-link text-active-primary d-flex align-items-center pb-5 <?= (!$page || $page == 'umum') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#general_pane">
                        <i class="ki-duotone ki-home fs-2 me-2"></i>Umum</a>
                    </li>
                    <!--end:::Tab item-->
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a onclick="set_url_params('seo')" class="nav-link text-active-primary d-flex align-items-center pb-5 <?= ($page == 'seo') ? 'active' : ''; ?>" data-bs-toggle="tab" href="#seo_pane">
                        <i class="fa-brands fa-searchengin fs-2 me-2"></i>
                        </i>SEO</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
                <!--begin:::Tab content-->
                <div class="tab-content" id="tab_pane">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade <?= (!$page || $page == 'umum') ? 'show active' : ''; ?>" id="general_pane" role="tabpanel">
                        <?php include 'partials/logo.php'; ?>
                    </div>
                    <!--end:::Tab pane-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade <?= ($page == 'seo') ? 'show active' : ''; ?>" id="seo_pane" role="tabpanel">
                        <?php include 'partials/seo.php'; ?>
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end:::Tab content-->

                
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</section>
