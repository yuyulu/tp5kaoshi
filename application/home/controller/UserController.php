<?php

namespace app\home\controller;

use app\models\Users;
use think\captcha\Captcha;
use think\Controller;
use think\helper\Hash;
use think\helper\Str;
use think\Request;

class UserController extends Controller {
	/**
	 * 显示资源列表
	 *
	 * @return \think\Response
	 */
	public function index() {
		//
	}
	public function verify() {
		$config = [
			// 验证码字体大小
			'fontSize' => 18,
			'useCurve' => false,
			'fontttf' => '5.ttf',
			'imageH' => 38,
			'imageW' => 180,
			// 验证码位数
			'length' => 4,
		];
		$captcha = new Captcha($config);
		return $captcha->entry();
	}
	public function login() {
		if (!$this->request->isPost()) {
			return $this->fetch();
		};
		$request = $this->request->param();
		$captcha = new Captcha();
		if (!$captcha->check($request['verify'])) {
			return ['code' => 500, 'msg' => '验证码错误！'];
		}
		$user = Users::where('email', $request['email'])
			->find();
		if (!$user) {
			return ['code' => 500, 'msg' => '用户不存在'];
		}
		if (!Hash::check($request['password'], $user['password'])) {
			return ['code' => 500, 'msg' => '密码不正确'];
		};
		$user->remember_token = Str::random();
		$user->save();
		return [
			'code' => 200,
			'data' => [
				'token' => $user->id . '.' . $user->remember_token,
				'userinfo' => [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
				],
			],
		];
	}
	/**
	 * 显示创建资源表单页.
	 *
	 * @return \think\Response
	 */
	public function create() {
		if (!$this->request->isPost()) {
			return $this->fetch();
		};
		$post = $this->request->param();
		$result = $this->validate($post, 'app\home\validate\Users');
		if (true !== $result) {
			return ['code' => 401, 'msg' => $result];
		}
		$post['password'] = Hash::make($post['password']);
		$post['remember_token'] = Str::random();
		Users::create($post);
		return ['code' => 200, 'msg' => '您已成功注册！'];
	}

	/**
	 * 保存新建的资源
	 *
	 * @param  \think\Request  $request
	 * @return \think\Response
	 */
	public function save(Request $request) {
		$user = Users::get(2);
		$user->name = 'iknow';
		$user->save();
	}

	/**
	 * 显示指定的资源
	 *
	 * @param  int  $id
	 * @return \think\Response
	 */
	public function read($id) {
		//题库id
		$id = getTestId($id);
		//题库数据
		$data = getDataById($id);
		if (!$data) {
			$this->error('题库错误！');
		}
		list($count, $score) = getDataInfo($data['data']);
		$assign = array(
			'data' => $data,
			'count' => $count,
			'score' => $score,
			'id' => $id,
		);
		$this->assign($assign);
		//引入答题页模板
		return $this->fetch();
	}
	public function total() {
		$id = getTestId(); //提交考题的序号
		$data = getDataById($id, false); //获取考题内容

		//判断题库是否存在
		if (!$data) {
			$this->error('题库错误！');
		}
		//获取题库信息
		list($count, $score) = getDataInfo($data['data']);
		//开始阅卷操作
		$sum = 0; //保存总得分
		$total = []; //记录考试结果
		foreach ($data['data'] as $type => $each) {
			foreach ($each['data'] as $k => $v) {
				//取出提交的答案
				$answer = isset($_POST[$type][$k]) ? $_POST[$type][$k] : '';
				//判断答案是否正确
				if ($v['answer'] === $answer) {
					$total[$type][$k] = true;
					$sum += $score[$type];
				} else {
					$total[$type][$k] = false;
				}
			}
		}
		$this->assign('total', $total);
		return $this->fetch();
	}
	/**
	 * 删除指定资源
	 *
	 * @param  int  $id
	 * @return \think\Response
	 */
	public function delete($id) {
		//
	}
}
