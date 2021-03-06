$("#loginForm").submit(function(e) {

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

                let link = '/index.html'
                if (data['user_type'] === 'teachers'){
                    link = '/teacherDashboard.php'
                }

                if (data['user_type'] === 'students'){
                    link = '/studentDashboard.php'
                }
                window.location = link;

            }
            if(data['response'] === "Fail"){
                $('#formError').removeClass('text-hide')

            }
        }
    });


});