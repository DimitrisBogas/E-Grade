/**
 * Created by user on 17/12/2015.
 */
/*

$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = '/controllers/AuthenticationController.php',
            data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });

});

*/

function getUserCredentials() {
    $.post(
        'loginVerfication.php'
    ).success(function(resp){
        json = $.parseJSON(resp);
        alert(json);
    });
}