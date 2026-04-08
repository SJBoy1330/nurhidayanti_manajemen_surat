let box_arsipTable;

document.addEventListener('DOMContentLoaded', function () {
    box_arsipTable = initGlobalDatatable('#table_box_arsip');

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (box_arsipTable) box_arsipTable.ajax.reload();
        });
    });
});

var title = $('#title_modal').data('title').split('|');

function ubah_data(element, id) {
    var form = document.getElementById('form_box_arsip');
    form.setAttribute('action', BASE_URL + '/master_function/update_box_arsip');
    $('#title_modal').html(title[0]);
    $.ajax({
        url: BASE_URL + '/setting_function/get_single/box_arsip/id',
        method: 'POST',
        data: { 
            id: id 
        },
        dataType: 'json',
        success: function (data) {
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="code"]').val(data.code);
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_box_arsip');
    form.setAttribute('action', BASE_URL + '/master_function/insert_box_arsip');
    $('#title_modal').html(title[1]);
    $('#form_box_arsip input[type="text"]').val('');
}


