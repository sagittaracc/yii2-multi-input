$(function(){
  $('body').on('keyup', 'input.sagittaracc-split-input', function(){
    var inputList = $(this).parent().parent().find('input.sagittaracc-split-input');
    var list = [];
    $.each(inputList, function(index, input){
      if ($(input).val())
        list.push($(input).val());
    });
    var hiddenInput = $(this).parent().parent().find('input[type="hidden"]');
    hiddenInput.val(list.join(separator[hiddenInput.attr("id")]));
  });

  var uniqId = 1;
  var getUniqId = function() {
    return 'sagittaracc-split-input-' + uniqId++;
  };

  $(document).on("sagittaracc-split-input:ready", function() {
    $('.sagittaracc-split-input').each(function(index, input) {
      $(document).trigger('sagittaracc-split-input:new', {
        input: input,
        id: getUniqId()
      });
    });
  });

  $(document).on('sagittaracc-split-input:add', function(e, input) {
    $(document).trigger('sagittaracc-split-input:new', {
      input: input,
      id: getUniqId()
    });
  });
});
