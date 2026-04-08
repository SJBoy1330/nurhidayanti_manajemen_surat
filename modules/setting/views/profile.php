<!--begin::Content-->
<section class="hero py-5">
    <div class="container">
        <!--begin::Container-->
        <form method="POST" action="<?= base_url('setting_function/update'); ?>" id="form_ubah_profil">
            <!--begin::Basic primary-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer">
                    
                    <!--begin::Card title-->
                    <div class="card-title m-0 d-flex justify-content-between align-items-center w-100">
                        <h3 class="fw-bold m-0">Profil</h3>
                        <button type="button" id="btn_update_profile" data-loader="big" onclick="submit_form(this,'#form_ubah_profil')" class="btn btn-primary">Simpan</button>
                    </div>
                    <!--end::Card title-->
                    
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <div class="form">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline background-partisi" data-kt-image-input="true" style="background-image: url('<?= image_check('user.jpg','default') ?>')">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px background-partisi" style="background-image: url('<?= image_check($result->image,'user','user') ?>')"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah data">
                                            <i class="ki-duotone ki-pencil fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="image_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon hps_image btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon hps_image btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus data">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Tipe yang didukung: png, jpg</div>
                                    <input type="hidden" name="name_image" value="<?=$result->image;?>">
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label for="name" class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row" id="req_name">
                                            <input id="name" type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Nama Lengkap" value="<?= $result->name; ?>" autocomplete="off" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic primary-->
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Sistem Otentikasi</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-6">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-shield-tick fs-2tx text-white me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                <!--begin::Content-->
                                <div class="mb-3 mb-md-0 fw-semibold">
                                    <h4 class="text-white fw-bold">Pengaturan keamanan</h4>
                                    <div class="fs-6 pe-7 text-white">Data dibawah akan digunakan untuk perangkat otentikasi! Tolong isi data dengan hati-hati</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center mt-6">

                             <!--begin::Input group-->
                            <div class="row mb-1 w-100">
                                <!--begin::Label-->
                                <label for="username" class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">Username</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row" id="req_username">
                                    <input type="username" id="username" name="username" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Username" value="<?= $result->username; ?>"  autocomplete="off" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->
                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Input group-->
                            <div class="row mb-1 w-100">
                                <!--begin::Label-->
                                <label for="password" class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="">Kata Sandi</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row" id="req_password">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Kata Sandi" value=""  autocomplete="off" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                        </div>
                        <!--end::Password-->

                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Input group-->
                            <div class="row mb-1 w-100">
                                <!--begin::Label-->
                                <label for="new_password" class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="">Kata Sandi Baru</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row" id="req_new_password">
                                    <input type="password" id="new_password" name="new_password" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Kata Sandi Baru" value=""  autocomplete="off" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                        </div>
                        <!--end::Password-->


                            <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Input group-->
                            <div class="row mb-1 w-100">
                                <!--begin::Label-->
                                <label for="repassword" class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="">Konfirmasi Kata Sandi</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row" id="req_repassword">
                                    <input type="password" id="repassword" name="repassword" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Konfirmasi Kata Sandi" value="" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            
                        </div>
                        <!--end::Password-->
                        
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Sign-in Method-->
        </form>
        <!--end::Container-->
    </div>
</section>
<!--end::Content-->