$(function () {

    let token = $('meta[name="csrf-token"]').attr('content');

    //Datatable Search
    $('#tickets-table thead tr').clone(true).appendTo('#tickets-table thead');

    $('#tickets-table thead tr:eq(1) th').each(function (i) {
        let element = $(this);

        let title = element.text();

        if (title.length < 1) {
            return;
        }

        if (element.data('column') === 'status') {
            element.html($('#select-status').clone().attr('id', 'filter-' + title.toLowerCase()));
        } else {
            element.html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        }

        $('input,select', this).on('keyup change', function () {
            if (dataTable.column(i).search() !== this.value) {
                dataTable
                    .column(i)
                    .search(this.value)
                    .draw();
            }
        });
    });

    let dataTable = $('#tickets-table').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/tickets/datatable',
            type: 'post',
            data: {'_token': token}
        },
        'columnDefs': [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'content', name: 'content'},
            {data: 'tags', name: 'tags', orderable: false},
            {data: 'status', name: 'status'},
            {data: 'created_by', name: 'created_by'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_by', name: 'updated_by'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    dataTable.on('click', '.delete-ticket', function (e) {
        $.ajax({
            url: '/admin/tickets/' + e.currentTarget.dataset.id,
            type: 'DELETE',
            dataType: 'json',
            data: {'_token': token},
            success: function (data) {
                if (responseNotify(data)) {
                    dataTable.row(e.currentTarget).remove().draw(false);
                }
            },
            error: function (data) {
                responseNotify(data);
            }
        });
    });

    $('#save-status').click(function () {
        let selected_status = $('#select-status').val();

        if (!selected_status) {
            responseNotify({status:false, message: 'Select choice to ticket status!'})

            return;
        }

        let ticketContainer = [];

        // Iterate over all selected checkboxes
        dataTable.column(0).checkboxes.selected().each(function (ticketId) {
            // Create a hidden element
            ticketContainer.push(ticketId);
        });

        if (!ticketContainer.length) {
            responseNotify({status:false, message: 'Select tickets!'})

            return;
        }

        $.ajax({
            url: '/admin/tickets/change-tickets-status',
            type: 'POST',
            dataType: 'json',
            data: {
                status: selected_status,
                tickets: ticketContainer,
                _token: token
            },
            success: function (data) {
                if (responseNotify(data)) {
                    dataTable.draw(true);
                }
            },
            error: function (data) {
                responseNotify(data);
            }
        });
    });

    function responseNotify(data) {
        if (data.status) {
            new PNotify({
                title: 'Success',
                text: data.message,
                type: 'success',
                styling: 'bootstrap3'
            });

            return true;
        }

        new PNotify({
            title: 'Something went wrong',
            text: data.message,
            type: 'error',
            styling: 'bootstrap3'
        });

        return false;
    }

    //Select2 Trigger
    $('.select2').select2();
});