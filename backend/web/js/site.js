/**
 * Created by admin on 29.01.2017.
 */

function fillSelectData(target, dataUrl, dataFilters){
    $.ajax(dataUrl, {
        dataType: 'json',
        data: dataFilters,
        success: function(data, status){
            $(target).children('option').each(function(idx, elem){
                alert($(elem).val())
            })
        },
        error: function(data, status, e){
            alert('Request error');
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
$('#catalogue-id').on('select', function(){
    alert('hello');
    fillSelectData('#category-parent_id', 'category/list', {catalogue_id: 1});
});