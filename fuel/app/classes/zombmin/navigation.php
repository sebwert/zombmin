<?php
namespace Zombmin;

class Navigation {
    
    private static $elements = array();
    private static $active = 'Server';

    public static  function setActive($name) {
        self::$active = $name;
    }

    public static function addNavigationLink($name, $link)
    {
        self::$elements[$name] = $link;
    }
    public static function getNavigation() {
        $ret[] = '<div class="collapse navbar-collapse"'
                . ' id="bs-example-navbar-collapse-1">';
        $ret[] = '<ul class="nav navbar-nav">';
        foreach(self::$elements as $element_name => $element_link) {
            $active = $element_name !== self::$active ? ''
                    : ' class="active"';
            $ret[] = '<li' . $active . '><a href='
                        . $element_link . '>'
                        . $element_name . '</a></li>';
        }
        $ret[] = '</ul>';
        $ret[] = '</div>';

        return implode("\n", $ret);

    }
}
