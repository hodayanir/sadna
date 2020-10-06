$("#changePassForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            data = JSON.parse(data)
            if(data['response'] === "Success"){
                window.location = "/my_area.php";

            }
            if(data['response'] === "Fail"){
                $('#formError').removeClass('text-hide')
                $('#formError').text(data['msg'])

            }
        }
    });


});