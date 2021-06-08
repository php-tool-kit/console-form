<?php

namespace PTK\Console\Form\Field;

/**
 * Interface para os campos de formulário.
 * 
 * @author Everton
 */
interface FieldInterface {
    
    /**
     * Pergunta pelo valor do campo.
     * @return void
     */
    public function ask(): void;

    /**
     * Devolve o valor do campo.
     */
    public function answer();
    
    /**
     * Retorna o ID do campo.
     * 
     * @return string|int
     */
    public function id(): string|int;
    
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
