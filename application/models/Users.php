<?php
namespace app\models;
use think\Model;

/**
 * 会员管理Model
 */
class Users extends Model {
	// 定义时间戳字段名
	protected $createTime = 'created_at';
	protected $updateTime = 'updated_at';
	protected $autoWriteTimestamp = 'datetime';
}