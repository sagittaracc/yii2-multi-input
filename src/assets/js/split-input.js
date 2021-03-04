(function(){
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
})();
