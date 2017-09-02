<?php
require_once('JSController.php');

class Signin extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('congregation_model');
    $this->load->model('member_model');
  }

  public function findAccount() {
    $newPassword = mt_rand(1000, 9999);
    $userinfo = $this->member_model->issueNewPassword($this->input->post('email'), $newPassword);

    if(!$userinfo) {
      echo json_encode(['msg' => "FAIL"]);
      return;
    }

    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";
    $config['mailtype']  = "html";
    $config['charset']   = "utf-8";
    $config['protocol']  = "smtp";
    $config['smtp_host'] = "ssl://smtp.naver.com";
    $config['smtp_port'] = 465;
    $config['smtp_user'] = "YOUR_MAIL";
    $config['smtp_pass'] = "YOUR_MAIL_PASSWORD";
    $config['smtp_timeout'] = 10;

    $this->load->library('email', $config);

    $this->email->set_newline("\r\n");
    $this->email->clear();
    $this->email->from("kispi@naver.com", "JWSERV");
    $this->email->to($this->input->post('email'));
    $this->email->subject("[JWSERV] 아이디와 임시 비밀번호입니다");
    $this->email->message("아이디: ".$userinfo['id']."<br>비밀번호: ".$newPassword."<br><br>로그인 후 비밀번호를 변경하시기 바랍니다");
    if (!$this->email->send())
      echo json_encode(['msg' => "FAIL"]);
    else
      echo json_encode(['msg' => "SUCCESS"]);
  }

  public function getSession()
  {
    $data = $this->input->post();
    $result = $this->member_model->login($data['id'], $data['password']);
    if($result) {
      $result['msg'] = "SUCCESS";
    } else {
      $result['msg'] = "NO_MATCHING_MEMBER_INFO";
    }
    echo json_encode($result);
  }

  public function index()
	{
    if(parent::getSessionData())
      header('Location: main');
    else
      parent::view('signin');
	}
}
