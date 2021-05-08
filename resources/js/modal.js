import $ from 'jquery';
import {table, addErrorModal} from "./app";

$(document).ready(function() {
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    let modal = $(".modal");

    $(".close").click(function () {
        modal.each(function () {
            $(this).hide();
        });
    });

    $(window).click(function(event) {
        if (event.target.id == 'modifyData' || event.target.id == 'addData' || event.target.id == 'removeConfirmation' || event.target.id == 'alert') {
            modal.each(function () {
                $(this).hide();
            })
        }
    });

    $("#update").click(function () {
        let formData = $('#updateModal').serializeArray();
        let userId = $("#id").val();
        let requiredFields = $('input:required');
        let requiredIDs = [];
        requiredFields.each(function () {
            requiredIDs.push($(this).attr('id'));
        });
        formData.push({
            name: '_token',
            value: csrf_token
        });
        $.ajax({
            url: '/customers/' + userId,
            type: 'PATCH',
            data: formData,
            success: function(result) {
                result = JSON.parse(result);
                requiredIDs.forEach(function(item) {
                    let field = $("#" + item);
                    field.parent().parent().removeClass('field-error');
                    field.next().html('');
                });
                table.ajax.reload( null, false );
                $("#modifyData").hide();
                addErrorModal('Success', 'Row has been successfully updated');
            },
            error: function (xhr) {
                let fieldsWithErrors = [];
                $.each(xhr.responseJSON.errors, function (key, value) {
                    let field = $("#" + key);
                    field.parent().parent().addClass('field-error');
                    field.next().html(value);
                    fieldsWithErrors.push(key);
                });
                requiredIDs.forEach(function(item) {
                    if(jQuery.inArray(item, fieldsWithErrors) === -1) {
                        let field = $("#" + item);
                        field.parent().parent().removeClass('field-error');
                        field.next().html('');
                    }
                })
            }
        });
    })
    $("#add").click(function () {
        let formData = $('#addModal').serializeArray();
        let requiredFields = $('input:required');
        let requiredIDs = [];
        requiredFields.each(function () {
            requiredIDs.push($(this).attr('id'));
        });
        formData.push({
            name: '_token',
            value: csrf_token
        });
        $.ajax({
            url: '/customers',
            type: 'POST',
            data: formData,
            success: function(result) {
                requiredIDs.forEach(function(item) {
                    let field = $("#" + item);
                    field.parent().parent().removeClass('field-error');
                    field.next().html('');
                });
                table.ajax.reload( null, false );
                $("#addData").hide();
                addErrorModal('Success', 'New row has been successfully added');
            },
            error: function (xhr) {
                let fieldsWithErrors = [];
                $.each(xhr.responseJSON.errors, function (key, value) {
                    let field = $("#new_" + key);
                    field.parent().parent().addClass('field-error');
                    field.next().html(value);
                    fieldsWithErrors.push(key);

                });
                requiredIDs.forEach(function(item) {
                    if(jQuery.inArray(item, fieldsWithErrors) === -1) {
                        let field = $("#new_" + item);
                        field.parent().parent().removeClass('field-error');
                        field.next().html('');
                    }
                })
            }
        });
    });
    $("#remove").click(function () {
        let selData = table.rows(".selected").data();
        let rowID = selData[0][0];
        $.ajax({
            url: '/customers/' + rowID,
            type: 'DELETE',
            data: ({ _token : csrf_token }),
            success: function(result) {
                table.ajax.reload( null, false );
                $("#removeConfirmation").toggle();
            }
        });
    });
    $("#cancel").click(function () {
        $("#removeConfirmation").hide();
    })
    $(".cancel").click(function () {
        $("#alert").hide();
    });
});
