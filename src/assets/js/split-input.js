(function(){
  $('body').on('keyup', 'input.sagittaracc-split-input', function(){
    var inputList = $(this).parent().parent().find('input.sagittaracc-split-input');
    var list = [];
    $.each(inputList, function(index, input){
      if ($(input).val())
        list.push($(input).val());
    });
    $(this).parent().parent().find('input[type="hidden"]').val(list.join(separator));
  });
})();
