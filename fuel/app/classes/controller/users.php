<?php
class Controller_Users extends Controller_Template 
{

	public function action_create()
	{
		$fields = \Fieldset::forge('user')->add_model('Model_User');

		if (Input::method() == 'POST')
		{
			$fields->repopulate();
			$val = $fields->validation();

			if ($val->run())
			{
				$user = Model_User::forge($fields->validated());
				$auth = Auth::forge('simpleauth');
				$user->password = $auth->hash_password($user->password);

				if ($user and $user->save())
				{
					Session::set_flash('success', 'Added user "'.$user->username.'".');

					Response::redirect('login');
				}

				else
				{
					Session::set_flash('error', 'Could not save user.');
				}
			}
			else
			{
				$fields->populate($fields->validated());
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('users/create');

	}

	public function action_login()
	{
		$fields = \Fieldset::forge('user')->add_model('Model_User');

		if (Input::method() == 'POST')
		{
			$fields->repopulate();
			$user = Model_User::forge($fields->input());
			$auth = Auth::forge('simpleauth');
			if ($auth->login($user->username, $user->password))
			{

				$user_id = $auth->get_user_id();
				$loginUser = Model_User::find($user_id[1]);
				$now = Date::forge();
				$loginUser->last_login = $now->format('mysql');
				$loginUser->save();

				Session::set_flash('success', 'logedin user "'.$loginUserr->username.'".');

				Response::redirect('memos');
			}

			else
			{
				Session::set_flash('error', 'Could not login user.');
			}
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('users/login');
	}

	public function action_logout()
	{
		Auth::logout();
		Response::redirect('login');
	}

}