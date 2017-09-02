<?php
require_once('JSController.php');

class Main extends JSController {
  public function index()
	{
    $data['session'] = parent::getSessionData();
    if($data['session']['member_srl']) {
      parent::view('main', $data);
    }
    else
      header('Location: signin');
	}
}
