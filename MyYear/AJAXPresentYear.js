$(document).ready(function(){
    let items = $('#posts');
    let form = $('#mainform');
    let year = $('#year').val();
    $(form).submit(function(event){
        event.preventDefault();
        $(items).empty();
        setTimeout(function(){$.ajax({
            type: 'POST',
            url: 'getYearPosts.php',
            data: {yearNo: year},
            dataType: "JSON",
            success: function(response){
                console.log(response);
                $.each(response, function (index) {
                    $(items).append("<div class=\"media\">\n" +
                        "                                    <div class=\"media-left\">\n" +
                        "                                        <img src=" + response[index].pic + " alt=\"Profile Picture\" class=\"media-object\" style=\"width:60px;\">\n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"media-body\">\n" +
                        "                                        <h4 class=\"media-heading\">"+ response[index].topic.replace(/</g, "&lt;").replace(/>/g, "&gt;") +"</h4>\n" +
                        "                                        <h5 class=\"media-heading\"><small>"+ response[index].tags +"</small></h5>\n" +
                        "                                        <h5 class=\"media-heading\"><a href=\"#\"><small>"+ response[index].username.replace(/</g, "&lt;").replace(/>/g, "&gt;") + " year" + response[index].years + "</small></a></h5>\n" +
                        "                                        <p>"+response[index].description.replace(/</g, "&lt;").replace(/>/g, "&gt;") +"<br><small>Posted: "+ response[index].timeOfPost +" "+ response[index].dateOfPost +"</small> </p>\n" +
                        "                                    </div>\n" +
                        "                                </div>")

                })
            }
        })}, 1000);
    });
});