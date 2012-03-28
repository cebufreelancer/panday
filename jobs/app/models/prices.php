<?php
class Prices extends CI_Model {

  var $label = "";
  var $value1 = "";
  
  function __construct()
  {
      parent::__construct();
  } 

  function all()
  {
    $result = $this->db->get('prices');
    return $result->result_array();
  }

}

?>