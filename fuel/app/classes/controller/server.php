<?php

class Controller_Server extends Controller
{

	public function action_actions()
	{
		$this->template = View::forge('server/actions');
	}

	public function action_stats()
	{
        $stats = array(
            'serverVersion',
            'serverIP',
            'serverPort',
            'maxPlayer',
            'gameMode',
            'world',
            'gameName',
            'difficulty'
        );

        $data = array();

        $server = new \Zombmin\Server();
        \Zombmin\Page::setTitel($server->get('gameName'));
        foreach($stats as $stat) {
            $data[$stat] = $server->get($stat);
        }
        
        $this->template = View::forge('server/stats', $data);
	}
    public function after($response)
    {
        if(is_null($response)) {
            $response = $this->template;
        }
        return parent::after($response);
    }

}
