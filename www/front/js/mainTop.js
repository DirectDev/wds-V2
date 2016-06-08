var xhr;
var xhr_list;
var xhr_map;

$(document).ajaxStart(function () {
    $('body').addClass('wait');
}).ajaxComplete(function () {
    $('body').removeClass('wait');
});

function updateCKEditors() {
    for (var instanceName in CKEDITOR.instances) {
        CKEDITOR.replace(instanceName);
    }
}

function searchFront(element, path, div_results, div_loading) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    div_loading.show();
    var keyword = element.val();
    var DATA = 'keyword=' + keyword;
    xhr = $.ajax({
        type: "POST",
        url: path,
        data: DATA,
        cache: false,
        success: function (data) {
            div_results.html(data).removeClass('hidden').addClass('show');
            div_loading.hide();
        }
    });
    return false;
}

function musicTypeFilterList(form, path) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr_list = $.ajax({
        type: "POST",
        url: path,
        data: form.serialize(),
        success: function (html)
        {
            $('#event-list').empty().html(html)
        }
    });
    return false; // avoid to execute the actual submit of the form.
}

function musicTypeFilterMap(form, path) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr_map = $.ajax({
        type: "POST",
        url: path,
        data: form.serialize(),
        success: function (html)
        {
            $('#map').empty().html(html)
            initializeGoogleMap();

        }
    });
    return false; // avoid to execute the actual submit of the form.
}

function eventTypeFilterList(form, path) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr_list = $.ajax({
        type: "POST",
        url: path,
        data: form.serialize(),
        success: function (html)
        {
            $('#event-list').empty().html(html)
        }
    });
    return false; // avoid to execute the actual submit of the form.
}

function eventTypeFilterMap(form, path) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr_map = $.ajax({
        type: "POST",
        url: path,
        data: form.serialize(),
        success: function (html)
        {
            $('#map').empty().html(html)
            initializeGoogleMap();

        }
    });
    return false; // avoid to execute the actual submit of the form.
}

function reloadEventAlerts() {

    var path = $('#event_alerts').attr('rel');

    if (path)
        $.ajax({
            type: "POST",
            url: path,
            success: function (html)
            {
                $('#event_alerts').empty().html(html)
            }
        });
}

$(document).on('click focus', 'a.eventdate_edit', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr_map = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#eventdate_new_edit').empty().html(html).focus();
            $('html, body').animate({
                scrollTop: ($("#eventdate_new_edit").offset().top - 115)
            }, 2000);
            reloadBootstrapValidator();
            reloadEventAlerts();
        }
    });
    return false;
});

$(document).on('click focus', 'a.eventdate_cancel', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    var rel = $(this).attr("rel");
    xhr_map = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#eventdate_' + rel).empty().html(html);
            location.reload();
        }
    });
    return false;
});



$(document).on('submit', '#form_eventdate_new, #form_eventdate_daily', function (e) {
    // Prevent form submission
    e.preventDefault();
    // Get the form instance
    var $form = $(e.target);
    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#eventdates').empty().html(html);
                    reloadEventAlerts();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault(); //STOP default actiont.
});

$(document).on('submit', '#form_eventdate_edit', function (e) {
    // Prevent form submission
    e.preventDefault();
    // Get the form instance
    var $form = $(e.target);
    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    location.reload();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault(); //STOP default actiont.
});

$(document).on('click', 'button.love_button', function (e) {
    e.preventDefault();
    // Get the form instance
    var form = $(this).parent().closest('form');
    console.log('click');
    console.log(form);
    var postData = form.serializeArray();
    var formURL = form.attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#loves_div').replaceWith(html);
                },
                error: function (html)
                {
                }
            });
    e.preventDefault(); //STOP default actiont.
});

$(document).on('click', 'button.presence_button', function (e) {
    e.preventDefault();
    // Get the form instance
    var form = $(this).parent().closest('form');
    console.log('click');
    console.log(form);
    var postData = form.serializeArray();
    var formURL = form.attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#presences_div').replaceWith(html);
                },
                error: function (html)
                {
                }
            });
    e.preventDefault(); //STOP default actiont.
});

function showLoaderGif(button) {
    button.find('img').show();
}
function hideLoaderGif(button) {
    button.find('img').hide();
}
function scrollToElement(element) {
    var marge = 0;
    if ($('.search_transversal').is(":visible"))
        marge = $('.search_transversal').outerHeight(true) + 10;

    $('html, body').animate({
        scrollTop: (element.offset().top - marge)
    }, 1000);
}