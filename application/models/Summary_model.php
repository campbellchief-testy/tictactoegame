<?php
class Summary_model extends CI_Model {
		
        public function __construct() {
        	// Call the CI_Model constructor
        	parent::__construct();
            $this->load->database();
        }
        
        public function get_summary ($slug = FALSE) {
        	
        	$query = $this->db->query("select p1_name, p2_name, winner_name, date_game from summary ORDER by date_game DESC LIMIT 5");
            return $query->result_array();
        	
        }
        
        public function set_summary($p1name, $p2name, $winner) {
        	
        	$time = time();
        	 
        	$item = array(
        			'p1_name' => $this->db->escape($p1name),
        			'p2_name' => $this->db->escape($p2name),
        			'winner_name' => $this->db->escape($winner),
        			'date_game' => $time
        	);
        
        	return $this->db->insert('summary', $item);
        }
        
        
}

?>
