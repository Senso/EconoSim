<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Building_m extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->table_name = 'player_buildings';
    }
	
	function get_all_building_types() {
        $this->db->select('*');
        $query = $this->db->get('buildings');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
		return NULL;
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
	
	function get_building_owner($b_id) {
		$query = sprintf("SELECT company,(SELECT owner FROM companies WHERE id = company) as owner FROM player_buildings WHERE id = '%s'", mysql_real_escape_string($b_id));
		
		$result = $this->db->query($query);
        if ($result->num_rows() == 1) {
            return $result->row();
        }
		return NULL;
	}
	
	function new_building($c_id, $b_id, $b_type) {
		$data = array(
			'building_id' => $b_id,
			'company' => $c_id,
			'type' => $b_type);
		$this->db->insert($this->table_name, $data);
		// TODO: return new id
	}
	
	function get_possible_production($b_id) {
		$query = sprintf("SELECT production.id,output_prod,output_qty,(SELECT name FROM products WHERE production.output_prod = products.id) as name
						 FROM production
					WHERE building_required = (SELECT building_id
												FROM player_buildings
												WHERE player_buildings.id = '%s')", mysql_real_escape_string($b_id));
		

        $result = $this->db->query($query);
		if ($result->num_rows() > 0) {
            return $result->result();
        }
	}
	
	function get_building_price($b_id) {
        $this->db->select('price');
		$this->db->where('id', $b_id);
        $query = $this->db->get('buildings');
        if ($query->num_rows() == 1) {
            return $query->row();
        }
		return NULL;		
	}
}