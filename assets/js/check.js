var record_srl;

$('.card-button.glyphicon-pencil, .card-button.glyphicon-floppy-disk').click(function() {
  var classNames = this.className.split(' ');
  var currentElement = $(this);
  if(classNames[0] === 'record-0') return false;

  var inputs = $('.card.' + classNames[0] + ' input');
  if(classNames[3] === 'glyphicon-pencil') {
    currentElement.toggleClass('glyphicon-pencil glyphicon-floppy-disk');
    inputs.attr('readonly', false);
    $(inputs[2]).datepicker({ dateFormat: 'yy-mm-dd (D)', dayNamesShort: ['일', '월', '화', '수', '목', '금', '토']});
    $(inputs[3]).datepicker({ dateFormat: 'yy-mm-dd (D)', dayNamesShort: ['일', '월', '화', '수', '목', '금', '토']});
    $(inputs[2]).datepicker('enable');
    $(inputs[3]).datepicker('enable');
  } else if(classNames[3] === 'glyphicon-floppy-disk') {
    $.ajax({
      type: "POST",
      url: "check/updateRecord",
      data: {"record_srl": classNames[0].split('-')[1], "area": $(inputs[0]).val(), "servant": $(inputs[1]).val(), "visit_start": $(inputs[2]).val(), "visit_end": $(inputs[3]).val(), "memo": $(inputs[4]).val()},
      dataType: "json",
      success:
      function(data) {
        if(data) {
          if(data['msg'] === 'SUCCESS' || data['msg'] === 'NO_CHANGE') {
            currentElement.toggleClass('glyphicon-pencil glyphicon-floppy-disk');
            inputs.attr('readonly', true);
            popup('update.ok');
          }
          else if(data['msg'] === 'DUPLICATED_AREA')
            popup('duplicate');
        }
      }
    });
  }
  inputs[0].focus();
});
$('.container-fluid .card-button.glyphicon-trash').click(function() {
  record_srl = this.className.split(' ')[0].split('-')[1];
  popup('delete.confirm');
});
$('.popup.delete .yes').click(function() {
  $.ajax({
    type: "POST",
    url: "check/deleteRecord",
    data: {"record_srl": record_srl},
    dataType: "json",
    success:
    function(data) {
      $('div.card.record-' + record_srl).remove();
      popup('delete.ok');
    }
  });
});
$('button.help').click(function() {
  popup('help');
});
$('button.filter-day').click(function() {
  popup('day');
});
$('button.day').click(function() {
  var day = $(this).attr('class').split(' ').slice(-1)[0];
  console.log(day);
  $.ajax({
    type: "POST",
    url: "check/filterDay",
    data: {"day": day},
    dataType: "json",
    success:
    function(data) {
      location.reload();
    }
  })
})
$('button.extract').click(function() {
  $('.popup.extract input').datepicker({ dateFormat: 'yy-mm-dd' });
  popup('extract');
});
