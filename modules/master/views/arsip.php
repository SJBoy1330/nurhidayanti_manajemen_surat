<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Data Arsip</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Arsip</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Body-->
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" class="form-control form-control-solid w-250px ps-12 search-datatable" placeholder="Cari"  />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end me-3">
                                <!--begin::Filter-->
                                
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Pilih Penyaringan</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-semibold">Box Arsip</label>
                                            <select id="filter_id_box_arsip" class="form-select form-select-solid filter-input table-filter" data-control="select2" data-placeholder="Pilih Box Arsip">
                                                <option value="all">Semua</option>
                                                <?php if($box_arsip) : ?>
                                                    <?php foreach($box_arsip AS $item) : ?>
                                                        <option value="<?= $item->id ?>"><?= $item->name; ?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-semibold">Kategori</label>
                                            <select id="filter_id_category" class="form-select form-select-solid filter-input table-filter" data-control="select2" data-placeholder="Pilih Kategori">
                                                <option value="all">Semua</option>
                                                <?php if($category) : ?>
                                                    <?php foreach($category AS $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->name; ?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-semibold">Lokasi</label>
                                            <select id="filter_id_location" class="form-select form-select-solid filter-input table-filter" data-control="select2" data-placeholder="Pilih Lokasi">
                                                <option value="all">Semua</option>
                                                <?php if($location) : ?>
                                                    <?php foreach($location AS $key) : ?>
                                                        <option value="<?= $key->id ?>"><?= $key->code.' | '.$key->name; ?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->


                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" onclick="filter_apply()" class="btn btn-primary fw-semibold px-6">Terapkan</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->  
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Add class-->
                             <button type="button" class="btn btn-sm btn-primary" onclick="tambah_data()" data-bs-toggle="modal" data-bs-target="#kt_modal_arsip">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Arsip</button>
                            <!--end::Add class-->
                        </div>
                    </div>
                    <!--end::Header-->
                     <!--begin::Card body-->
                    <div class="card-body table-responsive pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_arsip" data-url="<?= base_url('table/arsip'); ?>">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px pe-2" data-orderable="false" data-searchable="false">Aksi</th>
                                    <th class="min-w-100px">Kode</th>
                                    <th class="min-w-150px">Nama</th>
                                    <th class="min-w-150px">Lokasi</th>
                                    <th class="min-w-150px">Kategori</th>
                                    <th class="min-w-150px">Box</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<!-- Modal Tambah class -->
<div class="modal fade" id="kt_modal_arsip"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal" data-title="Edit Arsip|Tambah Arsip"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_arsip" class="form" action="<?= base_url('master_function/tambah/arsip') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7" id="#">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_name">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Arsip</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan Nama Lengkap" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_file">
                            <!--begin::Label-->
                            <label class="required file fw-semibold fs-6 mb-2">File</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="hidden" name="name_file">
                            <input type="file" id="arsip_file" name="file" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pilih File" autocomplete="off" accept="application/pdf"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7" id="req_id_category">
                                    <!--begin::Label-->
                                    <label id="label_id_category" class="id_category required fw-semibold fs-6 mb-2">Kategori</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select id="select_id_category" name="id_category" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Kategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach($category AS $row): ?>
                                            <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7" id="req_id_box_arsip">
                                    <!--begin::Label-->
                                    <label id="label_id_box_arsip" class="id_box_arsip required fw-semibold fs-6 mb-2">Box Arsip</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select id="select_id_box_arsip" name="id_box_arsip" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Box Arsip">
                                        <option value="">Pilih Box Arsip</option>
                                        <?php foreach($box_arsip AS $row): ?>
                                            <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                 <!--begin::Input group-->
                                <div class="fv-row mb-7" id="req_id_location">
                                    <!--begin::Label-->
                                    <label id="label_id_location" class="id_location required fw-semibold fs-6 mb-2">Lokasi</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select id="select_id_location" name="id_location" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Lokasi">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach($location AS $row): ?>
                                            <option value="<?= $row->id; ?>"><?= $row->code.' | '.$row->name; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_description">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Keterangan</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0" cols="30" rows="4" placeholder="Masukkan Keterangan"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <input type="hidden" name="id">
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_arsip" onclick="submit_form(this,'#form_arsip')" class="btn btn-primary">
                            <span class="indicator-label">Kirim</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah class -->
<div class="modal fade" id="kt_modal_detail_location"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal_detail"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body mx-5 mx-xl-15 my-7" id="display_arsip">

            </div>
        </div>
    </div>
</div>