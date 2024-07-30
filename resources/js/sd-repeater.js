$('.sd-js-repeater-button').click(function () {
    let repeaterSource = $('.' + $(this).attr('data-repeater-class-source')).last();
    let repeaterTarget = $('.' + $(this).attr('data-repeater-class-target'));
    repeaterSource.clone().insertAfter(repeaterTarget);
});
