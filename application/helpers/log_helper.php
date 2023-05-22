<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function isLogged()
    {
        if(!isset($_SESSION['id_entreprise'])){
           redirect('login');
        }
    } 
    
function getCat($cat){
    if($cat == "CL"){
        return "CLIENT";
    }else{
        return "FOURNISSEUR";
    }
}