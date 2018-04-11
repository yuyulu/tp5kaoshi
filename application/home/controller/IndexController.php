<?php
namespace app\home\controller;
use think\Controller;

class IndexController extends Controller {
	public function index() {
		return $this->fetch();
	}
	public function welcome() {
		$count = count(glob(TIKU . '/*.php'));
		$data = require TIKU . "1.php";
		//读取题库
		$info = []; //保存题库信息
		for ($i = 1; $i <= $count; $i++) {
			//获取题库
			$data = require TIKU . "$i.php";
			$info[$i] = [
				'title' => $data['title'],
				'time' => round($data['timeout'] / 60),
				'score' => getDataTotal($data['data']),
			];
		}
		unset($data);
		$this->assign('info', $info);
		return $this->fetch();
	}
}
