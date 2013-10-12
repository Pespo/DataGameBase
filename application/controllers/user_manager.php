<?php
 
class User_manager extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('user_manager_model');
		//$this->load->controller('user');
    }
	
    public function index() 
	{
        $this->home();
    }
 
    public function home() 
	{
		$data = array();
        $data['users'] = $this->user_manager_model->get_list();

		$this->load->view('head');
		$this->load->view('menu');
        $this->load->view('users_list', $data);
		$this->load->view('footer');
    }
	
	public function add_user()
	{		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		
		$this->form_validation->set_rules('name', 		'"Nom"', 		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('firstname', 	'"Prénom"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('phone',		'"Téléphone"',	'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('email',		'"Email"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('pseudo',		'"Surnom"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		
		if($this->form_validation->run())
		{	
			$id = $this->game_manager_model->add_game(	
				$this->input->post('name'), 
				$this->input->post('firstname'),
				$this->input->post('phone'),
				$this->input->post('email'),
				$this->input->post('pseudo'));
						
			$file_path =  './assets/images/users/' . $id . ' - ' . $this->input->post('name') . ' ' . $this->input->post('firstname');
			if(!is_dir($file_path)) 
			{
				mkdir($file_path);
			}
			
			$config['upload_path'] = $file_path;
			$config['allowed_types'] = 'png';
			$config['max_size']	= '2048';
			$this->upload->initialize($config);

			if( ! $this->upload->do_upload('photo')) 
			{
				echo $this->upload->display_errors();
			} 
			else 
			{
				$finfo = $this->upload->data();
				if($finfo['image_height'] > 200) 
				{
					$this->create_image($finfo['full_path'], 'photo_xl', $finfo['image_height']);
					$this->create_image($finfo['full_path'], 'photo_l', '200');
				} 
				else
				{
					$this->create_image($finfo['full_path'], 'photo_xl', $finfo['image_height']);
				}
				$this->create_image($finfo['full_path'], 'photo_m', '100');
				$this->create_image($finfo['full_path'], 'photo_s', '50');
				unlink($finfo['full_path']);
   
					
				//$this->load->view('add_success');
				redirect(current_url());
			}
		}
		
		$data = array();
        $data['name'] = $this->user_manager_model->get_name_list();
		$data['firstname'] = $this->user_manager_model->get_firstname_list();
		$data['email'] = $this->user_manager_model->get_email_list();
		$data['pseudo'] = $this->user_manager_model->get_pseudo_list();
		
		$this->load->view('head');
		$this->load->view('menu');
		$this->load->view('add_user', $data);
		$this->load->view('footer');
	}
	
    function create_image($file, $file_name, $height) {
		$this->load->library('image_lib');
		
        $config['image_library']   	= "gd2";
        $config['source_image']    	= $file;
        $config['maintain_ratio']  	= TRUE;
		$config['master_dim']		= "height";
        $config['height'] 			= $height;
        $config['width'] 			= "1";
		$config['new_image']   		= $file_name.".png";
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
	}    
}