<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('cart');
    $this->load->library('encrypt');
    $this->load->model("Cart"); 
  }

  public function password_reset()
  {
	  $vars['title'] = "Home";
	  $vars['content_view'] = "password_reset";
	  $vars['active'] = "";
	  $vars['user'] = NULL;
	  $vars['success'] = NULL;
	  
	  if (isset($_POST['sent'])){
	    $vars['success'] = true;
	  }
	  $this->load->view('template', $vars);
  }
  
  public function activate()
  {
    $this->load->model("Tokens");
    $this->load->model("User");
    // localhost:8888/activate?email=jam@gmail.com&token=71caea2fe47427190252e1031f8e4984cb431f59
	  $vars['title'] = "";
	  $vars['content_view'] = "activate";
	  $vars['active'] = "";
	  $vars['user'] = NULL;
	  $vars['activated'] = NULL;
	  
	  $token = $this->Tokens->by_token($_GET['token']);
	  $user = $this->User->find_by_email($token['email']);
	  if ($token) {
	    if ($token['is_used'] == 0){
	      $vars["activated"] = true;
	      $this->Tokens->update_token($token);
	      $this->User->activate($user);
      }else{
        $vars['activated'] = NULL;
      }
	  }
	  $this->load->view('template', $vars);
    
  }
  
  public function register_success()
  {
    
	  $vars['title'] = "Registration for Companies";
	  $vars['content_view'] = "register_success";
	  $vars['active'] = "companies";
	  $vars['user'] = NULL;
	  $this->load->view('template', $vars);
  }
  
  public function register()
  {
    $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
	  $this->load->model("User");	  
	  $this->load->model('Prices');
	  $this->load->model('Branch');  
    $this->form_validation->set_message('is_unique[users.email]', 'Email address already exists');
    
	  $vars['title'] = "Registration for Companies";
	  $vars['content_view'] = "register";
	  $vars['active'] = "companies";
	  $vars['user'] = NULL;

	  if (isset($_POST['sent'])){
      $this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
      $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('company_name', 'Company Name', 'required|min_length[5]|is_unique[users.company_name]');
	    
	    if ($this->form_validation->run() == FALSE)
	    {
// do nothing
	    }else{
  	    $this->User->createcompany($_POST);
        $this->load->library('mailer'); 
        $this->mailer->company_activation_link($_POST['email'], $_POST['company_name']);
        redirect("/register_success", "location");	      	      
	    }
	  }

	  $vars['prices'] = $this->Prices->all();
	  $vars['branches'] = $this->Branch->all();
	  
	  
	  $this->load->view('template', $vars);
    
  }
  
  public function forget()
  { 
    $this->load->model("User");
    $this->load->library('mailer');
    $this->load->library('email');
    
	  $vars['title'] = "Forget Password";
	  $vars['active'] = "";
	  $vars['content_view'] = "forget";
	  
	  if (isset($_POST['sent'])){
	     $user = $this->User->find_by_email($_POST['email']);
	     if ($user) {
         $this->mailer->password_link($user);
	       $vars['submitted'] = true;
	     }else{
	       $vars['error'] = ERROR_103;
	     }
	  }
	  $this->load->view('template', $vars); 
  }

  
  public function details()
  {
    $this->load->model("Cases");
    $id = $_GET['id'];
	  $vars['title'] = "Cases";
	  $vars['active'] = "cases";
	  $vars['content_view'] = "details";
    $vars['case'] =  $this->Cases->by_id($id);
	  $this->load->view('template', $vars);     
  }

  public function addtocart()
  {
    $this->load->model('Cart');
    $id = $_POST['id'];
    $cart_session = $this->session->userdata('cart_session');

    if (isset($cart_session) && $cart_session != "")
    {
      $cart_session = $this->session->userdata('cart_session');
    }else{
      $cart_session = $this->encrypt->sha1(date("Y-m-d H:i:s"));
      $data = array('cart_session' => $cart_session);
      $this->session->set_userdata($data);      
    }
    
    $ret = $this->db->query("SELECT * FROM carts where cart_session = '$cart_session' AND case_id='$id'");
    if ($ret->num_rows()  ==  0 ) {
      $this->Cart->create_new($id, $cart_session);
      echo "success";
    }else{
      echo "";
    }

  }
  
  public function logout() {
    $this->session->sess_destroy();
    redirect('/', 'location');
  }

  public function login()
  {
    $this->load->model('User');
    $user = $this->User->login($_POST['email'], $_POST['password']);
    $error = "";
    
    if ($user){
      $data = array( 'email' => $user['email'], 'id' => $user['id']);

      if ($user['usertype'] == "company"){
        $data['company'] = $user['usertype'];
      }
      $this->session->set_userdata($data);
    }else{
      $error = "error=1";
    }
    redirect("/?$error", 'location');
  }
  
	public function index()
	{
	  $this->load->model('Cases');
	   
	  
	  $vars['title'] = "Home";
	  $vars['active'] = "";
	  $vars['content_view'] = "centercol";
	  
	  $vars['session_email'] = $this->session->userdata('email');
	  $vars['session_id'] = $this->session->userdata('id');
	  
	  $vars['cases'] = $this->Cases->latest(2);

	  $this->load->view('template', $vars);
	}
	
	public function cases()
	{
	  $this->load->model('Cases');
	  
	  $vars['title'] = "Cases";
	  $vars['active'] = "cases";
	  $vars['content_view'] = "cases";
	  $vars['cases'] = $this->Cases->latest(10);
	  
	  $this->load->view('template', $vars);

	}

	public function create()
	{
    $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	  
	  $this->load->model('User');
	  $this->load->model('Prices');
	  $this->load->model('Branch');
	  
	  $vars['title'] = "Create a Case";
	  $vars['content_view'] = "create";
	  $vars['active'] = "create";
	  $vars['user'] = NULL;
	  if ($this->session->userdata('email')){
	    $vars['user'] = $this->User->find_by_email($this->session->userdata('email'));
	  }
	  $vars['prices'] = $this->Prices->all();
	  $vars['branches'] = $this->Branch->all();


	  if (isset($_POST['sent'])){
	    $this->form_validation->set_rules('title', 'Title', 'required|min_length[5]');
	    $this->form_validation->set_rules('description', 'Description', 'required');
	    $this->form_validation->set_rules('city', 'City', 'required');
	    $this->form_validation->set_rules('zipcode', 'Zip code', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
      $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

	    if ($this->form_validation->run() == FALSE)
	    {
        // do nothing
      }else{
    	  $this->load->library('email');
        $this->load->model('Cases');

        $user = $this->User->find_by_email($_POST['email']);
        if ($user) {
          $this->User->update_record($user['id'], $_POST);
        }else{
          $this->User->create($_POST);
          $user = $this->User->find_by_email($_POST['email']);
        }
        $case = $this->Cases->create($_POST, $user);

        if ($case){
          $this->load->library('mailer');
          $this->mailer->user_activation_link($_POST['email'], $user['name']);
        }

    	  $vars['title'] = "Create a Case";
    	  $vars['content_view'] = "create_success";
    	  $vars['active'] = "create";

      }
    }	  
	  
	  $this->load->view('template', $vars);
	}

/*	
	public function create_case()
	{

	  $this->load->library('email');	  
    $this->load->model('User');
    $this->load->model('Cases');
    
    $user = $this->User->find_by_email($_POST['email']);
    if ($user) {
      $this->User->update_record($user['id'], $_POST);
    }else{
      $this->User->create($_POST);
      $user = $this->User->find_by_email($_POST['email']);
    }
    $case = $this->Cases->create($_POST, $user);
    
    if ($case){
      $this->email->from('michaxze@gmail.com', 'Michael Gimena');
      $this->email->to('michaxze@gmail.com');
      $this->email->subject('You have successfully created a case.');
      $this->email->message("To manage your created cases, please login with your email and password.");
      $this->email->send();
    }

	  $vars['title'] = "Create a Case";
	  $vars['content_view'] = "create_success";
	  $vars['active'] = "create";
    
    $this->load->view('template', $vars);
	}
*/

	public function companies()
	{
	  $this->load->model('User');
	  
	  $vars['title'] = "Companies";
	  $vars['active'] = "Companies";
	  $vars['content_view'] = "companies";
	  $vars['companies'] = $this->User->companies();
	  
	  $this->load->view('template', $vars);

	}

	public function about()
	{
	  $vars['title'] = "About Us";
	  $vars['active'] = "about";
	  $vars['content_view'] = "about";
	  
	  $this->load->view('template', $vars);

	}

	public function contactus()
	{
	  $vars['title'] = "Contact Us";
	  $vars['active'] = "contauct";
	  $vars['content_view'] = "contactus";
	  
	  $this->load->view('template', $vars);

	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */