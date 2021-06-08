<?php

require 'vendor/autoload.php';

$form = new \PTK\Console\Form\Form();

$nome = new PTK\Console\Form\Field\TextField('nome', 'Nome');
$nome->required(true);
$nome->setDefault('Everton');
$nome->setValidator(function($answer){
    return (strlen($answer) >= 5)? true : false;
}, 'Nome deve ter 5 caracteres no mínimo.');

$senha = new PTK\Console\Form\Field\PasswordField('senha', 'Senha');

$idade = new PTK\Console\Form\Field\TextField('idade', 'Idade');

$form->setField($nome)
        ->setField($senha)
        ->setField($idade);

$number = new \PTK\Console\Form\Field\NumberField('number', 'Número');
$number->setDecimals(2)
        ->setDecimalSeparator(',')
        ->setThousandsSeparator('.')
        ->setDefault(10)
        ->setMin(5)
        ->setMax(15)
        ->required(true);
$form->setField($number);

$memo = new PTK\Console\Form\Field\MemoField('memo', 'Memorando');
$form->setField($memo);

$date = new \PTK\Console\Form\Field\DateTimeField('data', 'Data', 'dmY');
$date->setOutputFormat('d/m/Y')
        ->setLabelInputFormat('ddmmaaaa');
$form->setField($date);

$yn = new \PTK\Console\Form\Field\YesNoField('yn', 'Confirma');
$yn->setDefault(true);
$form->setField($yn);

$choice = new \PTK\Console\Form\Field\ChoiceField('choice', 'Escolha uma opção', ['Option 1', 'Option 2', 'Option 3']);
$choice->setDefault(1);
$form->setField($choice);

$select = new \PTK\Console\Form\Field\SelectField('sel', 'Selecione', ['Option 1', 'Option 2', 'Option 3']);
$select->setDefault([1])
        ->setShowMode(\PTK\Console\Form\Field\SelectField::SHOW_MODE_REPEAT);
$form->setField($select);


$form->setTitle('Hello world Console\Form')
        ->setDetail('Testes de uso durante o desenvolvimento.');
$form->ask();

print_r($form->answers());
