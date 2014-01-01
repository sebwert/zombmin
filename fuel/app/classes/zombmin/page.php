<?php
namespace Zombmin;

class Page {

    private static $title = '';
    private static $headElements = array();
    private static $bottomScripts = array();

    private static $controller = null;

    public static function initialize() {

        // set initial width for mobile devices
        self::addHeadElement('meta',
                array('name' => 'viewport',
                    'content' => 'width=device-width, initial-scale=1.0'));

        self::addHeadElement('link', array(
            'href' => \Config::getBootstrapPath()
                        . '/css/bootstrap.min.css',
            'rel' => 'stylesheet'
        ));

        self::addHeadElement('script', array(
            'src' => \Config::getJsPath() . '/jQuery.js',
            'type' => 'text/javascript'
        ));

        self::startIfComment('lt IE 9');
        self::addHeadElement('script', array(
            'src' => 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
            'type' => 'text/javascript'
        ));
        self::addHeadElement('script', array(
            'src' => 'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js',
            'type' => 'text/javascript'
        ));
        self::endIfComment();

        self::addHeadElement('link', array(
            'href' => \Config::getBootstrapPath()
                        . '/css/bootstrap.min.css',
            'rel' => 'stylesheet'
        ));

        self::addHeadElement('link', array(
            'href' => \Config::getCSSPath()
                        . '/style.css',
            'rel' => 'stylesheet'
        ));

         self::addBottomScript(array(
            'src' => \Config::getBootstrapPath() . '/js/bootstrap.min.js',
        ));

        
    }
    public static function setTitel($title)
    {
        self::$title = $title;
    }
    public static function getTitle()
    {
        return self::$title;
    }
    /**
     * Add an extra HTML element to the HTML HEAD section. This can be
     * used to include RSS/ATOM feed links, META tags or other stuff.
     * If $content is NULL, no closing tag is generated. If the element
     * needs a closing tag (like SCRIPT) but should not have contents,
     * pass the empty string as the third parameter.
     *
     * @param string $name       element name (e.g. 'meta')
     * @param array  $attributes additional attributes for the element
     * @param string $content    element contents, if any
     */
    public static function addHeadElement($name, $attributes = array(), $content = NULL)
    {
        self::$headElements[] = compact('name', 'attributes', 'content');
    }

    /**
     * Add an extra HTML element to the HTML BODY BOTTOM section. 
     *
     * @param string $name       element name (e.g. 'meta')
     * @param array  $attributes additional attributes for the element
     * @param string $content    element contents, if any
     */
    public static function addBottomScript($attributes = array(), $content = NULL)
    {
        self::$bottomScripts[] = compact('attributes', 'content');
    }

    /**
     * Remove HTML elements from the HTML HEAD section. This method will
     * remove all elements matching the given name and all the attributes.
     *
     * For example, to remove all META elements:
     * PageLayout::removeHeadElement('meta');
     *
     * Remove all style sheet LINK elements:
     * PageLayout::removeHeadElement('link', array('rel' => 'stylesheet'));
     *
     * Remove a particular style sheet LINK by href:
     * PageLayout::removeHeadElement('link', array('href' => '...'));
     */
    public static function removeHeadElement($name, $attributes = array())
    {
        $result = array();

        foreach (self::$headElements as $element) {
            $remove = false;

            // match element name
            if ($name === $element['name']) {
                $remove = true;

                // match element attributes
                foreach ($attributes as $key => $value) {
                    if (!isset($element['attributes'][$key]) ||
                        $element['attributes'][$key] !== $value) {
                        $remove = false;
                        break;
                    }
                }
            }

            if (!$remove) {
                $result[] = $element;
            }
        }

        self::$headElements = $result;
    }
    /**
     * Add a JavaScript SCRIPT element to the HTML HEAD section.
     *
     * @param string $source     URL of JS file or file in assets folder
     */
    public static function addScript($source)
    {
        $script_attributes = array(
            'src'   => Assets::javascript_path($source));

        self::addHeadElement('script', $script_attributes, '');
    }

