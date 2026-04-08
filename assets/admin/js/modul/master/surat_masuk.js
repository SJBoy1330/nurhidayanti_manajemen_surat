let surat_masukTable;

document.addEventListener('DOMContentLoaded', function () {
    // 1. Inisialisasi DataTable
    // Nama variabel surat_masukTable (sesuai standar global kamu)
    surat_masukTable = initGlobalDatatable('#table_surat_masuk', function () {
        return {
            // Tempat jika ada filter tambahan di masa depan
        };
    });
});

// Ambil judul modal dari atribut data-title (Format: Edit|Tambah)
var title = $('#title_modal').data('title').split('|');

/**
 * Fungsi untuk generate nomor surat otomatis
 */
function generate_no_surat() {
    const now = new Date();
    const datePart = now.getFullYear() + 
                     String(now.getMonth() + 1).padStart(2, '0') + 
                     String(now.getDate()).padStart(2, '0');
    const randomPart = Math.floor(1000 + Math.random() * 9000); // 4 digit angka acak
    
    // Format nomor: SM/20260408/1234
    const autoNo = `SM/${datePart}/${randomPart}`;
    
    $('#no_surat').val(autoNo);
    $('#no_surat').attr('readonly', true); // Disable input manual
    $('#no_surat').addClass('bg-light-success text-success fw-bold'); // Feedback visual
}

/**
 * Fungsi Tambah Data (Triggered by button Tambah)
 */
function tambah_data() {
    var form = document.getElementById('form_surat_masuk');
    
    // Set Action ke insert_surat_masuk
    form.setAttribute('action', BASE_URL + 'master_function/insert_surat_masuk');
    
    // Set Judul Modal (Ambil indeks ke-1: Tambah)
    $('#title_modal').html(title[1]);
    
    // Reset Form & Status Input
    form.reset();
    $('#no_surat').attr('readonly', false);
    $('#no_surat').removeClass('bg-light-success text-success fw-bold');
    $('#display_file_surat').html(''); // Bersihkan display file
    
    $('input[name="id"]').val(''); // Pastikan ID kosong
    
    // Set default tanggal hari ini
    let today = new Date().toISOString().split('T')[0];
    $('input[name="tgl_diterima"]').val(today);
}

/**
 * Fungsi Ubah Data (Triggered by button Edit di table)
 */
function ubah_data(element, id) {
    var form = document.getElementById('form_surat_masuk');
    
    // Set Action ke update_surat_masuk
    form.setAttribute('action', BASE_URL + 'master_function/update_surat_masuk');
    
    // Reset status readonly (antisipasi jika sebelumnya habis klik auto di tambah_data)
    $('#no_surat').attr('readonly', false);
    $('#no_surat').removeClass('bg-light-success text-success fw-bold');

    $.ajax({
        url: BASE_URL + 'setting_function/get_single/surat_masuk/id',
        method: 'POST',
        data: { 
            id: id 
        },
        dataType: 'json',
        success: function (data) {
            // Set Judul Modal (Ambil indeks ke-0: Edit)
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.no_surat+')</span>');
            
            // Isi data ke masing-masing input
            $('input[name="id"]').val(data.id);
            $('input[name="no_surat"]').val(data.no_surat);
            $('input[name="tgl_diterima"]').val(data.tgl_diterima);
            $('input[name="asal_surat"]').val(data.asal_surat);
            $('input[name="perihal"]').val(data.perihal);
            $('textarea[name="keterangan"]').val(data.keterangan); // Textarea
            
            // Logika Menampilkan File Download jika ada
            let fileHtml = '';
            if (data.file) {
                let fileUrl = BASE_URL + 'data/surat_masuk/' + data.file;
                fileHtml = `
                    <div class="d-flex align-items-center border border-dashed border-primary p-3 rounded bg-light-primary">
                        <i class="ki-outline ki-file-added fs-2x text-primary me-3"></i>
                        <div class="d-flex flex-column">
                            <span class="fs-7 fw-bold text-gray-800">Lampiran tersedia</span>
                            <a href="${fileUrl}" target="_blank" class="fs-8 fw-bold text-primary text-hover-dark text-decoration-underline">
                                Lihat / Download Dokumen
                            </a>
                        </div>
                    </div>`;
            } else {
                fileHtml = '<span class="text-muted fs-8 italic">Tidak ada lampiran file.</span>';
            }
            $('#display_file_surat').html(fileHtml);

            // Selalu kosongkan input file saat baru buka modal edit (browser security)
            if(document.getElementsByName("file")[0]) {
                document.getElementsByName("file")[0].value = "";
            }
        }
    });
}