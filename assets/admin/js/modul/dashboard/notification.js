let notificationTable;
let currentFilterStartDate = '';
let currentFilterEndDate = '';

document.addEventListener('DOMContentLoaded', function () {
    notificationTable = initGlobalDatatable('#table_notification', function () {
        return {
            filter_start_date: currentFilterStartDate,
            filter_end_date: currentFilterEndDate,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (notificationTable) notificationTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterStartDate = $('#filter_start_date').val();
    currentFilterEndDate = $('#filter_end_date').val();
    if (notificationTable) {
        notificationTable.ajax.reload();
    }
}

function read_switch(element, e, id) {
    // console.log(two);
    var url = BASE_URL + 'dashboard_function/read_notification';
    e.preventDefault();
    const icon = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = ucfirst('Apakah anda yakin akan membuka akses data ini?');
    } else {
        var value = 'N';
         var type = "textarea";
        var message = ucfirst('Apakah anda yakin akan menutup akses dari data ini ?');
    }
    Swal.fire({
        text: message,
        icon: icon,
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
                url: url,
                method: 'POST',
                data: { 
                    id: id, 
                    action: value, 
                },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if (data.status == 200 || data.status == true) {

                        if (value == 'Y') {
                            $('#switch-' + id).prop('checked', true);
                        } else {
                            $('#switch-' + id).prop('checked', false);
                        }

                        if (data.alert) {
                            var wdwd = data.alert.width;
                            if (!wdwd) {
                                wdwd = null;
                            }
                            Swal.fire({
                                html: data.alert.message,
                                icon: data.alert.icon,
                                width : wdwd,
                                buttonsStyling: !1,
                                confirmButtonText: 'Lanjutkan',
                                customClass: { confirmButton: css_btn_confirm }
                            });
                        }
                    } else {

                        if (value == 'Y') {
                            $('#switch-' + id).prop('checked', true);
                        } else {
                            $('#switch-' + id).prop('checked', false);
                        }
                        var wdwd = data.alert.width;
                        if (!wdwd) {
                            wdwd = null;
                        }
                        Swal.fire({
                            html: data.alert.message,
                            icon: data.alert.icon,
                            buttonsStyling: !1,
                            width : wdwd,
                            confirmButtonText: 'Lanjutkan',
                            customClass: { confirmButton: css_btn_confirm }
                        });
                    }


                }
            })
        } else {

            if (value == 'Y') {
                $('#switch-' + id).prop('checked', false);
            } else {
                $('#switch-' + id).prop('checked', true);
            }

        }
        notificationTable.ajax.reload();
    }));

}