// Format options
var optionFormat = function(item) {
    if ( !item.id ) {
        return item.text;
    }

    var div = document.createElement('div');
    div.classList.add('d-flex');
    div.classList.add('align-items-center');
    var imgUrl = item.element.getAttribute('data-kt-select2-user');
    var template = '';

    template += `<div style="width : 30px;height : 30px;background-image : url('`+imgUrl+`');background-size : cover;background-position : center;background-repeat : no-repeat;border-radius : 100%;margin-right : 10px;"></div>`;
    template += item.text;

    div.innerHTML = template;

    return $(div);
}

// Init Select2 --- more info: https://select2.org/
$('#select_employee').select2({
    templateSelection: optionFormat,
    templateResult: optionFormat
});

var fp = $("#tanggal_cuti").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    mode: "range",
    minDate: new Date()
});

function cuties_form(element) {
    var value = $(element).val(); // Ambil value dari select

    // Ambil data-tanggal dari option yang dipilih
    var selectedDate = $(element).find('option:selected').data('tenggat'); // Ambil data-tanggal dari option yang dipilih

    // Reset flatpickr dan textarea
    $("#tanggal_cuti")[0]._flatpickr.clear();
    $('textarea[name="description"]').val('');

    // Jika ada pilihan, tampilkan elemen yang diperlukan
    if (value != '') {
        $('#req_date').removeClass('d-none');
        $('#req_description').removeClass('d-none');
        
        // Set maxDate flatpickr berdasarkan data-tanggal yang dipilih
        $('#tanggal_cuti')[0]._flatpickr.set("maxDate", selectedDate);  // Set maxDate
    } else {
        $('#req_date').addClass('d-none');
        $('#req_description').addClass('d-none');
    }
}



function cancel_cuties(id_cuti) {
    Swal.fire({
        html: "Are sure to cancel this submission? ",
        icon: 'question',
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            $.ajax({
                url: BASE_URL + '/submission/canceled',
                method: 'POST',
                data: { 
                    _token : csrf_token,
                    id: id_cuti},
                cache: false,
                dataType: 'json',
                beforeSend: function(){
                    showLoading('Loading...');
                },
                success: function (data) {
                    if (data.alert) {
                        var wdwd = data.alert.width;
                        if (!wdwd) {
                            wdwd = null;
                        }
                        if (data.status == true) {
                            var icon = 'success';
                        }else{  
                            var icon = 'warning';
                        }
                        sessionStorage.setItem('isReload', 'true');
                        sessionStorage.setItem('alert_icon', icon);
                        sessionStorage.setItem('alert_message', data.alert.message);
                        sessionStorage.setItem('alert_width', wdwd);
                    }
                    custom_reload();
                }
            })
        }
    }));
}
let submissionTable;
let currentFilterStatus = '';

document.addEventListener('DOMContentLoaded', function () {
    submissionTable = initGlobalDatatable('#table_submission', function () {
        return {
            filter_status: currentFilterStatus,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (submissionTable) submissionTable.ajax.reload();
        });
    });
});



// Trigger reload saat filter diubah
function filter_status(element) {
    currentFilterStatus = element.value;
    if (submissionTable) {
        submissionTable.ajax.reload();
    }
}
