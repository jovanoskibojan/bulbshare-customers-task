import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready( function () {
    let csrf_token = $('meta[name="csrf-token"]').attr('content');

    let table = $('#data').DataTable( {

        dom: 'Blfrtip',
        buttons: [
            {
                text: 'New',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            },
            {
                text: 'Edit',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            },
            {
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                    console.log(e, dt, node, config);
                }
            }
        ],
        processing: true,
        serverSide: true,
        paging: true,
        ajax: {
            url: '/load',
            type: 'POST',
            "data": function (d) {
                d._token = csrf_token;
            }
        },
        select: {
            toggleable: true
        },
        columnDefs: [
            { orderable: false, targets: [0, 4, 5, 6, 9] }
        ],
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
