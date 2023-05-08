/**
 * Init datatables.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const tables = document.querySelectorAll('.table-datatable');
    if (!tables) {
        return;
    }

    class KUdatatable {
        constructor(table) {
            this.datatable = table;
            this.initDatatable();
        }

        initDatatable() {
            this.datatable = new DataTable(this.datatable, {
                responsive: true,
                language: { url: getLang() }
            });
        }

    }

    Array.from(tables).forEach((table) => {
        const tableEl = new KUdatatable(table);
    });

});
