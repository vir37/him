/**
 * Created by admin on 29.01.2017.
 */

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