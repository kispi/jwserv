<?php
require_once('JSController.php');

class Signout extends JSController {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
	{
    $this->session->unset_userdata('logged_in');
    session_destroy();
    header('location: main');    
	}
}
