import $ from 'jquery';
$(document).ready(function(){
    let modal = $("#modifyData");

    $(".close").click(function () {
        modal.toggle();
    });

    $(window).click(function(event) {
        if (event.target.id == 'modifyData') {
            modal.toggle();
        }
    });
});
