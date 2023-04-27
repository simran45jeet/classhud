<?php
Class StaticFunctions
{
    public static function getSegment($i){
        $ci = &get_instance();
        return $ci->uri->segment($i);
    }
}