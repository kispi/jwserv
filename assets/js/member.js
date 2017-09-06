$('#member').on('submit', function() {
  $.ajax({
    type: "POST",
    url: "member/updateRecord",
    data: $('#member').serialize(),
    dataType: "json",
    success:
    function(data) {
      if(data) {
        if(data['msg'] === 'PASSWORD_WITH_SPACES')
          popup('password-with-spaces');
        else if(data['msg'] === 'DUPLICATED_EMAIL')
          popup('duplicated-email');          
        else if(data['msg'] === 'SUCCESS')
          popup('ok');
      }
    }
  });
  return false;
});
$('.btn-success').click(function() {
  location.href = 'main';
})
