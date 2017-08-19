<?php

class Search extends CI_Model{

	var $table = 'site_pages';

	function get()
	{

		$q = $this->input->get('q');
		$q = addslashes($q);

		$page = $this->input->get('page');
		if($page == false){
			$page = 1;
		}
		$limit = 10;
		$start = $page * $limit - $limit;

		$sql = "SELECT * ";
		$sql .= "FROM $this->table ";
		$sql .= "WHERE 1 ";
		$sql .= "AND (";

		$sql .= "title LIKE '%$q%' OR ";
		$sql .= "title_id LIKE '%$q%' OR ";
		$sql .= "title_fr LIKE '%$q%' OR ";
		$sql .= "title_th LIKE '%$q%' OR ";
		$sql .= "title_de LIKE '%$q%' OR ";

		$sql .= "keywords LIKE '%$q%' OR ";
		$sql .= "keywords_id LIKE '%$q%' OR ";
		$sql .= "keywords_fr LIKE '%$q%' OR ";
		$sql .= "keywords_th LIKE '%$q%' OR ";
		$sql .= "keywords_de LIKE '%$q%' OR ";

		$sql .= "description LIKE '%$q%' OR ";
		$sql .= "description_id LIKE '%$q%' OR ";
		$sql .= "description_fr LIKE '%$q%' OR ";
		$sql .= "description_th LIKE '%$q%' OR ";
		$sql .= "description_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail2 LIKE '%$q%' OR ";
		$sql .= "detail2_id LIKE '%$q%' OR ";
		$sql .= "detail2_fr LIKE '%$q%' OR ";
		$sql .= "detail2_th LIKE '%$q%' OR ";
		$sql .= "detail2_de LIKE '%$q%' OR ";

		$sql .= "detail3 LIKE '%$q%' OR ";
		$sql .= "detail3_id LIKE '%$q%' OR ";
		$sql .= "detail3_fr LIKE '%$q%' OR ";
		$sql .= "detail3_th LIKE '%$q%' OR ";
		$sql .= "detail3_de LIKE '%$q%' OR ";

		$sql .= "detail4 LIKE '%$q%' OR ";
		$sql .= "detail4_id LIKE '%$q%' OR ";
		$sql .= "detail4_fr LIKE '%$q%' OR ";
		$sql .= "detail4_th LIKE '%$q%' OR ";
		$sql .= "detail4_de LIKE '%$q%' OR ";

		$sql .= "detail5 LIKE '%$q%' OR ";
		$sql .= "detail5_id LIKE '%$q%' OR ";
		$sql .= "detail5_fr LIKE '%$q%' OR ";
		$sql .= "detail5_th LIKE '%$q%' OR ";
		$sql .= "detail5_de LIKE '%$q%' OR ";

		$sql .= "detail6 LIKE '%$q%' OR ";
		$sql .= "detail6_id LIKE '%$q%' OR ";
		$sql .= "detail6_fr LIKE '%$q%' OR ";
		$sql .= "detail6_th LIKE '%$q%' OR ";
		$sql .= "detail6_de LIKE '%$q%' OR ";

		$sql .= "detail7 LIKE '%$q%' OR ";
		$sql .= "detail7_id LIKE '%$q%' OR ";
		$sql .= "detail7_fr LIKE '%$q%' OR ";
		$sql .= "detail7_th LIKE '%$q%' OR ";
		$sql .= "detail7_de LIKE '%$q%' ";

		$sql .= ")";
		$sql .= "ORDER BY page_id DESC " ;
		$sql .= "LIMIT $start, $limit ";
		$query = $this->db->query($sql);
		$data['rows'] = $query->result();

		$sql = "SELECT COUNT(*) AS num ";
		$sql .= "FROM $this->table ";
		$sql .= "WHERE 1 ";
		$sql .= "AND (";

		$sql .= "title LIKE '%$q%' OR ";
		$sql .= "title_id LIKE '%$q%' OR ";
		$sql .= "title_fr LIKE '%$q%' OR ";
		$sql .= "title_th LIKE '%$q%' OR ";
		$sql .= "title_de LIKE '%$q%' OR ";

		$sql .= "keywords LIKE '%$q%' OR ";
		$sql .= "keywords_id LIKE '%$q%' OR ";
		$sql .= "keywords_fr LIKE '%$q%' OR ";
		$sql .= "keywords_th LIKE '%$q%' OR ";
		$sql .= "keywords_de LIKE '%$q%' OR ";

		$sql .= "description LIKE '%$q%' OR ";
		$sql .= "description_id LIKE '%$q%' OR ";
		$sql .= "description_fr LIKE '%$q%' OR ";
		$sql .= "description_th LIKE '%$q%' OR ";
		$sql .= "description_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail1 LIKE '%$q%' OR ";
		$sql .= "detail1_id LIKE '%$q%' OR ";
		$sql .= "detail1_fr LIKE '%$q%' OR ";
		$sql .= "detail1_th LIKE '%$q%' OR ";
		$sql .= "detail1_de LIKE '%$q%' OR ";

		$sql .= "detail2 LIKE '%$q%' OR ";
		$sql .= "detail2_id LIKE '%$q%' OR ";
		$sql .= "detail2_fr LIKE '%$q%' OR ";
		$sql .= "detail2_th LIKE '%$q%' OR ";
		$sql .= "detail2_de LIKE '%$q%' OR ";

		$sql .= "detail3 LIKE '%$q%' OR ";
		$sql .= "detail3_id LIKE '%$q%' OR ";
		$sql .= "detail3_fr LIKE '%$q%' OR ";
		$sql .= "detail3_th LIKE '%$q%' OR ";
		$sql .= "detail3_de LIKE '%$q%' OR ";

		$sql .= "detail4 LIKE '%$q%' OR ";
		$sql .= "detail4_id LIKE '%$q%' OR ";
		$sql .= "detail4_fr LIKE '%$q%' OR ";
		$sql .= "detail4_th LIKE '%$q%' OR ";
		$sql .= "detail4_de LIKE '%$q%' OR ";

		$sql .= "detail5 LIKE '%$q%' OR ";
		$sql .= "detail5_id LIKE '%$q%' OR ";
		$sql .= "detail5_fr LIKE '%$q%' OR ";
		$sql .= "detail5_th LIKE '%$q%' OR ";
		$sql .= "detail5_de LIKE '%$q%' OR ";

		$sql .= "detail6 LIKE '%$q%' OR ";
		$sql .= "detail6_id LIKE '%$q%' OR ";
		$sql .= "detail6_fr LIKE '%$q%' OR ";
		$sql .= "detail6_th LIKE '%$q%' OR ";
		$sql .= "detail6_de LIKE '%$q%' OR ";

		$sql .= "detail7 LIKE '%$q%' OR ";
		$sql .= "detail7_id LIKE '%$q%' OR ";
		$sql .= "detail7_fr LIKE '%$q%' OR ";
		$sql .= "detail7_th LIKE '%$q%' OR ";
		$sql .= "detail7_de LIKE '%$q%' ";

		$sql .= ")";
		$query = $this->db->query($sql);
		$rs = $query->result();
		$data['items'] = $rs[0]->num;
		$data['pages'] = ceil($rs[0]->num/$limit);
		return $data;
	}
	
}
