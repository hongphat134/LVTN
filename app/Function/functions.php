<?php 
	function perfect_trim($value){
        return preg_replace('/ +/', ' ', ucwords(mb_strtolower(trim($value),'UTF-8')));
    }
?>