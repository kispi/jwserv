$('#signin').on('submit', function() {
  $.ajax({
    type: "POST",
    url: "signin/getSession",
    data: $('#signin').serialize(),
    dataType: "json",
    success:
    function(data) {
      if(data) {
        if(data['msg'] === 'NO_MATCHING_MEMBER_INFO') {
          $('.no-matching-member-info').show();
          $('.find-account').hide();
          popup('no-member');
        }
        else
          location.href = 'main';
      }
    }
  });
  return false;
});
$('form#signin #signup').click(function() {
  location.href = 'signup';
});
$('.open-find-account').click(function() {
  $('.no-matching-member-info').slideUp();
  $('.find-account').slideDown();
  $('.message.send-success').hide();
  $('.message.send-fail').hide();
});
$('button.find-account').click(function() {
  $.ajax({
    type: "POST",
    url: "signin/findAccount",
    data: {'email': $('.popup.no-member input').val()},
    dataType: "json",
    success:
    function(data) {
      if(data) {
        if(data['msg'] === 'FAIL') {
          $('.message.send-fail').slideDown();
          $('.message.send-success').slideUp();
        }
        else {
          $('.message.send-success').slideDown();
          $('.message.send-fail').slideUp();
        }
      }
    }
  });
  return false;
});
