<?php

require 'vendor/autoload.php';

//$choice = new \PTK\Console\Form\Field\ChoiceField('choice', 'Escolha algo', [
//    1 => 'Opção 1',
//    2 => 'Opção 2',
//    3 => 'Opção 3',
//]);
//$choice->ask();
//echo $choice->getRawInput(), PHP_EOL;
//print_r($choice->answer());

//$date = new \PTK\Console\Form\Field\DateTimeField('date', 'Data', 'dmY');
//$date->setLabelInputFormat('ddmmmaaaa');
//$date->ask();
//echo $date->getRawInput(), PHP_EOL;
//print_r($date->answer());

//$memo = new PTK\Console\Form\Field\MemoField('memo', 'Texto multilinhas');
//$memo->ask();
//echo $memo->getRawInput(), PHP_EOL;
//print_r($memo->answer());

//$number = new PTK\Console\Form\Field\NumberField('number', 'Número');
//$number
//        ->setDecimals(2)
//        ->setDecimalSeparator(',')
//        ->setThousandsSeparator('.')
//        ;
//$number->ask();
//echo $number->getRawInput(), PHP_EOL;
//print_r($number->answer());

//$select = new PTK\Console\Form\Field\SelectField('select', 'Seleção múltipla', [
//    'a' => 'Opção a',
//    'b' => 'Opção b',
//    'c' => 'Opção c',
//]);
//$select->ask();
//print_r($select->getRawInput());
//print_r($select->answer());

$yn = new PTK\Console\Form\Field\YesNoField('yn', 'Sim/Não');
$yn->ask();
echo $yn->getRawInput(), PHP_EOL;
print($yn->answer());