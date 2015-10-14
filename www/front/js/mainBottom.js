$(document).on('submit', 'form[name="front_frontbundle_user_profile"]', function (e) {
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
                    $('#profilFormDiv').empty().html(html);
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
                    $('#descriptionFormDiv').empty().html(html);
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
                    $('#linkFormDiv').empty().html(html);
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
            $('#userMusicList').append('<li>' + html + '</li>');
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
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('click', 'button.modifyMusic', function () {
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
        }
    });
    return false;
});

$(document).on('submit', 'form.deleteMusic', function (e) {
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
                    $('#music_' + musicId).remove();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
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
            $('#userVideoList').append('<li>' + html + '</li>');
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
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});

$(document).on('click', 'button.modifyVideo', function () {
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
        }
    });
    return false;
});

$(document).on('submit', 'form.deleteVideo', function (e) {
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
                    $('#video_' + videoId).remove();
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
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
                },
                error: function (html)
                {
                }
            });
    e.preventDefault();
});