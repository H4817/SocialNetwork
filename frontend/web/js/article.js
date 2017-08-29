$(".post-item .edit-post-button").click(function () {
    $(this).closest('.post').hide();
    $(this).closest('.post-item').find('.post-form').show();
});
$(".post-form .cancel-button").click(function () {
    $(this).closest('.post-form').hide();
    $(this).closest('.post-item').children('.post').show();
});

