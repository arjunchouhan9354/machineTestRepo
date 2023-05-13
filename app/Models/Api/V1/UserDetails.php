<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class UserDetails extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users_detail';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'user_id',
        'address',
        'dob',
        'profile_pic',
        'pic_code',
        'city'  
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

	function getUsersData($userId)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('users_detail');
		$builder->select('*');
		$builder->join('users_table', 'users_detail.user_id = users_table.user_id', 'left');
		$builder->join('users_services', 'users_detail.user_id = users_services.user_id', 'left');
		$builder->where('users_table.user_id', $userId);
		$query = $builder->get()->getResult();
		return $query;
	}

}
