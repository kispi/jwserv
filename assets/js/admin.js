var member_srl;

$('.card-button.glyphicon-pencil, .card-button.glyphicon-floppy-disk').click(function() {
  var classNames = this.className.split(' ');
  var inputs = $('.card.' + classNames[0] + ' input');
  var select = $('.card.' + classNames[0] + ' select');
  var currentElement = $(this);
  if(classNames[3] === 'glyphicon-pencil') {
    currentElement.toggleClass('glyphicon-pencil glyphicon-floppy-disk');
    inputs.attr('readonly', false);
    select.attr('disabled', false);
    inputs[0].focus();
  } else if(classNames[3] === 'glyphicon-floppy-disk') {
    $.ajax({
      type: "POST",
      url: "admin/updateRecord",
      data: {"member_srl": classNames[0].split('-')[1], "name": $(inputs[0]).val(), "auth": select.val(), "email": $(inputs[1]).val(), "phone": $(inputs[2]).val()},
      dataType: "json",
      success:
      function(data) {
        if(data['msg'] === 'NO_ADMIN') {
          popup('no-admin');
        }
        else if(data['msg'] === 'DUPLICATED_EMAIL')
          popup('duplicated-email');
        else if(data['msg'] === 'SUCCESS') {
          inputs.attr('readonly', true);
          select.attr('disabled', true);
          popup('update.ok');
          currentElement.toggleClass('glyphicon-pencil glyphicon-floppy-disk');
        }
      }
    });
  }
});
$('.container-fluid .card-button.glyphicon-trash').click(function() {
  member_srl = this.className.split(' ')[0].split('-')[1];
  popup('delete.confirm');
});
$('.popup.delete .yes').click(function() {
  $.ajax({
    type: "POST",
    url: "admin/deleteRecord",
    data: {"member_srl": member_srl},
    dataType: "json",
    success:
    function(data) {
      if(data['msg'] === 'TRY_TO_DELETE_ADMIN')
        popup('try-to-delete-admin');
      else if(data['msg'] === 'SUCCESS') {
        popup('delete.ok');
        $('div.card.member-' + member_srl).remove();
      }
    }
  });
});
$('button.help').click(function() {
  popup('help');
});
