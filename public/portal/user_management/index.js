$(document).ready(function () {
  function loadUsers(pageUrl) {
    $("#loading-overlay").removeClass("hidden");
    $.ajax({
      url: pageUrl,
      method: "GET",
      dataType: "html",
      success: function (response) {
        $("#data-container").html(response);
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
