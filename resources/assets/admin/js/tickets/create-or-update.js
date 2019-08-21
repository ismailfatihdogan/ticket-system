(function ($) {
    $('.select2').each(function (index, item) {
        item = $(item);

        item.select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });

    // $('#content').wysiwyg();
})(jQuery);