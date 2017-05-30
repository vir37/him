/**
 * Created by user on 30.05.2017.
 */
$(document).ready(function(){
    $(document).on('click', '.fancybox', function(event){
        event.preventDefault();
        $.fancybox.open(this, { type: 'ajax', padding: 1  });
        $(document).on('submit', '#contact-form', function(event){
            var form = $(this).serialize();
            event.preventDefault();
            event.stopImmediatePropagation();
            $(this).closest('.site-contact').find('.disabler').show();
            $.ajax(this.action, {
                type: 'POST',
                data: form,
                timeout: 10000,
                success: function(data){
                    if (data.alert)
                        $('#alert-box').html(data.alert);
                },
                error: function(result, str) { },
                complete: function(response, status){
                    $.fancybox.close();
                }
            });
        })
    });
});