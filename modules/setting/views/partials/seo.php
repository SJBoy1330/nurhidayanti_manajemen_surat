<!--begin::Form-->
<form id="form_seo_panel" method="POST" class="form" action="<?= base_url('setting_function/ubah_seo');?>">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label for="meta_title" class="col-lg-4 col-form-label required fw-semibold fs-6">Judul Web</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row" id="req_meta_title">
                    <input id="meta_title" value="<?= $result->meta_title; ?>" type="text" name="meta_title" class="form-control form-control-lg form-control-solid" placeholder="Masukkan judul website" autocomplete="off" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label for="meta_author" class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Author</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row" id="req_meta_author">
                    <input id="meta_author" value="<?= $result->meta_author; ?>" type="text" name="meta_author" class="form-control form-control-lg form-control-solid" placeholder="Masukkan nama author" autocomplete="off" />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label for="meta_keyword_website" class="col-lg-4 col-form-label fw-semibold fs-6">Kata Kunci Pencarian</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row" id="req_meta_keyword">
                    <input class="form-control form-control-lg form-control-solid ps-4" value="<?= $result->meta_keyword; ?>" placeholder="Masukkan keyword website" name="meta_keyword" id="keyword_website"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label for="meta_address" class="col-lg-4 col-form-label fw-semibold fs-6">Alamat</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row" id="req_meta_address">
                    <textarea name="meta_address" id="meta_address" cols="30" rows="3" class="form-control form-control-lg form-control-solid" placeholder="Masukkan alamat"><?= $result->meta_address; ?></textarea>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label for="meta_description" class="col-lg-4 col-form-label fw-semibold fs-6">Deskripsi Singkat Website</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row" id="req_meta_description">
                    <textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control form-control-lg form-control-solid" placeholder="Masukkan deskripsi singkat website"><?= $result->meta_description; ?></textarea>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->

    <div class="row w-100">
        <div class="col-12 w-100 d-flex justify-content-center">
            <button type="button" id="btn_save_seo" data-loader="big" onclick="submit_form(this,'#form_seo_panel')" class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>
<!--end::Form-->