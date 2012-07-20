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

	public function action_index($page = 1)
	{
		$total_items = Model_Memo::count(array('where' => array('user_id' => $this->_user_id)));

		Config::load('pagination', 'pagination');
		$paginator = array(
			'pagination_url' => Uri::create('memos'),
			'per_page' => 5,
			'total_items' => $total_items,
			'current_page' => $page,
			'template' => Config::get('pagination.template'),
		);

		Pagination::set_config($paginator);

		$data['memos'] = Model_Memo::search(
			array('user_id' => $this->_user_id),
			Pagination::$per_page,
			Pagination::$offset
		);

		$data['total_items'] = $total_items;
		$data['start_item']  = Pagination::$offset + 1;
		$data['end_item']    = Pagination::$offset + Pagination::$per_page;
		$data['per_page']    = Pagination::$per_page;

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
		$fields->add('tag', 'タグ', array('type' => 'text',), array('trim'));

		if (Input::method() == 'POST')
		{
			$fields->repopulate();
			$val = $fields->validation();

			if ($val->run())
			{
				$memo = Model_Memo::forge($fields->validated());

				$input = $fields->validated();
				$tags = explode(',', $input['tag']);
				foreach ($tags as $t) {
					$tag = Model_Tag::forge(array('tag' => $t));
					$memo->tags[] = $tag;
				}

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

		$tags = array();
		foreach(Model_Tag::find('all', array('where' => array('user_id' => $this->_user_id))) as $tag) {
			$tags[] = $tag->tag;
		}
		$this->template->set_global('tags', array_unique($tags), false);

		$this->template->title = "Memos";
		$this->template->content = View::forge('memos/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Memos');

		$memo = Model_Memo::find($id);

		$fields = \Fieldset::forge('memo')->add_model('Model_Memo');
		$fields->add('tag', 'タグ', array('type' => 'text',), array('trim'));
		$fields->populate($memo)->repopulate();

		$tags = array();
		foreach ($memo->tags as $t) {
			$tags[] = $t->tag;
		}
		$fields->field('tag')->set_value(implode(',', $tags));

		$val = $fields->validation();

		if ($val->run())
		{

			$input = $fields->validated();
			$memo->set('text', $input['text']);

			$tags = array_unique(explode(',', $input['tag']));
			$exists_tags = array();
			foreach ($memo->tags as $k => $tag) {
				if (in_array($tag->tag, $tags)) {
					$exists_tags[] = $tag->tag;
				} else {
					$tag->delete();
					unset($memo->tags[$k]);
				}
			}

			foreach ($tags as $t) {
				if (!in_array($t, $exists_tags)) {
					$tag = Model_Tag::forge(array('tag' => $t));
					$memo->tags[] = $tag;
				}
			}

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
		
		$tags = array();
		foreach(Model_Tag::find('all', array('where' => array('user_id' => $this->_user_id))) as $tag) {
			$tags[] = $tag->tag;
		}
		$this->template->set_global('tags', array_unique($tags), false);

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