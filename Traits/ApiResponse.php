<?php
namespace app\Traits;
use Yii;
trait ApiResponse
{
	protected function requestJson($method = "get", $data = null)
	{
		$request = $data == null ? Yii::$app->request : $data;
		return $this->asJson($request->$method());
	}

	protected function responseJson($array) {
		return $this->asJson(['data'=>$array]);
	}
}
