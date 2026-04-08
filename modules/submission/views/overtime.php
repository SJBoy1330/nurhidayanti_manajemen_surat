<!--begin::Container-->
<div class="container-xxl" id="kt_content_container">
	<!--begin::Row-->
    <div class="row gx-5 gx-xl-10 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-10">
        <!--begin::Card widget 16-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-100 mb-5 mb-xl-10 shadow-sm">
            <!--begin::Body-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-center justify-content-start py-7 flex-column">
                <!--begin::Form-->
                <form id="form_overtime" class="form w-100 pt-5" action="<?= base_url('submission_function/insert_overtime'); ?>"  method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column me-n7 pe-7 pt-5" id="#">
                        <?php if(in_array($this->session->userdata(PREFIX_SESSION.'_id_role'),[1])) : ?>
                         <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_id_user">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Pilih Karyawan</label>
                            <!--end::Label-->
                            <div>
                                <select name="id_user" class="form-select form-select-solid" data-placeholder="Pilih karyawan" id="select_employee">
                                    <option></option>
                                    <?php if($employee) : ?>
                                        <?php foreach($employee as $row) : ?>
                                            <option value="<?= $row->id_user; ?>" data-kt-select2-user="<?= image_check($row->image,'user','user'); ?>">
                                                <?= $row->name; ?>
                                            </option>
                                        <?php endforeach;?>
                                    <?php endif;?>

                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <?php endif;?>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_date">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Tanggal Lembur</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input name="date" type="date" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Pilih tanggal"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_time">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Waktu Lembur </label>
                            <!--end::Label-->
                            <div class="input-group">
                                <select name="time" class="form-select form-select-solid" data-control="select2" data-placeholder="Lama waktu lembur">
                                    <option></option>
                                    <option value="1">1 Jam</option>
                                    <option value="2">2 Jam</option>
                                    <option value="3">3 Jam</option>
                                    <option value="4">4 Jam</option>
                                    <option value="5">5 Jam</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_description">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Keterangan</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0" id="" cols="30" rows="3" placeholder="Masukkan keterangan"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_overtime" onclick="submit_form(this,'#form_overtime')" class="btn btn-primary">
                            <span class="indicator-label">Kirim</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-10">
        <!--begin::Card widget 16-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-100 mb-5 mb-xl-10 shadow-sm">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12 search-datatable" placeholder="Search" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                 <div class="card-toolbar">
                    <div class="d-flex justify-content-end me-3">
                        <!--begin::Filter-->
                        <button type="button" class="btn btn-sm btn-secondary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Penyaringan
                        </button>
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
                                    <label class="form-label fs-6 fw-semibold">Status</label>
                                    <select id="filter_status" class="form-select form-select-solid filter-input table-filter" data-control="select2" data-placeholder="Pilih Status">
                                        <option value="all">Semua</option>
                                        <option value="Y">Disetujui</option>
                                        <option value="N">Ditolak</option>
                                        <option value="P">Menunggu Konfirmasi</option>
                                        <option value="C">Dibatalkan</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-semibold">Tanggal Mulai</label>
                                    <input type="date" id="filter_start_date" class="form-select form-select-solid filter-input table-filter" placeholder="Tanggal mulai">
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-semibold">Tanggal Selesai</label>
                                    <input type="date" id="filter_end_date" class="form-select form-select-solid filter-input table-filter" placeholder="Tanggal Selesai">
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
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0 table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_overtime" data-url="<?= base_url('table/overtime'); ?>">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="text-end min-w-70px" data-orderable="false" data-searchable="false">Aksi</th>
                            <th class="min-w-100px">Kode</th>
                            <th class="min-w-200px">Karyawan</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-150px">Tanggal Lembur</th>
                            <th class="min-w-100px">Waktu Lembur</th>
                            <th class="min-w-200px">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600"></tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 16-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
	<!--begin::Modals-->
</div>
<!--end::Container-->