$('#signup').on('submit', function() {
  $.ajax({
    type: "POST",
    url: "signup/writeRecord",
    data: $('#signup').serialize(),
    dataType: "json",
    success:
    function(data) {
      if(data) {
        if(data['msg'] === 'DUPLICATED_ID')
          popup('duplicated-id');
        else if(data['msg'] === 'DUPLICATED_EMAIL')
          popup('duplicated-email');
        else if(data['msg'] === 'INVALID_ID')
          popup('invalid-id');
        else if(data['msg'] === 'PASSWORD_WITH_SPACES')
          popup('password-with-spaces')
        else if(data['msg'] === 'SUCCESS')
          popup('ok');
      }
    }
  });
  return false;
});
$('.signup.ok').click(function() {
  location.href = 'main';
})
$('#add-congregation').click(function() {
  popup('add-congregation');
})
$('.popup.add-congregation button').click(function() {
  $.ajax({
    type: "POST",
    url: "signup/addCongregation",
    data: {"name": $('.popup.add-congregation input').val()},
    dataType: "json",
    success:
    function(data) {
      if(data['msg'] === 'DUPLICATED_CONGREGATION')
        popup('duplicated-congregation');
      else if(data['msg'] === 'SUCCESS') {
        popup('add-congregation-ok');
        $('select#congregation').empty();
        var length = Object.keys(data).length;
        for(i=0; i<length-1; i++) {
          $('select#congregation').append("<option value=" + data[i].congregation_srl + ">" + data[i].name + "</option>");
        }
      }
    }
  });
  return false;
})
