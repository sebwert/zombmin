<?php

class Controller_Server extends Controller
{
    protected $server = null;
    public function before()
    {
        $this->server = new \Zombmin\Server();

    }

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
    public function action_kick()
    {
        $player = urldecode($_REQUEST['player']);
        $reason = $_REQUEST['reason_kick'];

        $this->server->kick($player, $reason);

        $this->redirect();
    }
    public function action_ban()
    {
        $player = urldecode($_REQUEST['player']);
        $reason = $_REQUEST['reason_ban'];
        $time = $_REQUEST['time'];

        $this->server->ban($player, $time, $reason);

        $this->redirect();
    }
    public function action_say()
    {
        $string = $_REQUEST['string'];

        $this->server->say($string);

        $this->redirect();

    }
    public function action_spawnEntity()
    {
        $player = $_REQUEST['player'];
        $entity = $_REQUEST['entity'];

        $this->server->spawnEntity($player, $entity);
        $this->redirect();

    }
    public function after($response)
    {
        if(is_null($response)) {
            $response = $this->template;
        }
        return parent::after($response);
    }

}
