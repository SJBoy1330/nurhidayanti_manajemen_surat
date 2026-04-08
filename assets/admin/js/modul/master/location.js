let locationTable;

document.addEventListener('DOMContentLoaded', function () {
    locationTable = initGlobalDatatable('#table_location');

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (locationTable) locationTable.ajax.reload();
        });
    });
});

var title = $('#title_modal').data('title').split('|');

function ubah_data(element, id) {
    var form = document.getElementById('form_location');
    form.setAttribute('action', BASE_URL + '/master_function/update_location');
    $('#title_modal').html(title[0]);
    $.ajax({
        url: BASE_URL + '/setting_function/get_single/location/id',
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
    var form = document.getElementById('form_location');
    form.setAttribute('action', BASE_URL + '/master_function/insert_location');
    $('#title_modal').html(title[1]);
    $('#form_location input[type="text"]').val('');
}


