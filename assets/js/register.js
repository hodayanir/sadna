$("#registerForm").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    $('#formError').addClass('text-hide')
    let form = $(this);
    let url = form.attr('action');

    let validateForm = false;
    let pass = $('#password').val()
    let confirm = $('#confirmPassword').val()
    if (pass == confirm) {
        validateForm = true;
    }

    if (validateForm) {
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                data = JSON.parse(data)
                if(data['response'] === "Success") {

                    let link = '/index.html'
                    if (data['user_type'] === 'teachers') {
                        link = '/teacherDashboard.php'
                    }

                    if (data['user_type'] === 'students') {
                        link = '/studentDashboard.php'
                    }
                    window.location = link;
                }
                if (data['response'] === "Fail") {
                    $('#formError').removeClass('text-hide')
                    $('#formError').text(data['msg'])
                }
            }
        });
    }
    else {
        $('#formError').removeClass('text-hide')
        $('#formError').text('Passwords do not match')
    }


});