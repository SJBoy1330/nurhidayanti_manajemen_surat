let surat_keluarTable;

document.addEventListener('DOMContentLoaded', function () {
    // 1. Inisialisasi DataTable Surat Keluar
    surat_keluarTable = initGlobalDatatable('#table_surat_keluar', function () {
        return {
            // Filter tambahan jika diperlukan
        };
    });
});

// Ambil judul modal dari atribut data-title (Format: Edit|Tambah)
var title = $('#title_modal').data('title').split('|');

/**
 * Fungsi untuk generate nomor surat otomatis (Surat Keluar)
 */
function generate_no_surat_keluar() {
    const now = new Date();
    const datePart = now.getFullYear() + 
                     String(now.getMonth() + 1).padStart(2, '0') + 
                     String(now.getDate()).padStart(2, '0');
    const randomPart = Math.floor(1000 + Math.random() * 9000); 
    
    // Format nomor: SK/20260408/9999
    const autoNo = `SK/${datePart}/${randomPart}`;
    
    // Gunakan selector spesifik agar tidak bentrok jika ada modal lain
    $('#form_surat_keluar input[name="no_surat"]').val(autoNo);
    $('#form_surat_keluar input[name="no_surat"]').attr('readonly', true);
    $('#form_surat_keluar input[name="no_surat"]').addClass('bg-light-success text-success fw-bold');
}

/**
 * Fungsi Tambah Data
 */
function tambah_data() {
    var form = document.getElementById('form_surat_keluar');
    
    // Set Action ke insert_surat_keluar
    form.setAttribute('action', BASE_URL + 'master_function/insert_surat_keluar');
    
    // Set Judul Modal
    $('#title_modal').html(title[1]);
    
    // Reset Form & Status Input
    form.reset();
    $('#form_surat_keluar input[name="no_surat"]').attr('readonly', false);
    $('#form_surat_keluar input[name="no_surat"]').removeClass('bg-light-success text-success fw-bold');
    $('#display_file_surat_keluar').html(''); 
    
    $('input[name="id"]').val('');
    
    // Set default tanggal hari ini (tgl_surat)
    let today = new Date().toISOString().split('T')[0];
    $('input[name="tgl_surat"]').val(today);
}

/**
 * Fungsi Ubah Data
 */
function ubah_data(element, id) {
    var form = document.getElementById('form_surat_keluar');
    
    // Set Action ke update_surat_keluar
    form.setAttribute('action', BASE_URL + 'master_function/update_surat_keluar');
    
    // Reset UI State
    $('#form_surat_keluar input[name="no_surat"]').attr('readonly', false);
    $('#form_surat_keluar input[name="no_surat"]').removeClass('bg-light-success text-success fw-bold');

    $.ajax({
        url: BASE_URL + 'setting_function/get_single/surat_keluar/id',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            // Set Judul Modal
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.no_surat+')</span>');
            
            // Mapping data Surat Keluar
            $('input[name="id"]').val(data.id);
            $('input[name="no_surat"]').val(data.no_surat);
            $('input[name="tgl_surat"]').val(data.tgl_surat);
            $('input[name="perihal"]').val(data.perihal);
            $('input[name="tujuan"]').val(data.tujuan); // Khusus Surat Keluar
            $('textarea[name="keterangan"]').val(data.keterangan);
            
            // Display File Download
            let fileHtml = '';
            if (data.file) {
                let fileUrl = BASE_URL + 'data/surat_keluar/' + data.file;
                fileHtml = `
                    <div class="d-flex align-items-center border border-dashed border-primary p-3 rounded bg-light-primary">
                        <i class="ki-outline ki-file-added fs-2x text-primary me-3"></i>
                        <div class="d-flex flex-column">
                            <span class="fs-7 fw-bold text-gray-800">Lampiran tersedia</span>
                            <a href="${fileUrl}" target="_blank" class="fs-8 fw-bold text-primary text-decoration-underline">
                                Lihat / Download Dokumen
                            </a>
                        </div>
                    </div>`;
            } else {
                fileHtml = '<span class="text-muted fs-8 italic">Tidak ada lampiran file.</span>';
            }
            $('#display_file_surat_keluar').html(fileHtml);

            if(document.getElementsByName("file")[0]) {
                document.getElementsByName("file")[0].value = "";
            }
        }
    });
}