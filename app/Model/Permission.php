<?php  namespace App\Model;

use Artesaos\Defender\Permission as PermissionDefender;

class Permission extends PermissionDefender {
	protected $dateFormat = 'Y-m-d H:i:s';
}