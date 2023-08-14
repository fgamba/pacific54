jQuery(document).ready(function($) {
    
    $("#pacific-form-logger").submit(function(e) {
        $("#pacific-form-logger").validate();
        e.preventDefault();
       
        $.ajax({
            type: "POST",
            url: pacific54_ajax.ajax_url,
            data: {
                'action': 'handle_pacific54_form_submission',
                'name'  : $('#pacific-form-logger #name').val(),
                'email' : $('#pacific-form-logger #email').val(),
                'phone' : $('#pacific-form-logger #phone').val(),
                'message' : $('#pacific-form-logger #message').val(),
            },
            dataType: "json",
            encode: true,
          }).success(function (response) {
            if (response.success) {
                $('#response').css('color','#00cc00');
                $('#response').html(response.data);
            } else {
                $('#response').css('color','#cc0000');
                $('#response').html(response.data);
            }
            
          });
    });
});