<?php
class Cart extends CI_Model {

  var $case_id = '';
  var $user_id  = '';
  var $cart_session  = '';
  
  function __construct()
  {
      parent::__construct();
  } 
  
  function mycart($user_id)
  {
    $query = $this->db->query("select * from carts LEFT JOIN cases on carts.case_id = cases.id LEFT JOIN prices on cases.budget_id = prices.id where carts.user_id = '$user_id' ORDER BY carts.created_at DESC");
    return $query->result_array();
  }
  
  function create_new($id, $cart_session)
  {
    $this->case_id = $id;
    $this->cart_session = $cart_session;
    $this->created_at = date("Y-m-d H:i:s");
    if ($this->session->userdata('id') != ""){
      $this->user_id = $this->session->userdata('id');
    }
    
    $ret = $this->db->insert('carts', $this);
  }
  
}

?>