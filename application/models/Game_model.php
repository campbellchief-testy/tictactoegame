<?php 
class Game_model extends CI_Model {

        private $grid;
        private $player1;
        private $player2;
        private $gameStatus;

        public function __construct()
        {
             // Call the CI_Model constructor
             parent::__construct();
                
        }
        
        public function new_game($p1name, $p2name) {
        	if(strlen($p1name) > 50) {
        		$p1name = substr($p1name, 0, 50);
        	}
        	
        	if(strlen($p2name) > 50) {
        		$p2name = substr($p2name, 0, 50);
        	}
        	 
        	
        	$this->grid = array(
        			array("", "", ""),
        			array("", "", ""),
        			array("", "", "")
        	);
        	$this->player1 = "";
        	$this->player2 = "";
        	$this->gameStatus = 0;
        	$this->session->player1 = strip_tags($p1name);
        	$this->session->player2 = strip_tags($p2name);
        	$this->session->grid = $this->grid;
        	$this->session->turn = 1;
        	$this->session->avail = 9;
        	$this->session->error = 0;
        	$this->session->finished = 0;
        	     
        }
        
        public function take_turn($row, $col, $type) {
        	$this->session->error = "";
        	$this->session->status = 0;
        	if($this->session->avail < 1) {
        		$this->session->error="The game has ended. Please try again.";
        		$this->session->status = 1;
        	}
        	else if($row > 2 || $col > 2) {
        		$this->session->error="You can't select more. Please try again.";
        		$this->session->status = 1;
        	}
        	else {
	        	$this->grid = $this->session->grid;
	        	if($this->grid[$row][$col] == "") {
	        		$this->grid[$row][$col] = $type;
	        		$this->session->avail--;
	        		$this->session->grid = $this->grid;
	        		if($this->session->turn == 1) {
	        			$this->session->turn = 2;
	        		}
	        		else {
	        			$this->session->turn = 1;
	        		}
	        	}
	        	else {
	        		$this->session->error="Row is already selected. Please try again.";
	        		$this->session->status = 1;
	        	}
        	}
        }
        
        public function checkSuccess($tic, $key="X") {
        	// https://www.youtube.com/watch?v=qjOZtWZ56lc
        	$numberWang = 0;
        	for($i = 0; $i < 3; $i++) {
        		if($tic[$i][0] == $key && $tic[$i][1] == $key && $tic[$i][2] == $key) {
        			// That's numberWang
        			$numberWang = 1;
        		}
        		if($tic[0][$i] == $key && $tic[1][$i] == $key && $tic[2][$i] == $key) {
        			// That's numberWang
        			$numberWang = 1;
        		}
        
        	}
        	if($tic[0][0] == $key && $tic[1][1] == $key && $tic[2][2] == $key) {
        		// That's numberWang
        		$numberWang = 1;
        	}
        	if($tic[0][2] == $key && $tic[1][1] == $key && $tic[2][0] == $key) {
        		// That's numberWang
        		$numberWang = 1;
        	}
        	// Thank you for playing numberWang - see you next week!
        	return $numberWang;
        }
        

        public function get_last_five_entries()
        {
                $query = $this->db->get('entries', 5);
                return $query->result();
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }
        
        public function get_game($game = FALSE) {
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('game');
	                return $query->result_array();
	        }
	
	        $query = $this->db->get_where('game', array('slug' => $slug));
	        return $query->row_array();
		}
        

}
?>
