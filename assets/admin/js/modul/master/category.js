let categoryTable;

document.addEventListener('DOMContentLoaded', function () {
    categoryTable = initGlobalDatatable('#table_category');

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (categoryTable) categoryTable.ajax.reload();
        });
    });
});




var title = $('#title_modal').data('title').split('|');

function ubah_data(element, id) {
    var form = document.getElementById('form_category');
    form.setAttribute('action', BASE_URL + '/master_function/update_category');
    $.ajax({
        url: BASE_URL + '/setting_function/get_single/category/id',
        method: form.method,
        data: { 
            id: id 
        },
        dataType: 'json',
        success: function (data) {
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.code+')</span>');
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_category');
    form.setAttribute('action', BASE_URL + '/master_function/insert_category');
    $('#title_modal').html(title[1]);
    $('#form_category input[type="text"]').val('');
    $('#form_category textarea').val('');
}


