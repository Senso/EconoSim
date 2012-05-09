<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building_m extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->table_name = 'player_buildings';
    }

    function get_building_by_id($b_id) {
		$query = sprintf("SELECT player_buildings.id,building_id,type,company,created,
						(select name from buildings where player_buildings.id = building_id) as name
						FROM player_buildings
						WHERE player_buildings.id = '%s'", mysql_real_escape_string($b_id));

		$result = $this->db->query($query);
        if ($result->num_rows() == 1) {
            return $result->row();
        }
		return NULL;
    }
	
	function new_building($c_id, $b_type) {

	}
}