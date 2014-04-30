<?php

namespace Zombmin;

class Server_Alpha78
{
    private $telnet = null;

    private $serverVersion = '';
    private $serverIP = '';
    private $serverPort = '';
    private $maxPlayer = '';
    private $gameMode = '';
    private $world = '';
    private $gameName = '';
    private $difficulty = '';

    private $entities = array(
        1 => 'zombie04',
        2 => 'zombie05',
        3 => 'zombie06',
        4 => 'zombie07',
        5 => 'zombiecrawler',
        6 => 'snowzombie01',
        7 => 'snowzombie02',
        8 => 'spiderzombie',
        9 => 'burntzombie',
        10 => 'zombiegal01',
        11 => 'zombiegal02',
        12 => 'zombiegal03',
        13 => 'zombiegal04',
        14 => 'zombie02',
        15 => 'fatzombiecop',
        16 => 'fatzombie',
        17 => 'hornet',
        18 => 'zombiedog',
        19 => 'car_Blue',
        20 => 'car_Orange',
        21 => 'car_Red',
        22 => 'car_White',
        23 => 'animalStag',
        24 => 'animalRabbit',
        25 => 'animalPig',
        26 => 'sc_MeleeWeapons',
        27 => 'sc_Food',
        28 => 'sc_BuildingSupplies',
        29 => 'sc_RangedWeapons',
        30 => 'sc_RangedWeaponsDay5',
        31 => 'sc_RangedWeaponsDay7',
        32 => 'sc_Explosives',
        33 => 'sc_General'
    );

    function __construct()
    {
        $ip = \Config::getTelnetIP();
        $port = \Config::getTelnetPort();

        $this->telnet = new \Zombmin\Telnet($ip, $port, 20, 'Please enter password:');
        $this->telnet->setPrompt('');
        $test = $this->telnet->exec('test123');
        $this->parseStats($this->telnet->getGlobalBuffer());
    }
    /**
     * parse stats transmitted on game start
     */
    private function parseStats($string)
    {
        $regexp = '/Server version: (.+).*'
                . 'Server IP: (.+).*'
                . 'Server port: (\d+).*'
                . 'Max players: (\d+).*'
                . 'Game mode: (.+).*'
                . 'World: (.+).*'
                . 'Game name: (.+).*'
                . 'Difficulty:.*(\d).*Press/s';
        $matches = array(9);

        preg_match($regexp, $string, $matches);

        $this->serverVersion = $matches[1];
        $this->serverIP = $matches[2];
        $this->serverPort = $matches[3];
        $this->maxPlayer = $matches[4];
        $this->gameMode = $matches[5];
        $this->world = $matches[6];
        $this->gameName = $matches[7];
        $this->difficulty = $matches[8];

    }
    public function get($variable)
    {
        return $this->$variable;
    }

    /**
     * returns all available information for connected players
     *
     * Player position top left is:     (-775.5 | 76.0 | 1089.5)
     * Player position top right is:    (1066.9 | 60.9 | 1101.5)
     * Player Position bottom right is: (987.5 | 61.0 | -878.5)
     * Player position bottom left is:  (-971.5 | 60.8 | -1080.5)
     * Player position middle right is: (1152.5 | -81.5 | 60.8)
     * Player position middle left is:  (-1073.5 | 344.5 | 60.8)
     *
     * @return array
     */
    public function getConnectedPlayer()
    {
        $this->telnet->setPrompt('');
        $player_table = $this->telnet->exec('lp');
        $this->telnet->clearBuffer();
        $matches = array();

        $regexp = '/(\d+)\. id=(\d{1,8}), ([^,]*), '
                . 'pos=\(([^,]*), ([^,]*), ([^,]*)\).*health=(-?\d{1,3})/i';

        preg_match_all($regexp, $player_table, $matches);

        $return = array();
        foreach ($matches as $key => $match) {
            if($key === 0) continue;
            switch($key) {
                case 1: $lable = 'number'; break;
                case 2: $lable = 'id'; break;
                case 3: $lable = 'name'; break;
                case 4: $lable = 'position_x'; break;
                case 5: $lable = 'position_z'; break;
                case 6: $lable = 'position_y'; break;
                case 7: $lable = 'health'; break;

            }
            $i = 0;
            foreach ($match as $single_entry) {
                $return[$i][$lable] = $single_entry;
                $i++;
            }
        }
        return $return;
    }
    public function kick($players, $reason)
    {
        if(!is_array($players)) {
            $players = array($players);
        }
        $this->telnet->setPrompt('');
        
        $connected_player = $this->getConnectedPlayer();

        $say_template = 'Player "%s" kicked for reason: %s';

        foreach($players as $single_player) {
            $current_player_name = 'NONAME';
            foreach($connected_player as $one_player_entrie) {
                if($one_player_entrie['id'] == $single_player) {
                    $current_player_name = $one_player_entrie['name'];
                    break;
                }
            }
            $this->say(sprintf($say_template, $current_player_name, $reason));
            $this->telnet->exec('kick ' . $single_player . ' ' . $reason);
        }
        $this->telnet->clearBuffer();
    }
    public function spawnEntity($player_id, $entity_id)
    {
        $player_id = (int)$player_id;
        $entity_id = (int)$entity_id;
        $this->telnet->setPrompt('');
        if($this->isConnectedID($player_id)) {
            $this->telnet->exec('se ' . $player_id . ' ' . $entity_id);
        }
    }
    public function isConnectedID($player_id)
    {
        foreach($this->getConnectedPlayer() as $player) {
            if($player['id'] == $player_id) {
                return true;
            }
        }
        return false;
    }
    public function ban($players, $time, $reason)
    {
        if(!is_array($players)) {
            $players = array($players);
        }
        $this->telnet->setPrompt('');

        
        $connected_player = $this->getConnectedPlayer();

        $say_template = 'Player "%s" banned for %s for reason: %s';

        foreach($players as $single_player) {
            $current_player_name = 'NONAME';
            foreach($connected_player as $one_player_entrie) {
                if($one_player_entrie['id'] == $single_player) {
                    $current_player_name = $one_player_entrie['name'];
                    break;
                }
            }
            $this->say(sprintf($say_template, $current_player_name, $time, $reason));
            $this->telnet->exec('ban ' . $single_player . ' '
                                       . $time);
        }
        $this->telnet->clearBuffer();
    }
    public function kickAll($reason)
    {
        $players = $this->getConnectedPlayer();
        $this->kick($players, $reason);
    }
    public function say($string)
    {
        $this->telnet->setPrompt('');
        $this->telnet->exec('say ' . $string);
    }
    public function getPossibleEntities()
    {
        return $this->entities;
    }



}
