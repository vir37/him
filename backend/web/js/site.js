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

function isDisabled(elem) {
    if ($(elem).is('[disabled]')) {
        event.stopImmediatePropagation();
        event.preventDefault();
        return false;
    }
    return true;
}

// добавляем постобработку загрузки страницы
window.addEventListener('load', function(){
    if (typeof afterLoad == 'function')
        afterLoad();
});


// отключаем задизабленные линки
$(document).on('click', 'a', function(event){
    return isDisabled(this);
});

$(document).on('change', '#catalogue_select', function(){
    var target = $(this).data('target'),
        url = $(this).data('url');
    if (target != undefined && url != undefined)
        fillSelectData(target, url, {catalogue_id: $(this).val()});
    else
        alert('Не все данные настроены');
});

// На каждый элементс атрибутом data-submit вешаем обработчик события onchange
$('input[data-submitform], select[data-submitform]').each(function(idx, elem){
    var form = $(elem).data('submitform');
    if (form != undefined)
        $(elem).on('change', function(){
            $(form).submit();
        });
});

// Выравнивание высот элементов плитки
$('.catalogue-menu').each(function(){
    var highestBox = 0;
    $('.col-sm-4.col-md-3.col-lg-3').each(function(){
        if($(this).height() > highestBox) {
            highestBox = $(this).height();
        }
    });
    $('.col-sm-4.col-md-3.col-lg-3').height(highestBox);
});
// события начала и окончания pjax
$(document).on('pjax:send', function(){ $('.loader').removeClass('loader-hide').addClass('loader-show'); });
$(document).on('pjax:complete', function(){ $('.loader').removeClass('loader-show').addClass('loader-hide'); });

// работа с Fancybox-окнами
var fancyClickersChain = [],
    fancybox_defaults = {
        type: 'ajax',
        autoSize: false,
        scrolling: 'no',
        beforeShow: function() { this.width = $('.container').width(); }
    },
    fancybox_clickers = { beforeLoad: function() { fancyClickersChain.push(this.element[0]); } };

try {
    $('._fancybox').fancybox($.extend({}, fancybox_defaults, fancybox_clickers ) );
} catch(e) {}

$(document).on('click', '.fancybox-inner a:not([data-fancybox-finish])', function(evt){
    evt.preventDefault();
    $.fancybox($.extend({}, fancybox_defaults, { href: this.href }));
});

function runCallback(callback, event, clicker){
    if (typeof window[callback] === 'function') {
        event.preventDefault();
        event.stopImmediatePropagation();
        window[callback](this, clicker);
    }
}
$(document).on('click', '.fancybox-inner a[data-fancybox-finish]', function(evt){
    var fancyClicker = fancyClickersChain.pop(), that = this;
    $.fancybox.close();
    if (fancyClicker) {
        var callback = $(fancyClicker).data('callback');
        if (fancyClickersChain.length > 0) {
            evt.preventDefault();
            $.fancybox($.extend({}, fancybox_defaults, {
                href: fancyClickersChain[fancyClickersChain.length - 1].href
                ,
                afterShow: function () {
                    runCallback.call(that, callback, evt, fancyClicker);
                }
            }));
        } else
            runCallback.call(that, callback, evt, fancyClicker);
    }
});

$(document).on('submit', '.fancybox-inner form', function(evt){
    var form = $(this).serialize();
    evt.preventDefault();
    $.ajax(this.action, {
        type: 'POST',
        data: form,
        timeout: 10000,
        success: function(data){ $.fancybox($.extend( {}, fancybox_defaults, { content: data}));  },
        error: function(result, str, throwObj) { alert(str);}
    });
});
