/**
 * Init datatables.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const tables = document.querySelectorAll('.table-datatable');

    class KUdatatable {
        constructor(table) {
            this.datatable = table;
            this.initDatatable();
        }

        initDatatable() {
            /**
            * Check if Datatables plugin exist
            */
            if (typeof DataTable === 'undefined') {
                return;
            }

            /**
             * Check if tables exist
             */
            
            if (!tables) {
                return;
            }

            /**
             * Init Datatables
             */
            this.datatable = new DataTable(this.datatable, {
                responsive: true,
                language: {
                    url: getLang()
                }
            });
        }
    }

    Array.from(tables).forEach((table) => {
        const tableEl = new KUdatatable(table);
    });

});
