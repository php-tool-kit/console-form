<?php

require 'vendor/autoload.php';

$form = new \PTK\Console\Form\Form();

$nome = new PTK\Console\Form\Field\TextField('nome', 'Nome');
$nome->required(true);
$nome->setValidator(function($answer){
    return (strlen($answer) >= 5)? true : false;
}, 'Nome deve ter 5 caracteres no mínimo.');

$sobrenome = new PTK\Console\Form\Field\TextField('sobrenome', 'Sobrenome');

$idade = new PTK\Console\Form\Field\TextField('idade', 'Idade');

$form->setField($nome)
        ->setField($sobrenome)
        ->setField($idade);


$form->setTitle('Hello world Console\Form')
        ->setDetail('Testes de uso durante o desenvolvimento.');
$form->ask();

print_r($form->answers());