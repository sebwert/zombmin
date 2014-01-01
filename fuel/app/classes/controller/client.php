<?php

class Controller_Client extends Controller
{

	public function action_list()
	{
		$this->template = View::forge('client/list');
        $this->template->ban_time_options = array(
            '<option>10 minutes</option>',
            '<option>30 minutes</option>',
            '<option>1 hours</option>',
            '<option>2 hours</option>',
            '<option>3 hours</option>',
            '<option>6 hours</option>',
            '<option>12 hours</option>',
            '<option selected>1 day</option>',
            '<option>2 day</option>',
            '<option>3 day</option>',
            '<option>10 day</option>',
            '<option>20 day</option>',
            '<option>1 month</option>',
            '<option>2 month</option>',
            '<option>3 month</option>',
            '<option>6 month</option>',
            '<option>1 year</option>',
            '<option value="1000 years">forever</option>'
        );


        $server = new \Zombmin\Server();

        $this->template->all_player = $server->getConnectedPlayer();

        $entity_options = array();
        foreach ($server->getPossibleEntities() as $id => $name) {
            $entity_options[] = '<option value="' . $id . '">'
                              . $name . '</option>';

        }
        $this->template->set('entity_options', $entity_options, false);
	}

    public function after($response)
    {
        if(is_null($response)) {
            $response = $this->template;
        }
        return parent::after($response);
    }

}
