<?php
class Invoiceitem extends CI_Model {

  var $invoice_id = '';
  var $case_id  = '';
  var $price  = '';
  var $owner_id  = '';
  
  function __construct()
  {
      parent::__construct();
  } 

  
  function createnew($item)
  {
    $this->load->model("Invoiceitem");
    
    $this->invoice_id = $item['invoice_id'];
    $this->case_id = $item['case_id'];
    $this->price = $item['price'];
    $this->owner_id = $item['owner_id'];
    
    $ret = $this->db->insert('invoice_items', $this);
    return $ret;
  }

  
}

?>