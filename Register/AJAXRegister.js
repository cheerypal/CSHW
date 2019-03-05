$(document).ready(function(){
let form = $("#mainform");
let loading = $('#loading');
let tit= $(".tit");
    $(form).submit(function(event){
    event.preventDefault();
    var formData = $(form).serialize();
    $.ajax({
        type : 'POST',
        url : $(form).attr('action'),
        data : formData,
    })
        .done(function(response) {
            // Make sure that the formMessages div has the 'success' class.
            $(loading).removeClass('error');
            $(loading).addClass('success');
            $(loading).text(response);
            $(form).hide();
            $(tit).hide();
            $(loading).html("<h3>"+ "<a href='http://www2.macs.hw.ac.uk/~ejg9/CSHW/Login/'>" + "You are now a registered member of CSHW! Login now" + "</a>"+"</h3>");
        })
        .fail(function(data) {
            // Make sure that the formMessages div has the 'error' class.
            $(loading).removeClass('success');
            $(loading).addClass('error');

            // Set the message text.
            if (data.responseText !== '') {
                $(loading).text(data.responseText);
            } else {
                $(loading).html("<h1>" + 'Oops! An error occurred and your message could not be sent.' + "</h1>");
            }
        });
});
});