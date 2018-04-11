<?php
namespace app\home\validate;

use think\Validate;

/**
 * Users验证场景
 */
class Users extends Validate {
	protected $rule = [
		'name' => 'require|min:5|max:16',
		'password' => 'require|max:16',
		'email' => 'email',
	];
	protected $message = [
		'name.require' => '名称必须！',
		'name.max' => '名称不能超过16个字符！',
		'name.min' => '名称不能少于5个字符！',
		'email' => '邮箱格式错误！',
	];

}