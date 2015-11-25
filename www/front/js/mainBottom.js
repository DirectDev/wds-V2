$(document).on('submit', 'form[name="front_frontbundle_user_profile"]', function (e) {
    e.preventDefault();
    var $form = $(e.target);
    // Get the BootstrapValidator instance
//    var bv = $form.data('bootstrapValidator');

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#profilFormDiv').empty().html(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="front_frontbundle_user_description"]', function (e) {
    e.preventDefault();
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
                    $('#descriptionForm').empty().html(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="front_frontbundle_user_link"]', function (e) {
    e.preventDefault();
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
                    $('#linkForm').empty().html(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});


$(document).on('click', '#userAddMusic', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#userMusicList').prepend(html);
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.newMusic', function (e) {
    e.preventDefault();

    var div = $(this).parent();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    div.replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('click', 'button.modifyMusic, button.cancelMusic', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var musicId = $(this).data('music-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#music_' + musicId).replaceWith(html);
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('click', 'button.deleteMusic', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var musicId = $(this).data('music-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#music_' + musicId).remove();
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.editMusic', function (e) {
    e.preventDefault();

    var musicId = $(this).data('music-id')
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#music_' + musicId).replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});


$(document).on('click', '#userAddVideo', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#userVideoList').prepend(html);
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.newVideo', function (e) {
    e.preventDefault();

    var div = $(this).parent();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    div.replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('click', 'button.modifyVideo, button.cancelVideo', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var videoId = $(this).data('video-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#video_' + videoId).replaceWith(html);
            loadBootstrapValidator();
        }
    });
    return false;
});



$(document).on('click', 'button.deleteVideo', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var videoId = $(this).data('video-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#video_' + videoId).remove();
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.editVideo', function (e) {
    e.preventDefault();

    var videoId = $(this).data('video-id')
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#video_' + videoId).replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});


$(document).on('click', '#userAddAddress', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#userAddressList').prepend(html);
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.newAddress', function (e) {
    e.preventDefault();

    var div = $(this).parent();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    div.replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('click', 'button.modifyAddress, button.cancelAddress', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var addressId = $(this).data('address-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#address_' + addressId).replaceWith(html);
            loadBootstrapValidator();
        }
    });
    return false;
});


$(document).on('click', 'button.deleteAddress', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var addressId = $(this).data('address-id');

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#address_' + addressId).remove();
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('submit', 'form.editAddress', function (e) {
    e.preventDefault();

    var addressId = $(this).data('address-id')
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#address_' + addressId).replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});


$(document).on('submit', 'form[name="front_frontbundle_event_description"]', function (e) {
    e.preventDefault();
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
                    $('#descriptionFormDiv').empty().html(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="front_frontbundle_event_link"]', function (e) {
    e.preventDefault();
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
                    $('#linkFormDiv').empty().html(html);
                    loadBootstrapValidator();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});


$(document).on('click', '#eventAddAddress', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#eventAddressList').prepend(html);
            loadBootstrapValidator();
        }
    });
    return false;
});

$(document).on('click', 'a.search-video-tag-link', function (e) {
    e.preventDefault();
    $('#video_filter_search').val(null);
    $('#video_filter_user').val(null);
    $('#video_filter_tag').val($(this).text().trim());
    $('#video_filter_form').submit();
});
$(document).on('click', 'a.search-video-user-link', function (e) {
    e.preventDefault();
    $('#video_filter_search').val(null);
    $('#video_filter_tag').val(null);
    $('#video_filter_user').val($(this).data('user-id'));
    $('#video_filter_form').submit();
});
$(document).on('change keyup', '#video_filter_search', function (e) {
    e.preventDefault();
    $('#video_filter_tag').val(null);
    $('#video_filter_user').val(null);
    $('#video_filter_form').submit();
});