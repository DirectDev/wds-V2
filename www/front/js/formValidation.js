
function loadBootstrapValidator() {
    $('form:not(.navbar-form):not(.no_validation)').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {}
    });
    $('form:not(.navbar-form):not(.no_validation) input.datepicker').on('change show', function (e) {
        $('form:not(.navbar-form):not(.no_validation)').bootstrapValidator('revalidateField', $(this));
    });
}


$(document).ready(function () {
    loadBootstrapValidator();
});