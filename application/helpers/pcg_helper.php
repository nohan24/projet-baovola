<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('checkPcg'))
{
    function checkPcg($tab1,$tab2)
    {
        $ret = array();
        foreach ($t as $tab1) {
            foreach ($s as $tab2) {
                if($t['compte'] == $s[0]){
                    array_push($ret,$s[0]);
                }
            }
        }
        return $ret;
    }   
}