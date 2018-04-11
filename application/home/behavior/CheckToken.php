<?php
namespace app\home\behavior;

use think\Request;

class CheckToken {
	public function run(Request $request, $params) {
		if (!$request->token) {
			return response()->json([
				'code' => 403,
				'message' => '请先登录',
			]);
		}
		if (strpos($request->token, '.') === false) {
			return response()->json([
				'code' => 403,
				'message' => '请先登录',
			]);
		}

		list($uid, $token) = explode('.', $request->token);
		$user = Users::where('id', $uid)->where('token', $token)->first();
		if (!$user) {
			return response()->json([
				'code' => 403,
				'message' => '请先登录',
			]);
		}
		$request->user = $user;

		return $next($request);
	}
}