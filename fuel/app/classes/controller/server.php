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
        \Zombmin\Page::setTitel(\Zombmin\Server::get('gameName'));
        foreach($stats as $stat) {
            $data[$stat] = \Zombmin\Server::get($stat);
        }
        
        $this->template = View::forge('server/stats', $data);
	}
    public function action_kick()
    {
        $player = urldecode($_REQUEST['player']);
        $reason = $_REQUEST['reason_kick'];

        \Zombmin\Server::kick($player, $reason);

        Response::redirect();
    }
    public function action_ban()
    {
        $player = urldecode($_REQUEST['player']);
        $reason = $_REQUEST['reason_ban'];
        $time = $_REQUEST['time'];

        \Zombmin\Server::ban($player, $time, $reason);

        Response::redirect();
    }
    public function action_say()
    {
        $string = $_REQUEST['string'];

        \Zombmin\Server::say($string);

        Response::redirect();
    }
    public function action_spawnEntity()
    {
        $player = $_REQUEST['player'];
        $entity = $_REQUEST['entity'];

        \Zombmin\Server::spawnEntity($player, $entity);
        Response::redirect();

    }
    public function after($response)
    {
        if(is_null($response)) {
            $response = $this->template;
        }
        return parent::after($response);
    }

}
