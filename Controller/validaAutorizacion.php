<?php

class autorize {
    public function validate() {
        if(isset($_SESSION['sesion_exitosa'])){
            return true;
        } else {
            return false;
        }
    }
}
