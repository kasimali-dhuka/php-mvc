<?php

namespace core;

class View {

    public static function renderTemplate($template, $args=[]) {
        static $twig = null;

        if($twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }

        echo $twig->render($template, $args);
    }
}