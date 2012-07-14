<?php

class Observer_SetUserId extends Orm\Observer
{

	public function before_save(Orm\Model $model)
	{
		if (\DBUtil::field_exists($model->table(), 'user_id')) {
			$user_id = Auth::get_user_id();
			$model->set('user_id',  $user_id[1]);
		}
	}

}
