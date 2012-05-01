<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('cart');
    $this->load->library('encrypt');
    $this->load->model("Cart"); 
    $this->load->model('News');
    $this->load->model('Admins');
    $this->load->model('Prices');
    $this->load->model('User');    
    $this->load->model('Invoices');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect("/admin");
  }
  
  public function pdf()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }

    $this->load->model("Invoices");
    $invoice = $this->Invoices->byid($_GET['id']);
	  $vars['invoice'] = $invoice;
	  $vars['invoice_items'] = $this->Invoices->get_items($_GET['id']);

    $data['user'] = $this->User->find_by_id($invoice['user_id']);
	  $data['invoice'] = $this->Invoices->byid($_GET['id']);
	  $data['invoice_items'] = $this->Invoices->get_items($_GET['id']);

    $this->load->helper(array('dompdf', 'file'));
    // page info here, db calls, etc.     
    $html = $this->load->view('account/pdf_invoice', $data, true);
    pdf_create($html, 'filename');

  }

  public function invoiceview()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $vars['invoice'] = $this->Invoices->byid($_GET['id']);
    $vars['items'] = $this->Invoices->get_items($_GET['id']);
	  $vars['title'] = "Users";
	  $vars['content_view'] = "admin/invoiceview";
	  $vars['active'] = "users";
	  $this->load->view('admin_template', $vars);
  }

  public function userview()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $vars['user'] = $this->User->find_by_id($_GET['id']);      
	  $vars['title'] = "Users";
	  $vars['content_view'] = "admin/userview";
	  $vars['active'] = "users";
	  $this->load->view('admin_template', $vars);
  }

  public function users()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $s = '';
    $t = '';
    if (isset($_GET['s']) || isset($_GET['t'])){
      if (isset($_GET['s'])){
        $s = $_GET['s'];
      }
      if (isset($_GET['t'])) {
        $t = $_GET['t'];
      }
      $vars['users'] = $this->User->all($s, $t);
    }else{
      $vars['users'] = $this->User->all('','');
    }
    
	  $vars['title'] = "Users";
	  $vars['content_view'] = "admin/users";
	  $vars['active'] = "users";
	  $this->load->view('admin_template', $vars);
  }

  public function invoices()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $vars['invoices'] = $this->Invoices->all();
	  $vars['title'] = "Invoices";
	  $vars['content_view'] = "admin/invoices";
	  $vars['active'] = "invoices";
	  $this->load->view('admin_template', $vars);
  }

  public function price_delete()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $id = $_GET['id'];
    $this->db->delete('prices', array('id' => $id)); 
    redirect("/admin/prices?delete=1");
  }

  public function price_edit()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $id = $_GET['id'];
    
    if (isset($_POST['submit'])){      
      $data = array(
         'label' => $_POST['label'] ,
         'value1' => $_POST['value1'] 
      );

      $this->db->where('id', $id);
      $this->db->update('prices', $data);

			redirect("/admin/prices?update=1");  		
    }
    
	  $vars['title'] = "Price";
	  $vars['content_view'] = "admin/price_edit";
	  $vars['active'] = "price";
	  $vars['price'] = $this->Prices->by_id($_GET['id']);
	  $this->load->view('admin_template', $vars);    
  }

  public function price_add()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }

    if (isset($_POST['submit'])){      
      $data = array(
         'label' => $_POST['label'] ,
         'value1' => $_POST['value1'] 
      );

      $this->db->insert('prices', $data); 
      $id = $this->db->insert_id();
			redirect("/admin/prices?add=1");  		
    }
    
	  $vars['title'] = "Price";
	  $vars['content_view'] = "admin/price_add";
	  $vars['active'] = "price";
	  $this->load->view('admin_template', $vars);    
  }

  public function news_edit()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $id = $_GET['id'];
    $news = $this->News->by_id($id);

    if (isset($_POST['submit'])) {
      $data = array('title' => $_POST['title'], 'contents' => $_POST['contents']);
      if (isset($_FILES['image']['name'])){
        $data['image'] = $_FILES["image"]["name"];
      }

      $this->db->where('id', $id);
      $this->db->update('news', $data);
      
      $config['upload_path'] = './assets/news/' . $id ."/";
  		$config['allowed_types'] = 'gif|jpg|png';
  		$config['max_size']	= '150';
  		$config['max_width']  = '1024';
  		$config['max_height']  = '768';

      $this->load->library('upload', $config);

      if(!file_exists($config['upload_path'])){
        mkdir($config['upload_path']);
      }

      if ( !$this->upload->do_upload('image'))
  		{
  			$vars['error'] = array('error' => $this->upload->display_errors());
  		}
  		else
  		{
        redirect("/admin/news?update=1");
  		}  		
      
      

    }


	  $vars['title'] = "News";
	  $vars['content_view'] = "admin/news_edit";
	  $vars['active'] = "news";
	  $vars['news'] = $news;
	  $this->load->view('admin_template', $vars);

  }

  public function news_delete()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $id = $_GET['id'];
    $this->db->delete('news', array('id' => $id)); 
    redirect("/admin/news?delete=1");
  }
  
  public function news_add()
  {

    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }

    if (isset($_POST['submit'])){
      
      $data = array(
         'title' => $_POST['title'] ,
         'contents' => $_POST['contents'] ,
         'created_at' => date("Y-m-d H:i:S"),
         'updated_at' => date("Y-m-d H:i:S")
      );
      if (isset($_FILES['image']['name'])){
        $data['image'] = $_FILES["image"]["name"];
      }

            
      $this->db->insert('news', $data); 
      $id = $this->db->insert_id();

      $config['upload_path'] = './assets/news/' . $id ."/";
  		$config['allowed_types'] = 'gif|jpg|png';
  		$config['max_size']	= '150';
  		$config['max_width']  = '1024';
  		$config['max_height']  = '768';

      
      $this->load->library('upload', $config);

      if(!file_exists($config['upload_path'])){
        mkdir($config['upload_path']);
      }
      
      if ( !$this->upload->do_upload('image'))
  		{
  			$vars['error'] = array('error' => $this->upload->display_errors());
  		}
  		else
  		{
  			redirect("/admin/news?add=1");
  		}  		
  		
  		
    }
    
	  $vars['title'] = "News";
	  $vars['content_view'] = "admin/news_add";
	  $vars['active'] = "news";
	  $this->load->view('admin_template', $vars);    
  }

  public function prices()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $vars['prices'] = $this->Prices->all();
	  $vars['title'] = "Prices";
	  $vars['content_view'] = "admin/prices";
	  $vars['active'] = "prices";
	  $this->load->view('admin_template', $vars);
  }
  
  public function news()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
    $vars['news'] = $this->News->getall();
	  $vars['title'] = "News";
	  $vars['content_view'] = "admin/news";
	  $vars['active'] = "news";
	  $this->load->view('admin_template', $vars);
  }
  
  public function dashboard()
  {
    if(!$this->session->userdata('admin')) {
      redirect("/admin", "location");
    }
    
	  $vars['title'] = "Dashboard";
	  $vars['content_view'] = "admin/dashboard";
	  $vars['active'] = "dashboard";
	  $this->load->view('admin_template', $vars);    
  }
  
  public function login()
  {
    
    if ($this->session->userdata('admin')){
      redirect("/admin/dashboard");
    }

    if (isset($_POST) && !empty($_POST)) {
      if ($this->Admins->login($_POST['username'], $_POST['password'])) {
        $this->session->set_userdata(array('admin' => $_POST['username']));        
        redirect("/admin/dashboard");
      }else{
	      $vars['error'] = 1;        
      }
    }
    
	  $vars['title'] = "Login";
	  $vars['content_view'] = "admin/login";
	  $vars['active'] = "login";
	  $this->load->view('admin_template', $vars);
  }

  public function index()
  {
	  $vars['title'] = "News";
	  $vars['content_view'] = "news";
	  $vars['active'] = "";
//	  $vars['new'] = $this->News->by_id($_GET['id']);
//    $vars['news'] = $this->News->latest(2);
	  $this->load->view('template', $vars);
  }
	
}

/* End of file admin.php */