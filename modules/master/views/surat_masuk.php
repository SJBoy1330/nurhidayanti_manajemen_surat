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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Data Surat Masuk</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Surat Masuk</li>
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
                             <button type="button" class="btn btn-sm btn-primary" onclick="tambah_data()" data-bs-toggle="modal" data-bs-target="#kt_modal_surat_masuk">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Surat Masuk</button>
                            <!--end::Add class-->
                        </div>
                    </div>
                    <!--end::Header-->
                     <!--begin::Card body-->
                    <div class="card-body table-responsive pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_surat_masuk" data-url="<?= base_url('table/surat_masuk'); ?>">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="text-start min-w-70px">Aksi</th>
                                    <th class="min-w-125px">No Surat</th>
                                    <th class="min-w-125px">Tgl Diterima</th>
                                    <th class="min-w-150px">Asal Surat</th>
                                    <th class="min-w-200px">Perihal</th>
                                    <th class="min-w-150px">Keterangan</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600"></tbody>
                        </table>
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


<div class="modal fade" id="kt_modal_surat_masuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal" data-title="Edit Surat Masuk|Tambah Surat Masuk"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body mx-5 mx-xl-15 my-7">
                <form id="form_surat_masuk" class="form" action="<?= base_url('master_function/tambah/surat_masuk') ?>" method="POST" enctype="multipart/form-data">
                    <div class="d-flex flex-column me-n7 pe-7">
                        
                        <div class="fv-row mb-7" id="req_no_surat">
                            <label class="required fw-semibold fs-6 mb-2">No Surat</label>
                            <div class="input-group input-group-solid">
                                <input type="text" name="no_surat" id="no_surat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan Nomor Surat" autocomplete="off" />
                                <button class="btn btn-light-primary" type="button" onclick="generate_no_surat()">Auto</button>
                            </div>
                            <div class="text-muted fs-8 mt-1">Klik <b>Auto</b> untuk generate nomor otomatis.</div>
                        </div>

                        <div class="fv-row mb-7" id="req_tgl_diterima">
                            <label class="required fw-semibold fs-6 mb-2">Tgl Diterima</label>
                            <input type="date" name="tgl_diterima" class="form-control form-control-solid" value="<?= date('Y-m-d') ?>" />
                        </div>

                        <div class="fv-row mb-7" id="req_asal_surat">
                            <label class="required fw-semibold fs-6 mb-2">Asal Surat</label>
                            <input type="text" name="asal_surat" class="form-control form-control-solid" placeholder="Masukkan Asal Surat" autocomplete="off" />
                        </div>

                        <div class="fv-row mb-7" id="req_perihal">
                            <label class="required fw-semibold fs-6 mb-2">Perihal</label>
                            <input type="text" name="perihal" class="form-control form-control-solid" placeholder="Masukkan Perihal" autocomplete="off" />
                        </div>

                        <div class="fv-row mb-7" id="req_keterangan">
                            <label class="fw-semibold fs-6 mb-2">Keterangan</label>
                            <textarea class="form-control form-control-solid" name="keterangan" placeholder="Tambahkan keterangan jika ada"></textarea>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Lampiran Scan (Opsional)</label>
                            <input type="file" name="file" class="form-control form-control-solid" accept=".pdf,.jpg,.jpeg,.png" />
                            
                            <div id="display_file_surat" class="mt-2"></div>
                        </div>  

                        <input type="hidden" name="id">
                    </div>

                    <div class="text-center pt-15">
                        <button type="button" id="submit_surat_masuk" onclick="submit_form(this,'#form_surat_masuk')" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>