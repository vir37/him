/**
 * Created by user on 26.06.2017.
 */
$(document).on('click', 'a', function(event){
    parent.$('body').trigger('fancy:click', this );
});