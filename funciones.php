<?php
    function login($email, $password, $usuarios = []) {
        $logged = false;
        foreach ($usuarios as $usuario) {
            if ($email == $usuario['email'] && $password == $usuario['password']) {
                $logged = true;
                break;
            }
        }
        return $logged; 
    }
    
    function register($nombre, $email, $password, $password2, $usuarios = []) {
        foreach ($usuarios as $usuario) {
            if ($usuario["nombre"] === $nombre && $usuario["email"] === $email && $usuario["password"] === $password && $usuario["password2"] === $password2) {
                return true; 
            }
        }
        return false; 
    }


    function emailCorrecto($email, $usuarios = []) {
        foreach ($usuarios as $usuario) {
            if ($email == $usuario['email']) {
                return true;
            }
        }
        return false;
    }
    
?>