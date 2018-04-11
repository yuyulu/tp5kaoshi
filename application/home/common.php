<?php
/**
 * User: alpha
 * Date: 2017/6/27
 * Time: 11:26
 * 系统方法定义文件
 */
//计算一个考题总分
function getDataTotal($data) {
	$sum = 0; //考题总分
	//从题库中读取考题分数信息
	foreach ($data as $v) {
		$sum += $v['score'];
	}

	return $sum;
}

//获取题库ID
function getTestId() {
	$id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
	//限制题库的序号最小为1
	return max($id, 1);
}

//根据题号载入题库
function getDataById($id, $toHTML = true) {
	//根据题号拼接题库文件路径
	$target = TIKU . "$id.php";
	//判断题库文件是否存在
	if (!file_exists($target)) {
		return false;
	}
	$data = require $target;

	$func = function ($data) use (&$func) {
		$result = [];
		foreach ($data as $k => $v) {
			//如果是数组，则继续递归，如果是字符串，则转义
			$result[$k] = is_array($v) ? $func($v) : (is_string($v) ? toHtml($v) : $v);
		}
		return $result;
	};

	return $toHTML ? $func($data) : $data;
}

/**
 * 获取题库信息  返回每种题型下的试题个数和每种题型中每道题的分数
 * @param array data 题库
 */
function getDataInfo($data) {
	$count = []; //保存某种题型的题目数量
	$score = []; //每道题的分值

	foreach ($data as $k => $v) {
		$count[$k] = count($v['data']);
		$score[$k] = round($v['score'] / $count[$k]);
	}

	return [$count, $score]; //使用list()接收返回值：list($count,$score);顺序依次对应
}

//HTML特殊字符转义
function toHtml($str) {
	$str = htmlspecialchars($str, ENT_QUOTES);
	return str_replace(' ', '&nbsp;', $str);
}
