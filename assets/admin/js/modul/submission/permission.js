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


let permissionTable;
let currentFilterStatus = '';
let currentFilterType = '';
let currentFilterStartDate = '';
let currentFilterEndDate = '';

document.addEventListener('DOMContentLoaded', function () {
    permissionTable = initGlobalDatatable('#table_permission', function () {
        return {
            filter_status: currentFilterStatus,
            filter_type: currentFilterType,
            filter_start_date: currentFilterStartDate,
            filter_end_date: currentFilterEndDate,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (permissionTable) permissionTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterStatus = $('#filter_status').val();
    currentFilterType = $('#filter_type').val();
    currentFilterStartDate = $('#filter_start_date').val();
    currentFilterEndDate = $('#filter_end_date').val();
    if (permissionTable) {
        permissionTable.ajax.reload();
    }
}




function approved_submission(element,id,sts = 'N',text) {
    var datatable = $(element).data('datatable');
    Swal.fire({
        html: "Apakah anda yakin akan <b>"+text+"</b> pengajuan ini?",
        icon: 'question',
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            $.ajax({
                url: BASE_URL + 'submission_function/approval/permission/id_permission',
                method: 'POST',
                data: { 
                    id: id,
                    status: sts
                },
                cache: false,
                dataType: 'json',
                beforeSend: function(){
                    showLoading('Tunggu sebentar...');
                },
                success: function (data) {
                    if (data.status == true) {
                        var icon = 'success';
                    }else{  
                        var icon = 'warning';
                    }
                    hideLoading();
                    var table = $('#'+datatable).DataTable();
                    table.ajax.reload(null, false);
                    if (data.alert) {
                        
                        Swal.fire({
                            html: data.alert.message,
                            icon: icon,
                            buttonsStyling: !1,
                            confirmButtonText: 'Lanjutkan',
                            customClass: {
                                confirmButton: css_btn_confirm
                            },
                        })
                    }
                }
            })
        }
    }));
}