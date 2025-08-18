$(document).ready(function () {
  // Function to load data via AJAX
  function loadUsers(pageUrl) {
    $("#loading-overlay").removeClass("hidden"); // Show loading spinner
    $.ajax({
      url: pageUrl,
      method: "GET", // Or POST, depending on your controller setup
      dataType: "html", // Expect HTML back for the partial view
      success: function (response) {
        $("#data-container").html(response); // Update the content
        $("#loading-overlay").addClass("hidden"); // Hide loading spinner
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", status, error);
        // Implement a custom message box instead of alert()
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
        $("#loading-overlay").addClass("hidden"); // Hide loading spinner on error
      },
    });
  }

  // Delegate click events for pagination links to the #data-container
  // This ensures new pagination links loaded via AJAX are also clickable
  $(document).on("click", "#data-container .pagination a", function (e) {
    e.preventDefault(); // Prevent default link behavior
    const pageUrl = $(this).attr("href"); // Get the URL from the clicked link
    loadUsers(pageUrl); // Load new data
  });
});

function updateUser(user_id , column_name) {
    let value = 0;
    if(column_name == 'is_approved') {
        value = $('#yesNoSwitch').prop('checked');
    }

    if(column_name == 'is_approved') {
        value = $('#statusSwitch').prop('checked');
    }

    $.ajax({
        type: "POST",
        url: update_user_url,
        data: {user_id : user_id , column_name : column_name , value : value},
        dataType: "json",
        async:false,
        success: function (response) {
            console.log({response});
        }
    });
}