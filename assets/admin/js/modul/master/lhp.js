let lhpTable;

document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi DataTable LHP
    lhpTable = initGlobalDatatable('#table_lhp', function () {
        return {};
    });
});

var title = $('#title_modal').data('title').split('|');

/**
 * Fungsi Auto Generate Nomor LHP
 */
function generate_no_lhp() {
    const now = new Date();
    const datePart = now.getFullYear() + 
                     String(now.getMonth() + 1).padStart(2, '0') + 
                     String(now.getDate()).padStart(2, '0');
    const randomPart = Math.floor(1000 + Math.random() * 9000); 
    
    // Format: LHP/20260408/5555
    const autoNo = `LHP/${datePart}/${randomPart}`;
    
    $('#no_lhp').val(autoNo);
    $('#no_lhp').attr('readonly', true);
    $('#no_lhp').addClass('bg-light-success text-success fw-bold');
}

/**
 * Fungsi Tambah Data
 */
function tambah_data() {
    var form = document.getElementById('form_lhp');
    form.setAttribute('action', BASE_URL + 'master_function/insert_lhp');
    $('#title_modal').html(title[1]);
    
    form.reset();
    
    // Reset Status Auto Generate
    $('#no_lhp').attr('readonly', false);
    $('#no_lhp').removeClass('bg-light-success text-success fw-bold');
    
    $('#display_file_lhp').html('');
    $('input[name="id"]').val('');
    
    let today = new Date().toISOString().split('T')[0];
    $('input[name="tgl_lhp"]').val(today);
}

/**
 * Fungsi Ubah Data
 */
function ubah_data(element, id) {
    var form = document.getElementById('form_lhp');
    form.setAttribute('action', BASE_URL + 'master_function/update_lhp');
    
    // Reset status readonly saat edit
    $('#no_lhp').attr('readonly', false);
    $('#no_lhp').removeClass('bg-light-success text-success fw-bold');

    $.ajax({
        url: BASE_URL + 'setting_function/get_single/lhp/id',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.no_lhp+')</span>');
            
            $('input[name="id"]').val(data.id);
            $('input[name="no_lhp"]').val(data.no_lhp);
            $('input[name="tgl_lhp"]').val(data.tgl_lhp);
            $('input[name="judul_lhp"]').val(data.judul_lhp);
            $('input[name="judul_lhr"]').val(data.judul_lhr);
            $('input[name="nama_obrik"]').val(data.nama_obrik);
            $('textarea[name="tim_pemeriksa"]').val(data.tim_pemeriksa);
            $('textarea[name="keterangan"]').val(data.keterangan);
            
            if (data.file) {
                let fileUrl = BASE_URL + 'data/lhp/' + data.file;
                $('#display_file_lhp').html(`
                    <div class="d-flex align-items-center border border-dashed border-primary p-3 rounded bg-light-primary mt-2">
                        <i class="ki-outline ki-file-added fs-2x text-primary me-3"></i>
                        <div class="d-flex flex-column">
                            <span class="fs-7 fw-bold text-gray-800">Lampiran LHP</span>
                            <a href="${fileUrl}" target="_blank" class="fs-8 fw-bold text-primary text-decoration-underline">Download File</a>
                        </div>
                    </div>`);
            } else {
                $('#display_file_lhp').html('<span class="text-muted fs-8 italic">Tidak ada file.</span>');
            }
        }
    });
}