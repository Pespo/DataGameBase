<?php  
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_manager_model extends CI_Model
{
    protected $table = 'personne';
     
    /**
     *  Ajoute un jeu
     *
     *  @param string 	$name			Le nom de la personne
     *  @param array 	$firstname		Le prénom de la personne
     *  @param array 	$phone		  	Le numéro de télephone de la personne
	 *  @param array 	$email		  	L'adresse internet de la personne
	 *  @param array 	$pseudo		  	Le surnom de la personne
     *  @return bool        			Le résultat de la requête
     */
    public function add_user($name, $firstname, $phone, $email, $pseudo)
	{		
	    //  Ces données seront automatiquement échappées
        $this->db->set('nom', $name);
        $this->db->set('prénom', $firstname);
        $this->db->set('téléphone', $phone);
        $this->db->set('email', $email);
        $this->db->set('surnom', $pseudo);
			
		return $this->db->insert($this->table);
    }
	
	/**
	 *  Retourne une liste de personne.
	 * 
	 *  @param integer $nb  	Le nombre de personne
	 *  @param integer $debut   Nombre de personne à sauter
	 *  @return objet       	La liste de personne
	 */
	public function get_list($nb = 20, $debut = 0)
	{
		return $this->db
			->select(" 	{$this->table}.id_personne AS id,
						{$this->table}.nom AS name,
						{$this->table}.prenom AS firstname,
						{$this->table}.telephone AS phone,
						{$this->table}.email AS email,
						{$this->table}.surnom AS pseudo,
						")
			->from($this->table)
			->limit($nb, $debut)
			->get()
			->result();
	}
	
	public function get_name_list()
	{
		return $this->db->select('nom AS name')->from($this->table)->order_by('nom')->get()->result();
	}
	
	public function get_firstname_list()
	{
		return $this->db->select('prenom AS firstname')->from($this->table)->order_by('prenom')->get()->result();
	}
	
	public function get_phone_list()
	{
		return $this->db->select('telephone AS phone')->from($this->table)->order_by('telephone')->get()->result();
	}
	
	public function get_email_list()
	{
		return $this->db->select('email')->from($this->table)->order_by('email')->get()->result();
	}
	
	public function get_pseudo_list()
	{
		return $this->db->select('surnom AS pseudo')->from($this->table)->order_by('surnom')->get()->result();
	}
}