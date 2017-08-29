$('body').click(function (evt) {
    var container = $('.panel-body');
    if (!container.is(evt.target) && (container.has(evt.target).length === 0 && $('.comment-form').has(evt.target).length === 0)) {
        $(this).find('.comment-container').children('.comment-form').hide();
        $(this).find(container).show();
    }
});
$(".panel-body").click(function () {
    $(this).hide();
    $(this).closest('.comment-container').children('.comment-form').show();
});
