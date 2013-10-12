<?php
 
class Game extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
		$this->load->model('game_model');
    }
	
    public function index($id) 
	{
        $this->home($id);
    }
 
    public function home($id)
	{
		$data['game'] = $this->game_model->get_game($id);

		$this->load->view('head');
		$this->load->view('menu');
        $this->load->view('game', $data);
		$this->load->view('footer');
    }
}