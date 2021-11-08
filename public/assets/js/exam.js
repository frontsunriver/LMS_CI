/******/
(() => { // webpackBootstrap
    /******/
    "use strict";
    var __webpack_exports__ = {};
    /*!******************************************************************************!*\
      !*** ../demo1/src/js/pages/crud/datatables/data-sources/ajax-server-side.js ***!
      \******************************************************************************/

    var ExamTable = function() {

        var initTable1 = function() {
            var table = $('#example');
            // begin first table
            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'users/getUserList',
                    type: 'POST',
                    headers: {
                        'x-csrf-token': app_main.csrfName,
                    },
                    data: {
                        // parameters for custom backend script demo
                        // columnsDef: [
                        //     'email', 'name',
                        //     'subscription', 'expire_date', 'total_revenue',
                        //     'credit', 'status', 'Actions'
                        // ],
                    },
                },
                columns: [
                    { data: 'title' },
                    { data: 'content' },
                    { data: null },
                ],
                columnDefs: [{
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
                        },
                    },
                ],
            });
        };

        return {
            //main function to initiate the module
            init: function() {
                initTable1();
            },

        };

    }();

    jQuery(document).ready(function() {
        ExamTable.init();
    });

    /******/
})();
//# sourceMappingURL=ajax-server-side.js.map