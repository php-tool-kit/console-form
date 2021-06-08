<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Interface para campos com validação
 */
interface ValidateInterface {
    /**
     * Define um validador para os dados do campo.
     * 
     * @param callable $validator Um validador do tipo callable. Deve receber 
     * como parâmetro o valor do campo e retornar true/false.
     * 
     * @param string $message Uma mensagem a ser exibida caso a validação falhe.
     * @return FieldInterface
     */
    public function setValidator(callable $validator, string $message): FieldInterface;
}
