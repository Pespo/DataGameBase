<?php  
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class Game_manager_model extends CI_Model
{
    protected $table = 'jeu';
     
    /**
     *  Ajoute un jeu
     *
     *  @param string 	$title			Le nom du jeu
     *  @param array 	$genres			Le ou les genres du jeu
     *  @param array 	$publishers  	Le ou les éditeurs du jeu
	 *  @param array 	$developers  	Le ou les développeurs du jeu
	 *  @param array 	$universes  	Le ou les univers dont fait parti le jeu	 
	 *  @param array 	$console	  	La console pour laquelle le jeu a été édité
	 *  @param array 	$have_case		Si le jeu a une boite
	 *  @param array 	$have_manual  	Si le jeu a un manuel
     *  @return bool        			Le résultat de la requête
     */
    public function add_game($title, $genres, $publishers, $developers, $universes, $console_id, $have_case, $have_manual)
	{		
		// Vérifie l'existence du ou des genres
		$genres_id = array();
		foreach($genres as $genre)
		{
			$result = $this->db->select('id_genre AS id')->from('genre')->where('nom', $genre)->get()->result();
			if($result)
			{
				array_push($genres_id, $result[0]->id); 
			}
		}
		
		// Vérifie l'existence du ou des editeurs
		$publishers_id = array();
		foreach($publishers as $publisher) {
			$result = $this->db->select('id_editeur AS id')->from('editeur')->where('nom', $publisher)->get()->result();
			if(!$result) {
				$this->db->set('nom', $publisher);
				$this->db->insert('editeur'); 
				$publisher_id = $this->db->insert_id();
				array_push($publishers_id, $publisher_id);
			} else
				array_push($publishers_id, $result[0]->id);
		}
		
		// Vérifie l'existence du ou des developpeurs
		$developers_id = array();
		foreach($developers as $developer) {
			$result = $this->db->select('id_developpeur AS id')->from('developpeur')->where('nom', $developer)->get()->result();
			if(!$result) {
				$this->db->set('nom', $developer);
				$this->db->insert('developpeur'); 
				$developer_id = $this->db->insert_id();
				array_push($developers_id, $developer_id);
			} else
				array_push($developers_id, $result[0]->id);
		}
		
		// Vérifie l'existence du ou des univers
		$universes_id = array();
		foreach($universes as $universe) {
			$result = $this->db->select('id_univers AS id')->from('univers')->where('nom', $universe)->get()->result();
			if(!$result) {
				$this->db->set('nom', $universe);
				$this->db->insert('univers'); 
				$universe_id = $this->db->insert_id();
				array_push($universes_id, $universe_id);
			} else
				array_push($universes_id, $result[0]->id);
		}
		
        //  Ces données seront automatiquement échappées
        $this->db->set('nom', $title);
        $this->db->set('id_console', $console_id);
        $this->db->set('boite', $have_case ? 1 : 0);
        $this->db->set('manuel', $have_manual ? 1 : 0);
		
		if($this->db->insert($this->table)){
			$game_id = $this->db->insert_id();
			
			foreach($genres_id as $genre_id) {
				$this->db->set('id_genre', $genre_id);
				$this->db->set('id_jeu', $game_id);
				$this->db->insert('est');
			}
			
			foreach($publishers_id as $publisher_id) {
				$this->db->set('id_editeur', $publisher_id);
				$this->db->set('id_jeu', $game_id);
				$this->db->insert('edite');
			}
			
			foreach($developers_id as $developer_id) {
				$this->db->set('id_developpeur', $developer_id);
				$this->db->set('id_jeu', $game_id);
				$this->db->insert('developpe');
			}
			
			foreach($universes_id as $universe_id) {
				$this->db->set('id_univers', $universe_id);
				$this->db->set('id_jeu', $game_id);
				$this->db->insert('appartient');
			}
		} else { 
			return 0;
		}

		return $game_id;
    }
	
	/**
	 *  Retourne une liste de $nb dernières news.
	 * 
	 *  @param integer $nb  	Le nombre de jeux
	 *  @param integer $debut   Nombre de jeux à sauter
	 *  @return objet       	La liste de news
	 */
	public function get_list($nb = 20, $debut = 0)
	{
		return $this->db
			->select("	jeu.id_jeu AS id,
						jeu.nom AS title,
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
			->limit($nb, $debut)
			->group_by('id')
			->get()
			->result();
	}
	
	public function get_genres_list()
	{
		return $this->db->select('nom')->from('genre')->order_by('nom')->get()->result();
	}
	
	public function get_publishers_list()
	{
		return $this->db->select('nom')->from('editeur')->order_by('nom')->get()->result();
	}
	
	public function get_developers_list()
	{
		return $this->db->select('nom')->from('developpeur')->order_by('nom')->get()->result();
	}
	
	public function get_universes_list()
	{
		return $this->db->select('nom')->from('univers')->order_by('nom')->get()->result();
	}
	
	public function get_consoles_list()
	{
		return $this->db->select('nom, id_console AS id')->from('console')->order_by('nom')->get()->result();
	}
}
