<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users_table';
	protected $primaryKey           = 'user_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"user_name",
		"email",
		"mobile_number",
		"status",
		"password",
		"access_token",
		"isActive",
		"isDeleted",
		"last_login",
		"createdAt",
		"updatedAt"
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'createdAt';
	protected $updatedField         = 'updatedAt';
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

	function getUserListDetails()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('users_table');
		$builder->select('*');
		$builder->join('users_detail', 'users_table.user_id = users_detail.user_id', 'left');
		$builder->join('users_services', 'users_table.user_id = users_services.user_id', 'left');
		$query = $builder->get()->getResult();
		return $query;
	}
}	

