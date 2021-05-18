$(function () {
    var className = 'sagittaracc-split-input';

    var uniqId = 1;
    var getUniqId = function () {
        return className + '-' + uniqId++;
    };

    $(document).on(className + ":ready", function () {
        $('.' + className).each(function (index, input) {
            $(document).trigger(className + ':new', {
                input: input,
                id: getUniqId()
            });
        });
    });

    $(document).on(className + ':add', function (e, input) {
        $(document).trigger(className + ':new', {
            input: input,
            id: getUniqId()
        });
    });
});
