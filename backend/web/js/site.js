/**
 * Created by admin on 29.01.2017.
 */

function fillSelectData(target, dataUrl, dataFilters){
    if (baseUrl && dataUrl[0] == '/')
        dataUrl = baseUrl + dataUrl;
    $.ajax(dataUrl, {
        dataType: 'json',
        data: dataFilters,
        beforeSend: function(data, settings){
            $('.loader-hide').removeClass('loader-hide').addClass('loader-show');
        },
        success: function(data, status){
            var defaults = [];
            $(target).children('option').each(function(idx, elem){
                if (!$(elem).val()) {
                    defaults[defaults.length] = {id: undefined, name: $(elem).text()};
                }
            });
            $(target).children('option').remove();
            var opts = defaults.concat(data);
            opts.forEach(function(elem, idx, opts){
                $(target).each(function(id, el){
                    var _ =  ! elem.id ?'<option value>' : '<option value="' + elem.id + '">';
                    $(el).append(_+elem.name+'</option>');
                });
            })
        },
        error: function(data, status, e){
            alert('Request error');
        },
        complete: function(data, status){
            $('.loader-show').removeClass('loader-show').addClass('loader-hide');
        }
    })
}
// Tweeks
/* Disable JQuery-UI on selected elements*/
function disableJqueryUI(selector, types){
    types.forEach(function(elem, idx, arr){
        $(document).on(elem+'create', selector, function(event, ui){
            try {
                $(this)[elem]('destroy');
            } catch(e){}
        });
    })
}

disableJqueryUI('.jquery-ui-disable', ['button']);
$('#catalogue_select').on('change', function(){
    var target = $(this).data('target')
    if (target != undefined)
       fillSelectData(target, '/category/list', {catalogue_id: $(this).val()});
    else
        alert('Цель заполнения не назначена');
});
// На каждый элементс атрибутом data-submit вешаем обработчик события onchange
$('input[data-submitform], select[data-submitform]').each(function(idx, elem){
    var form = $(elem).data('submitform');
    if (form != undefined)
        $(elem).on('change', function(){
            $(form).submit();
        });
});