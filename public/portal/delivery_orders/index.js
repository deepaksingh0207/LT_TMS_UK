$(document).ready(function () {
    $(document).on('click', '#head_master_table .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.get(url, function(response) {
            $('#head_master_table').html(response);
        });
    });
});