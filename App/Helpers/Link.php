<?php
    function href($url){
        $url = trim($url, '/');
        $url = "/oophp_elibrary/".$url;
        return $url;
    }