loadDataTable();

function loadDataTable() {
    $('.datatable').DataTable({
        paging: false,
        searching: false,
        bLengthChange: false,
        bFilter: true,
        bInfo: false,
    });
}

function redirectTo(url) {
    window.location.href = url;
}
