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
    $this->db->order_by("id", "desc");
    $result = $this->db->get('prices');
    return $result->result_array();
  }
  
  function by_id($id)
  {
    $query = $this->db->query("select * from prices  WHERE id=$id ");
    $ret = $query->result_array();

    if (sizeof($ret) > 0 ){
      return $ret[0];
    }else{
      return NULL;
    }
  }
  

}

?>