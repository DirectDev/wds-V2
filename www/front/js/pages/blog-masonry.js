/**
 * Base js functions
 */
function setColumnWith (min_width, gutter) {
    var containerWidth = masonryContainer.width();
    var box_width = (((containerWidth - 2 * gutter) / 3) | 0);

    if (box_width < min_width) {
        box_width = (((containerWidth - gutter) / 2) | 0);
    }

    if (box_width < min_width) {
        box_width = containerWidth;
    }

    $('.grid-boxes-in').width(box_width);

    return box_width;
}

function loadMasonry() {

    var $container = $('.grid-boxes');
    masonryContainer = $container;

    var gutter = 30;
    var min_width = 240;

    $container.imagesLoaded(function () {

        var columnWidth = setColumnWith(min_width, gutter);

        $container.masonry({
            itemSelector: '.grid-boxes-in',
            columnWidth: columnWidth,
            gutter: gutter,
            isAnimated: true
        });
    });
}

function prependDivToMasonry(div) {
    elem = jQuery(div).filter('div');
    masonryContainer.masonry()
            .prepend(elem)
            .masonry('prepended', elem)
            .masonry();
    loadMasonry();
}

$(document).ready(function () {
    loadMasonry();
});
