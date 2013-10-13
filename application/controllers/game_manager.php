<?php
require 'vendor/autoload.php'; 
class Game_manager extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('game_manager_model');
		$this->load->model('game_model_elastic');
		//$this->load->controller('game');
    }
	
    public function index() 
	{
        $this->home();
    }
 
    public function home() 
	{
		$data = array();
        $data['games'] = $this->game_manager_model->get_list();

		$this->load->view('head');
		$this->load->view('menu');
        $this->load->view('games_list', $data);
		//$this->load->view('export_csv', $data);
		$this->load->view('footer');
    }
	
	public function add_game()
	{		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		
		$this->form_validation->set_rules('title', 		'"Nom du jeu"', 		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('genres', 	'"Genre du jeu"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('publishers',	'"Editeur du jeu"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('developers',	'"Developpeur du jeu"',	'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('universes',	'"Univers du jeu"',		'trim|min_length[1]|max_length[120]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('console',	'"Console du jeu"',		'trim|required|min_length[1]|max_length[120]|encode_php_tags|xss_clean');

		if($this->form_validation->run())
		{	
			$file_path =  './assets/images/jeux/' . str_replace(':', '-', $this->input->post('title'));
			if(!is_dir($file_path)) 
			{
				mkdir($file_path);
			}
			$config['upload_path'] = $file_path;
			$config['allowed_types'] = 'png';
			$config['max_size']	= '2048';
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('logo')) 
			{
				echo $this->upload->display_errors();
			} 
			else 
			{
				$finfo = $this->upload->data();
				if($finfo['image_height'] > 400) 
				{
					if ($finfo['image_height'] > 800) 
					{
						$this->create_image($finfo['full_path'], 'logo_xxl', $finfo['image_height']);
						$this->create_image($finfo['full_path'], 'logo_xl', '800');
					} 
					else
					{
						$this->create_image($finfo['full_path'], 'logo_xl', $finfo['image_height']);
					}
				}
				$this->create_image($finfo['full_path'], 'logo_l', '400');
				$this->create_image($finfo['full_path'], 'logo_m', '200');
				$this->create_image($finfo['full_path'], 'logo_s', '100');
				unlink($finfo['full_path']);
				
				if(!$this->upload->do_upload('cover')) 
				{
					echo $this->upload->display_errors();
				} 
				else 
				{
					$finfo = $this->upload->data();
					
					if($finfo['image_height'] > 400) 
					{
						if ($finfo['image_height'] > 800) 
						{
							$this->create_image($finfo['full_path'], 'cover_xxl', $finfo['image_height']);
							$this->create_image($finfo['full_path'], 'cover_xl', '800');
						} 
						else
						{
							$this->create_image($finfo['full_path'], 'cover_xl', $finfo['image_height']);
						}
					}
					$this->create_image($finfo['full_path'], 'cover_l', '400');
					$this->create_image($finfo['full_path'], 'cover_m', '200');
					$this->create_image($finfo['full_path'], 'cover_s', '100');
					unlink($finfo['full_path']);
    
					$game_id = $this->game_manager_model->add_game(	
						$this->input->post('title'), 
						array_filter(array_map('trim', explode(',', $this->input->post('genres')))), 
						array_filter(array_map('trim', explode(',', $this->input->post('publishers')))),
						array_filter(array_map('trim', explode(',', $this->input->post('developers')))),
						array_filter(array_map('trim', explode(',', $this->input->post('universes')))),
						$this->input->post('console'),
						$this->input->post('have_case'),
						$this->input->post('have_manual'));
					
					//$this->load->view('add_success');
					
					$this->game_model_elastic->($game_id);

					redirect(current_url());
				}
			}
		}
		
		$data = array();
        $data['title'] = $this->game_manager_model->get_list();
		$data['genres'] = $this->game_manager_model->get_genres_list();
		$data['publishers'] = $this->game_manager_model->get_publishers_list();
		$data['developers'] = $this->game_manager_model->get_developers_list();
		$data['universes'] = $this->game_manager_model->get_universes_list();
		$data['consoles'] = $this->game_manager_model->get_consoles_list();
		
		$this->load->view('head');
		$this->load->view('menu');
		$this->load->view('add_game', $data);
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
