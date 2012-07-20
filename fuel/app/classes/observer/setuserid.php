<?php

class Observer_SetUserId extends Orm\Observer
{

	/**
	 * 独自の Observer を設定する
	 * メソッド名はcalbackのタイミング
	 * 第1引数には Observer が呼び出された元のModelが入る
	 */
	public function before_save(Orm\Model $model)
	{
		if (\DBUtil::field_exists($model->table(), 'user_id')) {
			$user_id = Auth::get_user_id();
			$model->set('user_id',  $user_id[1]);
		}
	}

}
