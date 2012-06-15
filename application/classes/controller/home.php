<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template_Website {

	public function action_index() {

		$home = View::factory('home');

		
		$home->monuments = $this->get_random_monuments();

		$this->template->title = 'Home';
   	    $this->template->content = $home;
        
        
	}
	
	public function get_random_monuments() {
	    
	    $rows = DB::query(Database::SELECT, 'SELECT count(*) AS count FROM monumentzo.Monument' )->execute();
	    $rows = $rows->as_array();
	    $rows = $rows[0]['count'];
	    
	    do{
	        $rand[0] = rand(0, $rows-1);
	        $rand[1] = rand(0, $rows-1);
	        $rand[2] = rand(0, $rows-1);
        }while($rand[0]==$rand[1] && $rand[1]==$rand[2] && $rand[0]==$rand[2]);
	    
	    foreach($rand as $i => $r){
	        $res = DB::query(Database::SELECT, 'SELECT * FROM monumentzo.Monument LIMIT :r,1')->param(':r',$r)->execute()->as_array();
	        $result[$i] = $res[0];
	    }
	    	    
	    return $result;
	}
}
