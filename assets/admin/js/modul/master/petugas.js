let petugasTable;
let currentFilterStatus = '';

document.addEventListener('DOMContentLoaded', function () {
    petugasTable = initGlobalDatatable('#table_petugas', function () {
        return {
            filter_status: currentFilterStatus,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (petugasTable) petugasTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterStatus = $('#filter_status').val();
    if (petugasTable) {
        petugasTable.ajax.reload();
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
    var form = document.getElementById('form_petugas');
    form.setAttribute('action', BASE_URL + '/master_function/update/petugas');
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
            document.getElementById("petugas_file").value = "";
            $('input[name="id"]').val(data.id);
            $('input[name="name"]').val(data.name);
            $('input[name="username"]').val(data.username);
            $('input[name="name_image"]').val(data.image);
            $('#form_petugas label.password').removeClass('required');
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_petugas');
    form.setAttribute('action', BASE_URL + '/master_function/tambah/petugas');
    $('#title_modal').html(title[1]);
    image.style.backgroundImage = "url('" + user_base_foto + "')";
    document.getElementById("petugas_file").value = "";
    $('#form_petugas input[type="text"]').val('');
    $('#form_petugas label.password').addClass('required');
    $('#form_petugas textarea').val('');
}


