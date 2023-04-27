<?php
/**
 * CodeIgnighter layout support library
 *  with Twig like inheritance blocks
 *
 * v 1.0
 *
 *
 * @author Constantin Bosneaga
 * @email  constantin@bosneaga.com
 * @url    http://a32.me/
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout {
    private $obj;
    private $layout_view;
    private $title = '';
    private $meta = '';
    private $description = '';
    private $css_list = array(), $js_list = array();
    private $block_list, $block_new, $block_replace = false;

    function __construct(){   
        $this->obj =& get_instance()->controller;
        $this->layout_view = "layout/default.php";
        // Grab layout from called controller
        if (isset($this->obj->layout_view)) $this->layout_view = $this->obj->layout_view;
    }
    
    function view($view, $data = null, $return = false) {
        // Render template
        $data['content_for_layout'] = $this->obj->load->view($view, $data, true);
        $data['title_for_layout'] = !empty($this->title) ? $this->title : '';
        $data['meta_for_layout'] = !empty($this->meta) ? $this->meta  : '';
        $data['meta_keywords'] = !empty($this->meta_keywords) ? $this->meta_keywords : '';
        $data['meta_description'] = !empty($this->meta_description) ? $this->meta_description : '';
        $data['meta_image'] = !empty($this->meta_image) ? $this->meta_image :'';

        $data['description_for_layout'] = !empty($this->description) ? $this->description :'';

        // Render resources
        $data['js_for_layout'] = '';
        foreach ($this->js_list as $v)
            $data['js_for_layout'] .= sprintf('<script type="text/javascript" src="%s"></script>', $v);

        $data['css_for_layout'] = '';
        foreach ($this->css_list as $v)
            $data['css_for_layout'] .= sprintf('<link rel="stylesheet" type="text/css"  href="%s" />', $v);

        // Render template
        $this->block_replace = true;
        $output = $this->obj->load->view($this->layout_view, $data, $return);

        return $output;
    }

    /**
     * Set page title
     *
     * @param $title
     */
    function title($title) {
        $this->title = $title;
    }
    function meta($meta) {
        $this->meta = $meta;
    }
    function meta_keywords($meta) {
        $this->meta_keywords = $meta;
    }
    function meta_description($meta) {
        $this->meta_description = $meta;
    }
    function meta_image($meta) {
        $this->meta_image = $meta;
    }
    function description($description) {
        $this->description = $description;
    }

    /**
     * Adds Javascript resource to current page
     * @param $item
     */
    function js($item) {
        $this->js_list[] = $item;
    }

    /**
     * Adds CSS resource to current page
     * @param $item
     */
    function css($item) {
        $this->css_list[] = $item;
    }

    /**
     * Twig like template inheritance
     *
     * @param string $name
     */
    function block($name = '') {
        if ($name != '') {
            $this->block_new = $name;
            ob_start();
        } else {
            if ($this->block_replace) {
                // If block was overriden in template, replace it in layout
                if (!empty($this->block_list[$this->block_new])) {
                    ob_end_clean();
                    echo $this->block_list[$this->block_new];
                }
            } else {
                $this->block_list[$this->block_new] = ob_get_clean();
            }
        }
    }

}