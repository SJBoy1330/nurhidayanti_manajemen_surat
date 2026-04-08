let arsipTable;
let currentFilterIdCategory = '';
let currentFilterIdBoxArsip = '';
let currentFilterIdLocation= '';

document.addEventListener('DOMContentLoaded', function () {
    arsipTable = initGlobalDatatable('#table_arsip', function () {
        return {
            filter_id_category: currentFilterIdCategory,
            filter_id_location: currentFilterIdLocation,
            filter_id_box_arsip: currentFilterIdBoxArsip,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (arsipTable) arsipTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterIdCategory = $('#filter_id_category').val();
    currentFilterIdLocation = $('#filter_id_location').val();
    currentFilterIdBoxArsip = $('#filter_id_box_arsip').val();
    if (arsipTable) {
        arsipTable.ajax.reload();
    }
}


var title = $('#title_modal').data('title').split('|');


$(document).ready(function() {
    $('#select_id_category').select2({
        dropdownParent: $('#form_arsip')
    });

    $('#select_id_location').select2({
        dropdownParent: $('#form_arsip')
    });

    $('#select_id_box_arsip').select2({
        dropdownParent: $('#form_arsip')
    });
});


function ubah_data(element, id) {
    var form = document.getElementById('form_arsip');
    form.setAttribute('action', BASE_URL + '/master_function/update_arsip');
    $.ajax({
        url: BASE_URL + '/setting_function/get_single/arsip/id',
        method: form.method,
        data: { 
            id: id 
        },
        dataType: 'json',
        success: function (data) {
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.code+')</span>');
            document.getElementById("arsip_file").value = "";
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
            $('select[name="id_category"]').val(data.id_category);
            $('select[name="id_category"]').trigger('change');
            $('select[name="id_location"]').val(data.id_location);
            $('select[name="id_location"]').trigger('change');
            $('select[name="id_box_arsip"]').val(data.id_box_arsip);
            $('select[name="id_box_arsip"]').trigger('change');
            $('input[name="name_file"]').val(data.file);
            $('textarea[name="description"]').val(data.description);
            $('#form_arsip label.file').removeClass('required');
            $('#form_arsip label.file').html('File (Optional)');
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_arsip');
    form.setAttribute('action', BASE_URL + '/master_function/insert_arsip');
    $('#title_modal').html(title[1]);
    document.getElementById("arsip_file").value = "";
    $('#form_arsip input[type="text"]').val('');
    $('#form_arsip label.file').addClass('required');
    $('#form_arsip label.file').html('File');
    $('#form_arsip textarea').val('');
}


function detail_arsip(element, id) {
    $.ajax({
        url: BASE_URL + '/master/detail_arsip',
        method: 'POST',
        data: { 
            id: id 
        },
        cache : false,
        beforeSend: function(){
            $('#display_arsip').html(div_loading);
        },
        success: function (msg) {
            $('#display_arsip').html(msg);
        }
    })
}