    /**
     * Remove a JavaScript SCRIPT element from the HTML HEAD section.
     *
     * @param string $source     URL of JS file or file in assets folder
     */
    public static function removeScript($source)
    {
        $script_attributes = array(
            'src'   => Assets::javascript_path($source));

        self::removeHeadElement('script', $script_attributes);
    }

    /**
     * Add a STYLE element to the HTML HEAD section.
     *
     * @param string $content   element contents
     * @param string $media     media types
     */
    public static function addStyle($content, $media = '')
    {
        $attr = array();
        if($media) {
            $attr = array('media' => $media);
        }
        self::addHeadElement('style', $attr, $content);
    }

    /**
     * Add a style sheet LINK element to the HTML HEAD section.
     *
     * @param string $source     style sheet URL or file in assets folder
     * @param array  $attributes additional attributes for LINK element
     */
    public static function addStylesheet($source, $attributes = array())
    {
        $style_attributes = array(
            'rel'   => 'stylesheet',
            'href'  => Assets::stylesheet_path($source));

        self::addHeadElement('link', array_merge($style_attributes, $attributes));
    }

    /**
     * Remove a style sheet LINK element from the HTML HEAD section.
     *
     * @param string $source     style sheet URL or file in assets folder
     * @param array  $attributes additional attributes for LINK element
     */
    public static function removeStylesheet($source, $attributes = array())
    {
        $style_attributes = array(
            'rel'   => 'stylesheet',
            'href'  => Assets::stylesheet_path($source));

        self::removeHeadElement('link', array_merge($style_attributes, $attributes));
    }

    /**
     * Return all HTML HEAD elements as a string.
     *
     * @return string   HTML fragment
     */
    public static function getHeadElements()
    {
        $result = '';
        foreach (self::$headElements as $element) {
            $result .= '<' . $element['name'];

            foreach ($element['attributes'] as $key => $value) {
                $result .= sprintf(' %s="%s"', $key, self::htmlReady($value));
            }

            $result .= ">\n";

            if (isset($element['content'])) {
                $result .= $element['content'];
                $result .= '</' . $element['name'] . ">\n";
            } elseif($element['name'] == 'script') {
                $result .= '</' . $element['name'] . ">\n";
            }
        }

        return $result;
    }

    /**
     * Return all BOTTOM SCRIPT elements as a string.
     *
     * @return string   HTML fragment
     */
    public static function getBottomScripts()
    {
        $result = '';
        foreach (self::$bottomScripts as $element) {
            $result .= '<script' ;

            foreach ($element['attributes'] as $key => $value) {
                $result .= sprintf(' %s="%s"', $key, self::htmlReady($value));
            }

            $result .= ">\n";
            if (isset($element['content'])) {
                $result .= $element['content'];
            }
            $result .= '</script>' . "\n";
        }

        return $result;
    }

    public static function startIfComment($content)
    {
        self::addHeadElement(sprintf('!--[if %s]', $content));
    }

    public static function endIfComment()
    {
        self::addHeadElement(sprintf('![endif]--'));
    }

    public static function htmlReady ($what, $trim = TRUE, $br = FALSE, $double_encode = false) {
        if ($trim) {
            $what = trim(htmlspecialchars($what, ENT_QUOTES, 'cp1252', $double_encode));
        } else {
            $what = htmlspecialchars($what,ENT_QUOTES, 'cp1252', $double_encode);
        }

        if ($br) { // fix newlines
            $what = nl2br($what, false);
        }

        return $what;
    }
    public static function getTitleStrippedTags()
    {
        return preg_replace('/<[^>]*>/', '', static::getTitle());
    }

    public static function setController($controller)
    {
        self::$controller = $controller;
    }
    public static function getController()
    {
        return self::$controller;
    }

}
