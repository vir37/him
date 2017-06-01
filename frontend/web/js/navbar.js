/**
 * Created by admin on 22.04.2017.
 */
NavBar = function() {
    this.cityChooser = null;
};
NavBar.prototype.init = function(){
    this.cityChooser = $('.city-chooser a');
    if (this.cityChooser) {
        $(this.cityChooser).each(function(idx, elem){
            var data = $(elem).data('cities');
            if (data) {
                $(document).click(function (event) {
                    if ($(event.target).closest(data).length)
                        return true;
                    $(data).fadeOut();
                    event.stopPropagation()
                });
            }
        });
        $(this.cityChooser).on('click', function(event){
            var position = $(this).offset(),
                dt = $(this).data('cities'),
                height = $(this).height();
            $(dt).fadeIn();
            $(dt).offset({top: position.top + height + 20, left: position.left});
            return false;
        })
    }
};

navbar = new NavBar();

$(document).ready(function (){
    navbar.init();
});