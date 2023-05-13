<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class JobListModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'job_list_tbl';
	protected $primaryKey           = 'job_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		
		"job_title",
		"created_date",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	function getAllJobListMapping()
	{

		$db = \Config\Database::connect();
		$query = $db->table('job_list_tbl')
            ->select("job_list_tbl.job_id, job_list_tbl.job_title, IF(usersjob_mapping_tbl.id IS NOT NULL, 'checked', '') AS applied")
            ->Join('usersjob_mapping_tbl', 'job_list_tbl.job_id = usersjob_mapping_tbl.job_id','left')
            ->Join('users_table', 'usersjob_mapping_tbl.user_id = users_table.user_id','left')
            ->groupBy('job_list_tbl.job_id');

		$results = $query->get()->getResult();
		return $results;

	}

}
