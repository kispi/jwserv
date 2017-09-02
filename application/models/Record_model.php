<?php
class Record_model extends CI_Model {
  public $table = 'js_record';

  public function __construct()
  {
    $this->load->database();
  }

  public function writeRecord($data)
  {
    $this->db->where('visit_start', $data['visit_start']);
    $this->db->where('area', $data['area']);
    $this->db->where('congregation', $data['congregation']);
    $this->db->limit(1);
    $duplicate = $this->db->get($this->table);

    $result = NULL;
    if(!$duplicate->row_array()) {
      $this->db->insert($this->table, $data);
      if($this->db->affected_rows() > 0) {
        $result = $this->db->where('record_srl', $this->db->insert_id())->get($this->table)->row_array();
      }
    }
    return $result;
  }

  public function deleteRecord($data)
  {
    $this->db->delete($this->table, $data);
    return $this->db->affected_rows();
  }

  public function updateRecord($data)
  {
    $data['congregation'] = $this->session->userdata('logged_in')['congregation_srl'];
    $this->db->where('visit_start', $data['visit_start']);
    $this->db->where('area', $data['area']);
    $this->db->where('congregation', $data['congregation']);
    $this->db->limit(1);
    $duplicate = $this->db->get($this->table)->row_array();

    $result = NULL;
    if(!$duplicate) {
      $this->db->where('record_srl', $data['record_srl']);
      $this->db->update($this->table, $data);
      if($this->db->affected_rows() > 0) {
        $this->db->where('record_srl', $data['record_srl']);
        $result = $this->db->get($this->table)->row_array();
        $result['msg'] = 'SUCCESS';
      }
    } else {
      $this->db->where('record_srl', $data['record_srl']);
      $current_record = $this->db->get($this->table)->row_array();
      if($current_record['area'] === $data['area'] && $current_record['visit_start'] === substr($data['visit_start'], 0, 10)) {
        $this->db->where('record_srl', $data['record_srl']);
        $this->db->update($this->table, $data);
        if($this->db->affected_rows() > 0) {
          $this->db->where('record_srl', $data['record_srl']);
          $result = $this->db->get($this->table)->row_array();
          $result['msg'] = 'SUCCESS';
        } else
          $result['msg'] = 'NO_CHANGE';
      }
      else
        $result['msg'] = 'DUPLICATED_AREA';
    }
    return $result;
  }

  public function getRecords($congregation, $record_per_page = NULL, $page = 1, $from = NULL, $to = NULL)
  {
    if($congregation != NULL)
      $this->db->where('congregation', $congregation);

    if($from != NULL && $to != NULL) {
      $this->db->where('visit_start >=', $from);
      $this->db->where('visit_start <=', $to);
    }

    $this->db->order_by('visit_start desc, area desc');

    if($record_per_page != NULL)
      $this->db->limit($record_per_page, $page * $record_per_page);

    $result = $this->db->get($this->table);
    return $result->result_array();
  }

  public function getTerminalRecord($congregation = NULL, $terminal = 'desc')
  {
    if($congregation != NULL)
    {
      $this->db->where('congregation', $congregation);
    }
    $this->db->order_by('visit_start '.$terminal.', area '.$terminal);
    $this->db->limit(1);
    $result = $this->db->get($this->table);
    return $result->row_array();
  }

  public function getNumOfRecords($congregation)
  {
    $this->db->where('congregation', $congregation);
    $query = $this->db->get($this->table);
    return $query->num_rows();
  }
}
