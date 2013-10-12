<?php  
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class Game_model extends CI_Model
{
    protected $table 	= 'jeu';
	
	var $id 			= '';
	var $title 			= '';
	var $genres 		= '';
	var $publishers 	= '';
	var $developers 	= '';
	var $universes 		= '';
	var $console 		= '';
	var $have_case 		= '';
	var $have_manual 	= '';
	
	function __construct()
    {
        parent::__construct();
	}
	
	public function get_game($id)
	{	
		$game = $this->db->select("
				jeu.id_jeu AS id,
				jeu.nom AS title,
				jeu.boite AS have_case,
				jeu.manuel AS have_manual,
				jeu.id_personne AS personne,
				GROUP_CONCAT(DISTINCT genre.nom SEPARATOR ' / ') AS genres,
				GROUP_CONCAT(DISTINCT editeur.nom SEPARATOR ' / ') AS publishers,
				GROUP_CONCAT(DISTINCT developpeur.nom SEPARATOR ' / ') AS developers,
				GROUP_CONCAT(DISTINCT univers.nom SEPARATOR ' / ') AS universes,
				console.nom AS console")
			->from($this->table)
			->join('console', 'jeu.id_console = console.id_console', 'left')
			->join('est', 'jeu.id_jeu = est.id_jeu', 'left')
			->join('genre', 'est.id_genre = genre.id_genre', 'left')
			->join('edite', 'jeu.id_jeu = edite.id_jeu', 'left')
			->join('editeur', 'edite.id_editeur = editeur.id_editeur', 'left')
			->join('developpe', 'jeu.id_jeu = developpe.id_jeu', 'left')
			->join('developpeur', 'developpe.id_developpeur = developpeur.id_developpeur', 'left')
			->join('appartient', 'jeu.id_jeu = appartient.id_jeu', 'left')
			->join('univers', 'appartient.id_univers = univers.id_univers', 'left')
			->where('jeu.id_jeu', $id)
			->group_by('id')
			->get()
			->result();

		$this->id = $game[0]->id;
		$this->title = $game[0]->title;
		$this->genres = $game[0]->genres;
		$this->publishers = $game[0]->publishers;
		$this->developers = $game[0]->developers;
		$this->universes = $game[0]->universes;
		$this->console = $game[0]->console;
		$this->have_case = $game[0]->have_case;
		$this->have_manual = $game[0]->have_manual;
		$this->personne = $game[0]->personne;
		return $this;
	}

    public function update_game($id, $info_name, $info)
    {
        $data = array($info_name => $info);
		$this->db->where('id_jeu', $id);
		$this->db->update($table, $data); 
    }
	
	public function delete_game($id)
    {
		$this->db->delete('appartient', array('id_jeu' => $id));
		$this->db->delete('developpe', array('id_jeu' => $id)); 
		$this->db->delete('edite', array('id_jeu' => $id)); 
		$this->db->delete('est', array('id_jeu' => $id)); 
		$this->db->delete($table, array('id_jeu' => $id));  
    }
	
	public function get_info($id, $info_name)
	{
		return $this->db->select($info_name)->from($table)->where('id' == $id)->get()->result();
	}

}