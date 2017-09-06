$(function() {
  $(function() {
    $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd (D)', dayNamesShort: ['일', '월', '화', '수', '목', '금', '토']});
    $(".datepicker").datepicker('setDate', new Date());
    $("#incomplete-check").change(function() {
      if(this.checked) {
        $("#visit_end").val("");
      } else {
        $("#visit_end").val($("#visit_start").val());
      }
    });
    $("#visit_start").change(function() {
      $("#visit_end").val($("#visit_start").val());
    })
  });
});
$('#record').on('submit', function() {
  $.ajax({
    type: "POST",
    url: "record/writeRecord",
    data: $('#record').serialize(),
    dataType: "json",
    success:
    function(data) {
      if(data) {
        if(data['msg'] === 'SUCCESS')
          popup('ok');
        else if(data['msg'] === 'NO_CHANGE')
          popup('duplicate');
      }
    }
  });
  return false;
});
$('button.record-continue').click(function() {
  $('.popup .glyphicon-remove-circle').trigger('click');
  $(area).val('');
  $(area).focus();
  $('html, body').animate({scrollTop: 0 }, 'fast');
  if(!$('#sustain-check').is(":checked"))
    $('#servant').val("");
});
$('button.redirect-check').click(function() {
  location.href = 'check'
});
