/**
 * Created by rparsi on 14/05/2016.
 */
import ApiConsole from 'ApiConsole';

$(document).ready(function () {
    let apiConsole = new ApiConsole();
    console.log(apiConsole.user);

    $('.foobar-button').click(function (event) {
        $('#myModal').modal('show');
    });
});