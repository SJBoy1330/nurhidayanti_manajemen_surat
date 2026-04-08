let adminTable;
let currentFilterStatus = '';

document.addEventListener('DOMContentLoaded', function () {
    adminTable = initGlobalDatatable('#table_admin', function () {
        return {
            filter_status: currentFilterStatus,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (adminTable) adminTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterStatus = $('#filter_status').val();
    if (adminTable) {
        adminTable.ajax.reload();
    }
}



var image = document.getElementById('display_image');
var title = $('#title_modal').data('title').split('|');
$(function () {

    $('.hps_image').on('click', function () {
        // console.log('hapus');
        $('input[name=name_image]').val("");
    });

});

function ubah_data(element, id) {
    var foto = $(element).data('image');
    var form = document.getElementById('form_admin');
    form.setAttribute('action', BASE_URL + '/master_function/update/admin');
    $.ajax({
        url: BASE_URL + '/setting_function/get_single/users/id',
        method: form.method,
        data: { 
            id: id 
        },
        dataType: 'json',
        success: function (data) {
            $('#title_modal').html(title[0] + ' <span class="text-primary">('+data.code+')</span>');
            image.style.backgroundImage = "url('" + foto + "')";
            document.getElementById("admin_file").value = "";
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="username"]').val(data.username);
            $('input[name="name_image"]').val(data.image);
            $('#form_admin label.password').removeClass('required');
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_admin');
    form.setAttribute('action', BASE_URL + '/master_function/tambah/admin');
    $('#title_modal').html(title[1]);
    image.style.backgroundImage = "url('" + user_base_foto + "')";
    document.getElementById("admin_file").value = "";
    $('#form_admin input[type="text"]').val('');
    $('#form_admin label.password').addClass('required');
    $('#form_admin textarea').val('');
}


