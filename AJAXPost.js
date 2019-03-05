$(document).ready(function(){
    let form = $("#mainform");
    let loading = $('#loading');
    let buttonC = $('#buttonCollapse');
    let formC = $('#formcollapse');
    let tit= $(".tit");
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
                $(tit).hide();
                $(buttonC).hide();
                $(formC).hide();
                $(loading).html("<h4>"+"Post Complete" + "</h4>");
            })
            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(loading).removeClass('success');
                $(loading).addClass('error');

                // Set the message text.
                if (data.responseText !== '') {
                    $(loading).text(data.responseText);
                } else {
                    $(loading).html("<h4>" + 'Oops! An error occurred and your message could not be sent.' + "</h4>");
                }
            });
    });
});
