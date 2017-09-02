<?php
class Congregation_model extends CI_Model {
  public $table = 'js_congregation';

  public function __construct()
  {
    $this->load->database();
  }

  public function writeRecord($data)
  {
    $this->db->insert($this->table, $data);
    $result = NULL;
    if($this->db->affected_rows() > 0) {
      $result = $this->db->where('congregation_srl', $this->db->insert_id())->get($this->table)->row_array();
      return $result;
    }
    else
      return $result;
  }
  public function getRecords()
  {
    $this->db->order_by('name', 'asc');
    $result = $this->db->get($this->table);
    return $result->result_array();
  }

  public function getRecord($congregation_srl, $name = NULL)
  {
    if($congregation_srl != NULL)
      $this->db->where('congregation_srl', $congregation_srl);
    if($name != NULL)
      $this->db->where('name', $name);

    $result = $this->db->get($this->table);
    return $result->row_array();
  }

}
