$(document).ready(function () {
     $(document).on('click', '#trolley_master_table .pagination a', function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $.get(url, function(response) {
            $('#trolley_master_table').html(response);
        });
    });
});

function get_trolley_master_data() {
    $.ajax({
        type: "GET",
        url: get_trolley_master_data_url,
        data: {},
        dataType: "",
        success: function (response) {
            $('#trolley_master_table').html(response);
        }
    });
}

function add_trolley_master() {
    let formData = $('#trolley_master_form').serialize();
    let formDataArray = $('#trolley_master_form').serializeArray();

    console.log({formData});
    console.log({formDataArray});

    let input_error = 0;
    
    $.each(formDataArray, function (index, value) { 
        console.log({index,value});
        if(value.value == '' || value.value == null || value.value == undefined) {
            $("#"+value.name).addClass("form-control-danger");
            $("#"+value.name).closest(".form-group").addClass("has-danger");
            $("#"+value.name+"_feedback").text("This field cannot be empty");
            input_error = 1;
        }
    });
    
    if (input_error) {
        return;
    }

    $.ajax({
        type: "POST",
        url: add_trolley_master_url,
        data: formData,
        dataType: "json",
        success: function (response) {
            if(response.status) {
                get_trolley_master_data();
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
                    text: response.message,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonClass: "btn btn-success",
                    // cancelButtonClass: "btn btn-danger",
                });
            }
        }
    });

    
}