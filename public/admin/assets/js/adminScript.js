$(document).ready(function() {
    var base_url = $('#base_url').text();
    // alert(base_url);
    $(document).on('change', '.status-checkbox', function () {
        var value = $(this).val();
        var status = $(this).prop('checked') ? 1 : 0; // 1 if checked, 0 if unchecked
        var parts = value.split("#");
        // Access the split parts
        var model_id = parts[0]; 
        var add_type_name = parts[1];
        var emp_id = parts[2]; 
        // alert(status + "-"+model_id + "-"+ add_type_name + "-"+ emp_id); return false;
        $.ajax({
            url: base_url+ "admin/permission/" + emp_id,
            method: "POST",
            data: {
                model_id: model_id,
                add_type_name: add_type_name,
                status: status
            },
            success: function (response) {
                if (response == true) {
                    alert('Status updated successfully');
                } else {
                    alert(response);
                }
            },
            error: function () {
                alert('Error in request');
            }
        });
    });
});
