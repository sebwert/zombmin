<?php

class Controller_Config extends Controller
{
    private $view = null;

    public function before()
    {
        \Zombmin\Navigation::setActive('Settings');
        parent::before();
    }
    public function action_database()
    {
        \Zombmin\Page::setTitel('Settings<small> - Database</small>');

        $data = array(
            'database_host' => Config::get('user.db.host'),
            'database_name' => Config::get('user.db.name'),
            'database_user' => Config::get('user.db.user'),
            'database_pw' => Config::get('user.db.pw'),
        );
        $this->view = View::forge('config/database', $data);
    }

    public function action_index()
    {
        Config::loadUserConfig(true);
        $this->view = View::forge('config/index');
		$this->view->set('content',
                        Request::forge('config/telnet', false)
                                                        ->execute()
                        . "\n" .  Request::forge('config/database', false)
                                                        ->execute(), false);

        \Zombmin\Page::setTitel('Settings');
    }

    public function action_save()
    {
        Config::loadUserConfig();
        //Database stuff
        !is_null(Input::post('db_host')) and Config::set('user.db.host',
                                                Input::post('db_host'));
        !is_null(Input::post('db_name')) and Config::set('user.db.name',
                                                Input::post('db_name'));
        !is_null(Input::post('db_user')) and Config::set('user.db.user',
                                                Input::post('db_user'));
        !is_null(Input::post('db_pw')) and Config::set('user.db.pw',
                                                Input::post('db_pw'));
        //Telnet stuff
        !is_null(Input::post('telnet_ip'))
                    and Config::set('user.telnet.ip',
                                Input::post('telnet_ip'));
        !is_null(Input::post('telnet_port'))
                    and Config::set('user.telnet.port',
                                Input::post('telnet_port'));
        !is_null(Input::post('telnet_password'))
                    and Config::set('user.telnet.password',
                                Input::post('telnet_password'));
        Config::saveUserConfig();

        \Zombmin\Messages::add('Saved successfull!'); 
        sleep(3);
        Response::redirect('config');
    }

    public function action_telnet()
    {
        \Zombmin\Page::setTitel('Settings<small> - Telnet</small>');

        Config::loadUserConfig();
        $data = array(
            'telnet_ip' => Config::get('user.telnet.ip'),
            'telnet_port' => Config::get('user.telnet.port'),
            'telnet_password' => Config::get('user.telnet.password'),
        );
        $this->view = View::forge('config/telnet', $data);
    }
    public function after($response)
    {
        if($response === null
                && !Request::is_hmvc()) {
            $response = View::forge('template');
            $form_template = View::forge('config/layout_form');

            $form_template->content = $this->view;
            $response->content = $form_template;
        } else {
            $response = $this->view;
        }

        return parent::after($response);
    }

}
