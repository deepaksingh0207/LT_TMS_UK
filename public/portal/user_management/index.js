$(document).ready(function () {
  function loadUsers(pageUrl) {
    $("#loading-overlay").removeClass("hidden");
    $.ajax({
      url: pageUrl,
      method: "GET",
      dataType: "html",
      success: function (response) {
        $("#data-container").html(response);
        $('#data-container input[data-toggle="toggle"]').bootstrapToggle();
        $("#loading-overlay").addClass("hidden");
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", status, error);

        const errorMessage = `
          <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
              <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm text-center">
                  <h3 class="text-lg font-bold text-red-600 mb-4">Error</h3>
                  <p class="text-gray-700 mb-6">Failed to load data. Please try again.</p>
                  <button onclick="$(this).closest('.fixed').remove()" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                      OK
                  </button>
              </div>
          </div>
        `;
        $("body").append(errorMessage);
        $("#loading-overlay").addClass("hidden");
      },
    });
  }

  $(document).on("click", "#data-container .pagination a", function (e) {
    e.preventDefault();
    const pageUrl = $(this).attr("href");
    loadUsers(pageUrl);
  });

  $("#add_user_submit_btn").click(function (e) {
    e.preventDefault();
    let sap_user_code = $("#sap_user_code").val();
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let email_id = $("#email_id").val();
    let group = $("#group").val();

    let input_error = 0;

    if (
      sap_user_code == "" ||
      sap_user_code == undefined ||
      sap_user_code == null
    ) {
      $("#sap_user_code").addClass("form-control-danger");
      $("#sap_user_code").closest(".form-group").addClass("has-danger");
      $("#sap_user_code_feedback").text("Please Enter SAP User Code");
      input_error = 1;
    }

    if (first_name == "" || first_name == undefined || first_name == null) {
      $("#first_name").addClass("form-control-danger");
      $("#first_name").closest(".form-group").addClass("has-danger");
      $("#first_name_feedback").text("Please Enter First Name");
      input_error = 1;
    }

    if (last_name == "" || last_name == undefined || last_name == null) {
      $("#last_name").addClass("form-control-danger");
      $("#last_name").closest(".form-group").addClass("has-danger");
      $("#last_name_feedback").text("Please Enter Last Name");
      input_error = 1;
    }

    if (email_id == "" || email_id == undefined || email_id == null) {
      $("#email_id").addClass("form-control-danger");
      $("#email_id").closest(".form-group").addClass("has-danger");
      $("#email_id_feedback").text("Please Enter Email ID");
      input_error = 1;
    }

    if (group == "" || group == undefined || group == null) {
      $("#group").addClass("form-control-danger");
      $("#group").closest(".form-group").addClass("has-danger");
      $("#group_feedback").text("Please Select Group");
      input_error = 1;
    }

    if (input_error) {
      return;
    }

    let formData = $("#add_user_form").serialize();

    $.ajax({
      type: "POST",
      url: add_user_url,
      data: formData,
      dataType: "json",
      success: function (response) {
        swal({
          title: "Success",
          text: "User is created successfully",
          type: "success",
          showCancelButton: false,
          confirmButtonClass: "btn btn-success",
          // cancelButtonClass: "btn btn-danger",
        });
      },
    });
  });

  $("#bd-example-modal-lg").on("hidden.bs.modal", function () {
    $("#add_user_submit_btn").removeClass('d-none')
    $("#edit_user_submit_btn").addClass('d-none')
  });

  $("#edit_user_submit_btn").click(function(e) {
    e.preventDefault();
    let sap_user_code = $("#sap_user_code").val();
    let first_name = $("#first_name").val();
    let last_name = $("#last_name").val();
    let email_id = $("#email_id").val();
    let group = $("#group").val();

    let input_error = 0;

    if (
      sap_user_code == "" ||
      sap_user_code == undefined ||
      sap_user_code == null
    ) {
      $("#sap_user_code").addClass("form-control-danger");
      $("#sap_user_code").closest(".form-group").addClass("has-danger");
      $("#sap_user_code_feedback").text("Please Enter SAP User Code");
      input_error = 1;
    }

    if (first_name == "" || first_name == undefined || first_name == null) {
      $("#first_name").addClass("form-control-danger");
      $("#first_name").closest(".form-group").addClass("has-danger");
      $("#first_name_feedback").text("Please Enter First Name");
      input_error = 1;
    }

    if (last_name == "" || last_name == undefined || last_name == null) {
      $("#last_name").addClass("form-control-danger");
      $("#last_name").closest(".form-group").addClass("has-danger");
      $("#last_name_feedback").text("Please Enter Last Name");
      input_error = 1;
    }

    if (email_id == "" || email_id == undefined || email_id == null) {
      $("#email_id").addClass("form-control-danger");
      $("#email_id").closest(".form-group").addClass("has-danger");
      $("#email_id_feedback").text("Please Enter Email ID");
      input_error = 1;
    }

    if (group == "" || group == undefined || group == null) {
      $("#group").addClass("form-control-danger");
      $("#group").closest(".form-group").addClass("has-danger");
      $("#group_feedback").text("Please Select Group");
      input_error = 1;
    }

    if (input_error) {
      return;
    }

    let formData = $("#add_user_form").serialize();
    let user_id = $('#user_id').val();

    $.ajax({
      type: "POST",
      url: edit_user_url + '/' + user_id,
      data: formData,
      dataType: "json",
      success: function (response) {
        swal({
          title: "Success",
          text: "User is edited successfully",
          type: "success",
          showCancelButton: false,
          confirmButtonClass: "btn btn-success",
          // cancelButtonClass: "btn btn-danger",
        });
      },
    });

  });
});

