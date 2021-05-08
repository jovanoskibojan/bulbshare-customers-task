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
                    let selData = table.rows(".selected").data();
                    if(selData[0] === undefined) {
                        alert("Please select a row first");
                        return 0;
                    }
                    let rowID = selData[0][0];
                    $.ajax({
                        url: '/customers/' + rowID,
                        type: 'DELETE',
                        data: ({ _token : csrf_token }),
                        success: function(result) {
                            table.ajax.reload( null, false );
                        }
                    });
                }
            }
        ],
        processing: true,
        serverSide: true,
        paging: true,
        ajax: {
            url: '/customers/load',
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
