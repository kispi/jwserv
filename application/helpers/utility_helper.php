<?php
  function verifySignupForm($data)
  {
    if(isset($data['id']))
      if(!ctype_alnum($data['id']) || strlen($data['id']) < 4 || strlen($data['id']) > 12)
        return "INVALID_ID";

    if(isset($data['password']))
      if(strpos($data['password'], " ") !== FALSE)
        return "PASSWORD_WITH_SPACES";

    return "SUCCESS";
  }

  function getDayOfTheWeek($date)
  {
    $day = ["일", "월", "화", "수", "목", "금", "토"];
    return $day[date('w', strtotime($date))];
  }

  function asset_url($asset_name) {
    return base_url().'assets/'.$asset_name;
  }