function updateUser(user_id, column_name) {
  let value = 0;
  if (column_name == "is_approved") {
    let approvedCheckbox = $("#yesNoSwitch_" + user_id).prop("checked");
    console.log({ approvedCheckbox });
    if (approvedCheckbox) {
      value = 1;
    } else {
      value = 0;
    }
  }

  if (column_name == "active") {
    let activeCheckbox = $("#statusSwitch_" + user_id).prop("checked");
    console.log({ activeCheckbox });
    if (activeCheckbox) {
      value = 1;
    } else {
      value = 0;
    }
  }

  $.ajax({
    type: "POST",
    url: update_user_url,
    data: { user_id: user_id, column_name: column_name, value: value },
    dataType: "json",
    async: false,
    success: function (response) {
      console.log({ response });
    },
  });
}

function editUser(user_id) {
  $.ajax({
    type: "GET",
    url: edit_user_url + '/' + user_id,
    data: {},
    dataType: "json",
    success: function (response) {
      if(response.status) {
        if('data' in response) {
          if(
            'sap_user_code' in response.data && 
            response.data.sap_user_code != 0 &&
            response.data.sap_user_code != '' && 
            response.data.sap_user_code != null && 
            response.data.sap_user_code != undefined
          ) {
            $('#sap_user_code').val(response.data.sap_user_code);
          }

          if(
            'first_name' in response.data && 
            response.data.first_name != 0 &&
            response.data.first_name != '' && 
            response.data.first_name != null && 
            response.data.first_name != undefined
          ) {
            $('#first_name').val(response.data.first_name);
          }

          if(
            'last_name' in response.data && 
            response.data.last_name != 0 &&
            response.data.last_name != '' && 
            response.data.last_name != null && 
            response.data.last_name != undefined
          ) {
            $('#last_name').val(response.data.last_name) ;
          }

          if(
            'email' in response.data && 
            response.data.email != 0 &&
            response.data.email != '' && 
            response.data.email != null && 
            response.data.email != undefined
          ) {
            $('#email_id').val(response.data.email);
          }

          if(
            'group' in response.data && 
            response.data.group != 0 &&
            response.data.group != '' && 
            response.data.group != null && 
            response.data.group != undefined
          ) {
            $('#group').val(response.data.group);
          }

          $("#user_id").val(user_id);

          $("#myLargeModalLabel").text('Edit User');
          $("#add_user_submit_btn").addClass('d-none')
          $("#edit_user_submit_btn").removeClass('d-none')
          $("#bd-example-modal-lg").modal("show");
        }
      }
    }
  });
}
