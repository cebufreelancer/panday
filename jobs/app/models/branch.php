<?php
class Branch extends CI_Model {

  var $label = "";
  var $value1 = "";
  
  function __construct()
  {
      parent::__construct();
  } 

  function all()
  {
    $result = $this->db->order_by('name', 'asc')->get('branches');
    return $result->result_array();
  }

}

?>