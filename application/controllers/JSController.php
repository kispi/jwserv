<?php
class JSController extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('member_model');
    $this->load->model('congregation_model');
  }

  public function getSessionData()
  {
    $session = $this->session->userdata('logged_in');
    if($session['id'])
      $this->member_model->getSession($session['id']);
    else
      return NULL;

    return $this->session->userdata('logged_in');
  }

  public function view($page, $data = NULL, $use_header = TRUE, $use_footer = TRUE)
  {
    if(!file_exists(APPPATH.'views/'.$page.'.php'))
    {
      show_404();
    }

    if(!isset($data['session']))
      $data['session'] = self::getSessionData();

    if($data['session']['member_srl'])
      $this->member_model->recordLastActivity($data['session']['member_srl']);

    $data['current_class'] = $this->router->fetch_class();

    $this->load->view('head', $data);
    if($use_header === TRUE)
      $this->load->view('header', $data);
    $this->load->view($page, $data);
    if($use_footer === TRUE)
      $this->load->view('footer', $data);
  }

}
