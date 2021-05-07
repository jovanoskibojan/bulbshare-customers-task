import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready( function () {
    $('#data').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "/load"
    } );
} );
