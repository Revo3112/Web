function initDataTable(selector) {
    let table = new DataTable(selector, {
        searchable: true,
        sortable: true,
        perPage: 5,
        perPageSelect: false,
        layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: ['csv', 'excel', 'pdf']
                    }
                ]
            }
        }
    });
}
