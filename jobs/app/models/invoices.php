<?php
class Invoices extends CI_Model {

  var $description = '';
  var $total  = '';
  var $user_id  = '';
  var $status  = '';
  
  function __construct()
  {
      parent::__construct();
  } 

  function get_items($id)
  {
    $query = $this->db->query("select * from invoice_items INNER JOIN cases on cases.id = invoice_items.case_id  where invoice_id=$id");
    return $query->result_array();
  }
  
  function myinvoices($user_id)
  {
    $query = $this->db->query("select * from invoices WHERE user_id = '$user_id' ORDER BY created_at DESC");
    return $query->result_array();        
  }

  function get_companies($case_id)
  {
    $query = $this->db->query("select * from invoices left join invoice_items on invoices.id = invoice_items.invoice_id where invoice_items.case_id=2 GROUP by invoices.user_id");
    $ids = array();
    foreach($query->result_array() as $row){
      $ids[] = $row['user_id'];
    }
    $ids_str =implode($ids,"','");
    $query2 = $this->db->query("select * FROM users where  id IN ('$ids_str')");
    return $query2->result_array();
  }
  
  function by_id($id)
  {
    $user_id = $this->session->userdata('id');
    $query = $this->db->query("select * FROM invoices where user_id = $user_id AND id = '$id'");

    $ret = $query->result_array();
    return $ret[0];
  }
  
  function createnew($user_id)
  {
    $this->load->library('email');
    
    $this->load->model('User');
    $this->load->model("Cart");
    $this->load->model("Cases");
    $this->load->model("Invoiceitem");
    
    $total = 0;
    $cart = $this->Cart->mycart($user_id);
    
    foreach($cart as $c){
      $total += $c['value1'];
    }
    
    $this->description  = "Jobs ";
    $this->total        = $total;
    $this->user_id      = $user_id;
    $this->created_at   = date("Y-m-d H:i:s");
    $this->status = "complete";

    $ret = $this->db->insert('invoices', $this);
    $id = $this->db->insert_id();
    if ($ret){
      $invoice = $this->Invoices->by_id($id);

      foreach($cart as $c) {
        $item = array('invoice_id' => $invoice['id'],
          'case_id' => $c['case_id'],
          'price' => $c['value1'],
          'owner_id' => $user_id );
        $case = $this->Cases->by_id($c['case_id'], $user_id);
        $case_user = $this->User->find_by_id($case['user_id']);
        $this->Invoiceitem->createnew($item);

        $this->email->from('michaxze@gmail.com', 'Michael Gimena');
        $this->email->to($case_user['email']);
        $this->email->subject('A company just bought your case.');
        $this->email->message("To view your cases,please login with your email and password.");
        $this->email->send();
        

        
      }
    }
    return $invoice;
  }

  
}

?>