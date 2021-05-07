import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready( function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    var table = $('#data').DataTable( {
        processing: true,
        serverSide: true,
        paging: true,
        ajax: {
            url: '/load',
            type: 'POST'
        },
        select: {
            toggleable: true
        },
    } );

    $('#data tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
    $('#data').on( 'page.dt', function (e) {
        console.log(e);
    });
} );
