<?php

class PathUtils {

    public function init(){
    }

    public function fragment($rentId) {
        
        //return $rentId;
        return round($rentId/1000) . DIRECTORY_SEPARATOR . $rentId;
    }
}

