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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Data Box Arsip</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Box Arsip</li>
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
                            <!--begin::Add class-->
                             <button type="button" class="btn btn-sm btn-primary" onclick="tambah_data()" data-bs-toggle="modal" data-bs-target="#kt_modal_box_arsip">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Box Arsip</button>
                            <!--end::Add class-->
                        </div>
                    </div>
                    <!--end::Header-->
                     <!--begin::Card body-->
                    <div class="card-body table-responsive pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_box_arsip" data-url="<?= base_url('table/box_arsip'); ?>">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-10px pe-2" data-orderable="false" data-searchable="false">No</th>
                                    <th class="min-w-100px">Kode</th>
                                    <th class="min-w-200px">Nama Box Arsip</th>
                                    <th class="min-w-100px">Jumlah Arsip</th>
                                    <th class="text-end min-w-70px" data-orderable="false" data-searchable="false">Aksi</th>
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
<div class="modal fade" id="kt_modal_box_arsip"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal" data-title="Edit Box Arsip|Tambah Box Arsip"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_box_arsip" class="form" action="<?= base_url('master_function/tambah/box_arsip') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7" id="#">
                        
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_code">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kode</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="code" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan Kode" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_name">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Box Arsip</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan Nama Lengkap" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <input type="hidden" name="id">
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_box_arsip" onclick="submit_form(this,'#form_box_arsip')" class="btn btn-primary">
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
