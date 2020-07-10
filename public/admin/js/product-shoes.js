$(function () {
    $('.js-select-category').select2();
    $('.js-seclect-brand').select2();
    $('.js-seclect-color').select2({
        maximumSelectionLength: 100
    });
    $('.js-seclect-size').select2({
        maximumSelectionLength: 100
    });
    $('.js-seclect-tag').select2({
        maximumSelectionLength: 100
    });
    $('#priceProduct').maskNumber({integer: true});
});
