// Call the dataTables jQuery plugin

$(document).ready(function () {
    $.fn.dataTable.moment('D MMMM YYYY', 'id');
    $('#dataTicketadm').DataTable();
    $('#dataLapangan').DataTable({
        "ordering": false,
        "oLanguage": {
            "sEmptyTable": "Anda belum pernah mengajukan penelitian di kategori ini"
        },

    });


    // KHUSUS UNTUK DATA SURAT MASUK
    var table = $('#dataSurat').DataTable({
        initComplete: function () {
            this.api().columns(6).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Keterangan</option></select>')
                    .appendTo("#buttonContainer .select-text")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();

                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },

        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },
            buttons: [{
                extend: 'excel',
                footer: false,
                className: 'btn btn-success btn-icon-split',
                // titleAttr: 'Excel export.',
                text: '<span class="icon text-white-50">\n' +
                '                                            <i class="fas fa-table"></i>\n' +
                '                                        </span>\n' +
                '                                        </span>\n' +
                '                    <span class="text">Ekspor Excel</span>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    modifier: {order: 'index'}
                },
            }],
        }

    });
    table.order([0, 'desc']).draw();
    table.buttons().container()
        .appendTo('#btnContainerLeft');

    var tableObservasi = $('#dataObservasi').DataTable({
        initComplete: function () {
            this.api().columns(7).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Bulan</option></select>')
                    .appendTo("#buttonContainer .bulan")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();

                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
            this.api().columns(8).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Tahun</option></select>')
                    .appendTo("#buttonContainer .tahun")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();

                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },
        "ordering": false,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },
            buttons: [{
                extend: 'excel',
                footer: false,
                className: 'btn btn-success btn-icon-split',
                // titleAttr: 'Excel export.',
                text: '<span class="icon text-white-50">\n' +
                '                                            <i class="fas fa-table"></i>\n' +
                '                                        </span>\n' +
                '                    <span class="text">Ekspor Excel</span>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                },
            }],
        }

    });
    tableObservasi.buttons().container().appendTo('#buttonContainer');

    var tableSkripsi = $('#dataTerimaSkripsi').DataTable({
        initComplete: function () {
            this.api().columns(4).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Bulan</option></select>')
                    .appendTo("#buttonContainer .bulan-tahun")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
            this.api().columns(7).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Status</option></select>')
                    .appendTo("#buttonContainer .status")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },
        "scrollX": true,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },
            buttons: [{
                extend: 'excel',
                footer: false,
                className: 'btn btn-success btn-icon-split',
                // titleAttr: 'Excel export.',
                text: '<span class="icon text-white-50">\n' +
                '                                            <i class="fas fa-table"></i>\n' +
                '                                        </span>\n' +
                '                    <span class="text">Ekspor Excel</span>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7],
                },
            }],
        }

    });
    tableSkripsi.buttons().container()
        .appendTo('#buttonContainer');

    var tableTrimSeminar = $('#dataTerimaSeminar').DataTable({
            initComplete: function () {
                this.api().columns(5).every(function () {
                    var column = this;

                    var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Status</option></select>')
                        .appendTo("#buttonContainer .status")
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            },
            "scrollX": true,
            dom: 'Blfrtip',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                },
                buttons: [{
                    extend: 'excel',
                    footer: false,
                    className: 'btn btn-success btn-icon-split',
                    // titleAttr: 'Excel export.',
                    text: '<span class="icon text-white-50">\n' +
                    '                                            <i class="fas fa-table"></i>\n' +
                    '                                        </span>\n' +
                    '                    <span class="text">Ekspor Excel</span>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5],
                    },
                }],
            }

        });
        tableTrimSeminar.buttons().container()
            .appendTo('#buttonContainer');


    var tabelJadwal = $('#dataJadwal').DataTable({
        initComplete: function () {
            this.api().columns(12).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Bulan</option></select>')
                    .appendTo("#buttonContainer .bulan")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
            this.api().columns(13).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Tahun</option></select>')
                    .appendTo("#buttonContainer .tahun")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
            this.api().columns(16).every(function () {
                var column = this;

                var select = $('<select class="browser-default custom-select" style="padding-left: 3px;"><option value="">Status</option></select>')
                    .appendTo("#buttonContainer .status")
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },
        "scrollX": true,
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },

            buttons: [{
                extend: 'excel',
                footer: false,
                className: 'btn btn-success btn-icon-split',
                // titleAttr: 'Excel export.',
                text: '<span class="icon text-white-50">\n' +
                '                                            <i class="fas fa-table"></i>\n' +
                '                                        </span>\n' +
                '                    <span class="text">Ekspor Excel</span>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 14, 15, 16],
                },
            }],
        }

    });
    tabelJadwal.order([11, 'desc']).draw();
    tabelJadwal.buttons().container()
        .appendTo('#buttonContainer');


});
