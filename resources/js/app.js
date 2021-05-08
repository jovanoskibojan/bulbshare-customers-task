import $ from 'jquery';
window.$ = window.jQuery = $;

export let table;
$(document).ready( function () {
    let csrf_token = $('meta[name="csrf-token"]').attr('content');

    table = $('#data').DataTable( {

        dom: 'Blfrtip',
        buttons: [
            {
                text: 'New',
                action: function ( e, dt, node, config ) {
                    $("#addData").toggle();
                }
            },
            {
                text: 'Edit',
                attr: {
                    id: 'openEditModal'
                },
                action: function ( e, dt, node, config ) {
                    let selData = table.rows(".selected").data();
                    if(selData[0] === undefined) {
                        addErrorModal('Error', 'Please make sure you select a row');
                        return 0;
                    }
                    let rowID = selData[0][0];
                    $.ajax({
                        url: '/customers/' + rowID + '/edit',
                        type: 'GET',
                        data: ({ _token : csrf_token, id : rowID }),
                        success: function(result) {
                            result = JSON.parse(result);
                            $.each(result, function (key, value) {
                                $("#" + key).val(value);
                            });
                        }
                    });
                    $("#modifyData").toggle();
                }
            },
            {
                text: 'Delete',
                action: function ( e, dt, node, config ) {
                    let selData = table.rows(".selected").data();
                    if(selData[0] === undefined) {
                        addErrorModal('Error', 'Please make sure you select a row');
                        return 0;
                    }
                    $("#removeConfirmation").toggle();
                }
            }
        ],
        processing: true,
        serverSide: true,
        paging: true,
        responsive: true,
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
        "order": [[ 0, "desc" ]]
    } );
    $("#data tbody").on({
        click: function() {
            selectRow($(this), table, false);
        },
        dblclick: function() {
            selectRow($(this), table, true);
        },
    }, "tr");

    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
    $('#data').on( 'page.dt', function (e) {
        console.log(e);
    });
} );

function selectRow(element, table, openModal) {
    if ( $(element).hasClass('selected') ) {
        $(element).removeClass('selected');
    }
    else {
        table.$('tr.selected').removeClass('selected');
        $(element).addClass('selected');
        if(openModal) {
            $("#openEditModal").click();
        }
    }
}
export function addErrorModal(title, body) {
    $("#alert .modalHeader p").html(title);
    $("#alert .modalBody").html(body);
    $("#alert").toggle();

}
import "./modal";
