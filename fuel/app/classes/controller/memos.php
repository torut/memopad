<?php
class Controller_Memos extends Controller_Template 
{
	protected $_user_id = null;

	public function before()
	{
		parent::before();
		if (!Auth::check()) {
			Session::set_flash('error', 'Required login.');
			Response::redirect('login');
		}
		$user_id = Auth::get_user_id();
		$this->_user_id = $user_id[1];

	}

	public function action_index()
	{
		$data['memos'] = Model_Memo::find('all', array('where' => array('user_id' => $this->_user_id)));
		$this->template->title = "Memos";
		$this->template->content = View::forge('memos/index', $data);

	}

	public function action_view($id = null)
	{
		$data['memo'] = Model_Memo::find($id);

		is_null($id) and Response::redirect('Memos');

		$this->template->title = "Memo";
		$this->template->content = View::forge('memos/view', $data);

	}

	public function action_create()
	{
		$fields = \Fieldset::forge('memo')->add_model('Model_Memo');

		if (Input::method() == 'POST')
		{
			$fields->repopulate();
			$val = $fields->validation();
			
			if ($val->run())
			{
				$memo = Model_Memo::forge($fields->validated());
				$memo->user_id = $this->_user_id;
				if ($memo and $memo->save())
				{
					Session::set_flash('success', 'Added memo #'.$memo->id.'.');

					Response::redirect('memos');
				}

				else
				{
					Session::set_flash('error', 'Could not save memo.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Memos";
		$this->template->content = View::forge('memos/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Memos');

		$memo = Model_Memo::find($id);

		$fields = \Fieldset::forge('memo')->add_model('Model_Memo');
		$fields->populate($memo)->repopulate();
		$val = $fields->validation();

		if ($val->run())
		{

			$input = $fields->validated();
			$memo->set('text', $input['text']);
			if ($memo->save())
			{
				Session::set_flash('success', 'Updated memo #' . $id);

				Response::redirect('memos');
			}

			else
			{
				Session::set_flash('error', 'Could not update memo #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('memo', $memo, false);
		}

		$this->template->title = "Memos";
		$this->template->content = View::forge('memos/edit');

	}

	public function action_delete($id = null)
	{
		if ($memo = Model_Memo::find($id))
		{
			$memo->delete();

			Session::set_flash('success', 'Deleted memo #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete memo #'.$id);
		}

		Response::redirect('memos');

	}


}