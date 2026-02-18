<?php
class Game extends CI_Controller {
		private $X = "X";
		private $O = "O";
        
        public function __construct()
        {
                parent::__construct();
                $this->load->model('game_model');
                $this->load->model('summary_model');
                $this->load->helper('url_helper');
                $this->load->library('session');
        }
		
        public function view($page = 'home') {
        	if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        	{
        		// Whoops, we don't have a page for that!
        		show_404();
        	}
        	
        	$data['title'] = ucfirst($page); // Capitalize the first letter
        	if($page == "home") {
        		$data['title'] = "Welcome to Tic Tac Toe";
        	}
        	$data['summary'] = $this->summary_model->get_summary();
        	$this->load->view('templates/header', $data);
        	$this->load->view('pages/'.$page, $data);
        	$this->load->view('templates/footer', $data);
        }
        
        public function create() {
        	$this->load->helper('form');
        	$this->load->library('form_validation');
        
        	$data['title'] = 'Time for a new game';
        
        	$this->form_validation->set_rules('player1', 'Player 1 Name', 'trim|required');
        	$this->form_validation->set_rules('player2', 'Player 2 Name', 'trim|required');
        
        	if ($this->form_validation->run() === FALSE) {
        		$data['summary'] = $this->summary_model->get_summary();
        		$this->load->view('templates/header', $data);
        		$this->load->view('game/new', $data);
        		$this->load->view('templates/footer', $data);
        
        	}
        	else {
        		$this->game_model->new_game($this->input->post('player1'),$this->input->post('player2'));
        		redirect('playgame', 'refresh');
        	}
        }
        
        public function playGame() {
        	$this->sharedGameStuff();
        }
        
        public function add() {
        	$this->session->error = 0;
        	$currentTurn = $this->session->turn;
        	if($this->session->avail > 0) {
        		$row = $this->input->get('row');
        		$col = $this->input->get('col');
        		
        		$type = $this->X;
        		if($this->session->turn > 1) {
        			$type = $this->O;
        		}
        		$this->game_model->take_turn($row, $col, $type);
        		$grid = $this->session->grid;
        		$isSuccessForX = $this->game_model->checkSuccess($grid, $this->X);
        		$isSuccessForO = $this->game_model->checkSuccess($grid, $this->O);
        		if($isSuccessForX || $isSuccessForO) {
        			$this->checkForWinner($currentTurn);
        		}
        		else {
        			$this->sharedGameStuff();
        		}
        	}
        	else {
        		$this->checkForWinner($currentTurn);
        
        	}
        }
        
        private function sharedGameStuff() {
        	if($this->session->avail < 1) {
        		$currentTurn = $this->session->turn;
        		$this->checkForWinner($currentTurn);
        	}
        	else {
        		$data['summary'] = $this->summary_model->get_summary();
	        	$data['title'] = 'Tic Tac Toe Game In Progress';
	        	$data['player1'] = $this->session->player1;
	        	$data['player2'] = $this->session->player2;
	        	$data['turn'] = $this->session->turn;
	        	$data['grid'] = $this->session->grid;
	        	$data['error'] = $this->session->error;
	        	$data['errorStatus'] =$this->session->status;
	        	$data['turnsLeft'] = $this->session->avail;
	        	$this->load->view('templates/header', $data);
	        	$this->load->view('game/thegame');
	        	$this->load->view('templates/footer');
        	}
        }
        
        private function winner($turn) {
        	if($turn > 1) {
        		$data['winner'] = 1;
        		$data['winnerName'] = $this->session->player1;
        	}
        	else {
        		$data['winner'] = 2;
        		$data['winnerName'] = $this->session->player2;
        	}
        	$this->session->avail = 0;
        	$data['title'] = 'Tic Tac Toe';
        	$data['player1'] = $this->session->player1;
        	$data['player2'] = $this->session->player2;
        	$data['turnsLeft'] = $this->session->avail;
        	$data['grid'] = $this->session->grid;
        	$this->session->error = 0;
        	$data['summary'] = $this->summary_model->get_summary();
        	$this->load->view('templates/header', $data);
        	$this->load->view('game/winner');
        	$this->load->view('templates/footer');
        }
        
        private function stalemate($turn) {
        	
        	$this->session->avail = 0;
        	$data['title'] = 'Tic Tac Toe';
        	$data['player1'] = $this->session->player1;
        	$data['player2'] = $this->session->player2;
        	$data['turn'] = $this->session->turn;
        	$data['grid'] = $this->session->grid;
        	$this->session->error = 0;
        	$data['summary'] = $this->summary_model->get_summary();
        	$this->load->view('templates/header', $data);
        	$this->load->view('game/stalemate');
        	$this->load->view('templates/footer');
        }
        
        
        
        private function checkForWinner($currentTurn) {
        	$grid = $this->session->grid;
        	$isSuccessForX = $this->game_model->checkSuccess($grid, $this->X);
        	$isSuccessForO = $this->game_model->checkSuccess($grid, $this->O);
        	$currentTurn = $this->session->turn;
        	if($isSuccessForX > 0 || $isSuccessForO > 0) {
        		$this->saveGameHistory($isSuccessForX, $isSuccessForO);
        		$this->winner($currentTurn);
        	}
        	else {
        		$this->saveGameHistory($isSuccessForX, $isSuccessForO);
        		$this->stalemate($currentTurn);
        	}
        }
        
        private function saveGameHistory($forX, $forO) {
        	if($this->session->finished == 0) {
        		$winner = "Game Drawn";
        		$player1 = $this->session->player1;
        		$player2 = $this->session->player2;
        		if($forX > 0) {
        			$winner = $player1;
        		}
        		else if($forO > 0) {
        			$winner = $player2;
        		}
        		$this->summary_model->set_summary($player1, $player2, $winner);
        		$this->session->finished = 1;
        	}
        }
        
        
}
