import $ from 'jquery';
$(document).ready(function() {
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    let modal = $("#modifyData");

    $(".close").click(function () {
        modal.toggle();
    });

    $(window).click(function(event) {
        if (event.target.id == 'modifyData') {
            modal.toggle();
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
                if(result.message) {
                    requiredIDs.forEach(function(item) {
                        let field = $("#" + item);
                        field.parent().parent().removeClass('field-error');
                        field.next().html('');
                    })
                }
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
                        console.log("yes");
                        let field = $("#" + item);
                        field.parent().parent().removeClass('field-error');
                        field.next().html('');
                    }
                })
            }
        });
    })
});
