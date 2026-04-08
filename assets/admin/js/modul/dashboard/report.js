let reportTable;
let currentFilterStartDate = '';
let currentFilterEndDate = '';

document.addEventListener('DOMContentLoaded', function () {
    reportTable = initGlobalDatatable('#table_report', function () {
        return {
            filter_start_date: currentFilterStartDate,
            filter_end_date: currentFilterEndDate,
        };
    });

    // Trigger reload on each filter
    document.querySelectorAll('.table-filter').forEach(el => {
        el.addEventListener('change', function () {
            if (reportTable) reportTable.ajax.reload();
        });
    });
});



function filter_apply(){
    currentFilterStartDate = $('#filter_start_date').val();
    currentFilterEndDate = $('#filter_end_date').val();
    if (reportTable) {
        reportTable.ajax.reload();
    }
}
