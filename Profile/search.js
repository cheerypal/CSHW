$(document).ready(function(){
    let searchT = $('#searchText');
    let result = $('#result');
    $(result).hide();
    $(searchT).keyup(function(){
        let value = $('#searchText').val();
        if(value != ""){
            $(result).empty();
            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: {searchText: value},
                dataType: 'JSON',
                success:function(response){
                    $(result).show();
                    $.each(response, function(index){

                        $(result).append('<ul>' +
                            '<li><span onclick="document.getElementById(\'searchText\').value ='+ "' " + response[index].topic +"'.trim()" + '">'+ response[index].topic + '</a></li>' +
                            '</ul>'
                        );
                    });
                }
            });

        }else{

            $(result).html('');
            $(result).hide();
        }
    });
});
