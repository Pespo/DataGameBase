<?php  
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class Game_model_elastic extends CI_Model
{
	
	var $connection 			= '192.168.157.130:9999';
	var $client;
	
	function __construct(){
        parent::__construct();
		$this->load->model('game_model');
		//Ouverture de la connection vers elastic
		$params = array();
		$params['hosts'] = array ($connection);
		$client = new Elasticsearch\Client($params);
	}
	
	public function add_game($id_game){
	
		$jeu = $this->game_model->get_game($id_game);

		//Recuperation des parametres a indexes
		$paramsindex = array();
		$paramsindex['body']  = array('nom' => $jeu->title, 'genre' => $jeu->genres, 'editeur' => $jeu->publishers, 'developpeur' => $jeu->developers, 'univers' => $jeu->universes, 'console' => $jeu->console);

		$paramsindex['index'] = 'jeux';
		$paramsindex['type']  = 'jeux';
		$paramsindex['id'] = $jeu->id;

		$ret = $client->index($paramsindex);
		
	}

}