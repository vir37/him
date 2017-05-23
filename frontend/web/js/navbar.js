/**
 * Created by admin on 22.04.2017.
 */
NavBar = function() {
    this.city_chooser = null;

};
NavBar.prototype.init = function(){
    this.city_chooser = $('.city-chooser a');
    debugger;
    if (this.city_chooser) {
        $(this.city_chooser).each(function(idx, elem){
            var position = $(elem).offset(),
                data = $(elem).data('cities');
            if (data) {
                $(data).offset({top: position.top + $(elem).height() + 20, left: position.left});
                $(document).click(function (event) {
                    if ($(event.target).closest(data).length)
                        return;
                    $(data).fadeOut();
                    event.stopPropagation()
                });
            }
        });
        $(this.city_chooser).on('click', function(event){
            var data = $(this).data('cities');
            $(data).fadeIn();
            return false;
        })
    }
};

navbar = new NavBar();

$(document).ready(function (){
    navbar.init();
});