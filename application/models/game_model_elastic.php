<?php  
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class Game_model_elastic extends CI_Model
{
	
	var $connection 			= '192.168.157.130:9999';
	var $client;
	var $elasticaClient;

	
	function __construct(){
        parent::__construct();
		$this->load->model('game_model');
		
		//Ouverture de la connection vers elastic
		$params = array();
		$params['hosts'] = array ($this->connection);
		
		$this->client = new Elasticsearch\Client($params);
		
		$this->elasticaClient = new \Elastica\Client(array('host' => '192.168.157.130','port' => 9999));
		
	}
	
	public function add_game($game_id){
	
		$jeu = $this->game_model->get_game($game_id);

		//Recuperation des parametres a indexes
		$paramsindex = array();
		$paramsindex['body']  = array('nom' => $jeu->title, 'genre' => $jeu->genres, 'editeur' => $jeu->publishers, 'developpeur' => $jeu->developers, 'univers' => $jeu->universes, 'console' => $jeu->console);

		$paramsindex['index'] = 'jeux';
		$paramsindex['type']  = 'jeux';
		$paramsindex['id'] = $jeu->id;

		$ret = $this->client->index($paramsindex);
		
	}
	
	public function search_game($search){
	
		//$params['index'] = 'jeux';
		//$params['type']  = 'jeux';
		$query = new \Elastica\Query\Builder('{"query": {"bool": {"must": [{"query_string": {"default_field": "_all","query": "*'.$search.'*"}}]}}}');
		// Create a raw query since the query above can't be passed directly to the search method used below
		$query = new Elastica\Query($query->toArray()); 
		// Create the search object and inject the client
		$searchEl = new Elastica\Search($this->elasticaClient); 
		// Configure and execute the search
		$resultSet = $searchEl->addIndex('jeux')->addType('jeux')->search($query);
		//$json = '{"query": {"bool": {"must": [{"query_string": {"default_field": "_all","query": "*'.$search.'*"}}]}}}';
		//$params['body']['query']['match']['_all'] = "*".$search."*";
		//$params['body']=$json;
		//$results = $this->client->search($params);
		
		//print_r($resultSet);
		
		return $resultSet;
	}

}