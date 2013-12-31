<?php

class Controller_Index extends Controller_Template
{

	public function action_index()
	{
		$view = View::forge('index/index');
        $view->set('actions', Request::forge('server/actions')->execute(), false);
        $view->set('stats', Request::forge('server/stats')->execute(), false);
        $view->set('list', Request::forge('client/list')->execute(), false);

        $this->template->content = $view;
    }
}
