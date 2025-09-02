$(document).ready(function () {
    $(document).on('click', '#delivery_orders_table .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.get(url, function(response) {
            $('#delivery_orders_table').html(response);
        });
    });

    $('#yes_confirm_btn').click(function (e) { 
        e.preventDefault();

        $('#confirmation-modal').modal('hide');

        let order_ids = [];
        let transporter_id = $("#transporter_id").val();

        if(transporter_id == '' || transporter_id == null || transporter_id == undefined) {
            swal({
                title: "Error",
                text: "Transporter was not selected. Please select",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn btn-success",
                // cancelButtonClass: "btn btn-danger",
            });

            return;
        }
        $('.order-checkbox').each(function (index, element) {
            // element == this
            if($(element).prop('checked')) {
                order_ids.push($(element).val());
            }
        });

        if(order_ids.length) {
            $.ajax({
                type: "POST",
                url: assign_transporter_url,
                data: {transporter_id : transporter_id , order_ids : order_ids},
                dataType: "json",
                beforeSend: function() {
                    
                },
                success: function (response) {
                    $('#delivery_orders_table .pagination li.page-item.active a').trigger('click');
                    if(response.status) {
                        swal({
                            title: "Success",
                            text: response.message,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn btn-success",
                            // cancelButtonClass: "btn btn-danger",
                        });
                    }
                    else {
                        swal({
                            title: "Error",
                            text: "Transporter Not Assigned to selected orders",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonClass: "btn btn-success",
                            // cancelButtonClass: "btn btn-danger",
                        });
                    }
                }
            });
        }
        else {
            swal({
                title: "Error",
                text: "Please select order to assign transporter",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn btn-success",
                // cancelButtonClass: "btn btn-danger",
            });

            return;
        }
    });
});