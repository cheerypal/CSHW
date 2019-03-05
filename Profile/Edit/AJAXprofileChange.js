$(document).ready(function(){
    let form = $("#pro");
    let loading = $('#out');
    $(form).submit(function(event){
        event.preventDefault();
        var formData = $(form).serialize();
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
        })
            .done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                $(loading).removeClass('error');
                $(loading).addClass('success');
                $(loading).text(response);
                $(form).hide();
                $(loading).html("<h4>"+"Profile Pic Changed" + "</h4>");
            })
            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(loading).removeClass('success');
                $(loading).addClass('error');

                // Set the message text.
                if (data.responseText !== '') {
                    $(loading).text(data.responseText);
                } else {
                    $(loading).html("<h4>" + 'Oops! An error occurred!' + "</h4>");
                }
            });
    });
});