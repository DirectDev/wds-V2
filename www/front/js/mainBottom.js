$(document).on('submit', 'form[name="ffup"]', function (e) {
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
                    $('#profilForm').empty().html(html);
                    loadBootstrapValidator();
                    scrollToElement($('#profilForm'));
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="ffud"]', function (e) {
    e.preventDefault();

    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var $form = $(e.target);
    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#descriptionForm').empty().html(html);
                    updateCKEditors();
                    loadBootstrapValidator();
                    scrollToElement($('#descriptionForm'));
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="fful"]', function (e) {
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
                    scrollToElement($('#linkForm'));
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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

    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var div = $(this).parent();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    div.replaceWith(html);
                    loadBootstrapValidator();
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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
            $('#userVideoForms').html(html);
            loadBootstrapValidator();
            loadMasonry();
        }
    });
    return false;
});

$(document).on('submit', 'form.newVideo', function (e) {
    e.preventDefault();

    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#userVideoForms').empty();
                    prependDivToMasonry(html);
                    loadBootstrapValidator();
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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

    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var div = $(this).parent();
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    div.replaceWith(html);
                    loadBootstrapValidator();
                    reloadEventAlerts();
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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
            reloadEventAlerts();
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
                    reloadEventAlerts();
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
                }
            });
    e.preventDefault();
});


$(document).on('submit', 'form[name="ffede"]', function (e) {
    e.preventDefault();

    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var $form = $(e.target);
    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#descriptionForm').empty().html(html);
                    updateCKEditors();
                    loadBootstrapValidator();
                    scrollToElement($('#descriptionForm'));
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
                }
            });
    e.preventDefault();
});

$(document).on('submit', 'form[name="ffel"]', function (e) {
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
                    scrollToElement($('#linkForm'));
                },
                error: function (error_xhr, ajaxOptions, thrownError) {
                    if (error_xhr.status == 403) {
                        location.reload();
                    }
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
$(document).on('change', '#video_filter_search', function (e) {
    e.preventDefault();
    $('#video_filter_tag').val(null);
    $('#video_filter_user').val(null);
});

$(document).on('click', 'a.search-music-tag-link', function (e) {
    e.preventDefault();
    $('#music_filter_search').val(null);
    $('#music_filter_user').val(null);
    $('#music_filter_tag').val($(this).text().trim());
    $('#music_filter_form').submit();
});
$(document).on('click', 'a.search-music-user-link', function (e) {
    e.preventDefault();
    $('#music_filter_search').val(null);
    $('#music_filter_tag').val(null);
    $('#music_filter_user').val($(this).data('user-id'));
    $('#music_filter_form').submit();
});
$(document).on('change', '#music_filter_search', function (e) {
    e.preventDefault();
    $('#music_filter_tag').val(null);
    $('#music_filter_user').val(null);
});

$(document).on('click', 'a.search-user-usertype-link', function (e) {
    e.preventDefault();
    $('#user_filter_search').val(null);
    $('#user_filter_musictype').val(null);
    $('#user_filter_usertype').val($(this).text().trim());
    $('#user_filter_form').submit();
});
$(document).on('click', 'a.search-user-musictype-link', function (e) {
    e.preventDefault();
    $('#user_filter_search').val(null);
    $('#user_filter_usertype').val(null);
    $('#user_filter_musictype').val($(this).text().trim());
    $('#user_filter_form').submit();
});
$(document).on('change', '#user_filter_search', function (e) {
    e.preventDefault();
    $('#user_filter_musictype').val(null);
    $('#user_filter_usertype').val(null);
});

$(document).on('click', 'a.link-love-video', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var li = $(this).parent();

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            li.html(html);
        }
    });
    return false;
});

$(document).on('click', 'a.link-love-music', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var li = $(this).parent();

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            li.html(html);
        }
    });
    return false;
});

$(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    if (scroll > 80)
        $('.search_transversal').addClass('border-bottom-header');
    else
        $('.search_transversal').removeClass('border-bottom-header');
});

$(document).on('submit', 'form#festivals_calendar_form', function (e) {
    e.preventDefault();

    var form = $(this);
    var input = $(this).find('#festivals_calendar_input');

    window.location = form.attr('action') + '/' + input.val();
});

$(document).on('click', '#previewImportEventsFacebook', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }
    $('#blockImportEventsFacebook').hide();
    hideLoaderGif($('#importEventsFacebook'));

    showLoaderGif($('#previewImportEventsFacebook'));

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        success: function (html)
        {
            $('#facebookResults').html(html);
            $('#blockImportEventsFacebook').show();
            hideLoaderGif($('#previewImportEventsFacebook'));
            scrollToElement($("#blockImportEventsFacebook"));
            loadMasonry();
        }
    });
    return false;
});

$(document).on('click', 'button.supprFacebookEventBrick', function () {
    $(this).parent().parent().parent().parent().remove();
    loadMasonry();
});

$(document).on('click', '#importEventsFacebook', function () {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    var data = new Array();
    $('#facebookResults').find(".masonry-brick-facebook-event").each(function () {
        data.push($(this).data('id'));
    });

    showLoaderGif($('#importEventsFacebook'));

    xhr = $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        data: '&ids=' + data,
        success: function (html)
        {
            $('#facebookResults').html(html);
            $('#blockImportEventsFacebook').hide();
            hideLoaderGif($('#importEventsFacebook'));
            scrollToElement($("#facebookResults"));
            loadMasonry();
        }
    });
    return false;
});

$(document).on('submit', 'form[name="facebook_event_import"]', function (e) {
    if (xhr && xhr.readystate != 4) {
        xhr.abort();
    }

    $('#blockImportEventsFacebook').hide();
    hideLoaderGif($('#importEventsFacebook'));
    e.preventDefault();

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    xhr = $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (html)
                {
                    $('#facebookResults').html(html);
                    loadBootstrapValidator();
                    $('#blockImportEventsFacebook').show();
                    loadMasonry();
                }
            });
    return false;
});