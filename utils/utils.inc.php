<?php 
    function converteDataMysql($data) {
        return date('Y-m-d', $data);
    }

    function formatarData($data) {
        return date('d/m/Y', $data);
    }
?>