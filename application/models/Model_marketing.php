<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_marketing extends CI_Model
{
    public function traerPaquetes()
	{
	$traer = 'SELECT *
	FROM comercio_marketing';

		$query = $this->db->query($traer);
		return $query->result();
	}
}