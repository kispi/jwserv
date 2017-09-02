<?php
class PRController extends CI_Controller {

  public function getSessionData()
  {
    return $this->session->userdata('logged_in');
  }

  public function view($page, $data = NULL, $use_header = TRUE, $use_footer = TRUE)
  {
    if(!file_exists(APPPATH.'views/'.$page.'.php'))
    {
      show_404();
    }

    if($this->getSessionData())
      $data['session'] = $this->session->userdata('logged_in');

    $data['uri_segment_last'] = $this->uri->segment($this->uri->total_segments());

    $this->load->view('head', $data);
    if($use_header === TRUE)
      $this->load->view('header', $data);
    $this->load->view($page, $data);
    if($use_footer === TRUE)
      $this->load->view('footer', $data);
  }

}
