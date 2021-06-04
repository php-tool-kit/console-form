<?php

namespace PTK\Console\Form\Field;

/**
 * Interface para os campos de formulário.
 * 
 * @author Everton
 * @todo Implementar valor default para o campo
 */
interface FieldInterface {
    
    /**
     * 
     * @param string|int $id Id do formulário.
     * @param string $label Rótulo que será exibido.
     */
    public function __construct(string|int $id, string $label);

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
     * Configura se o campo é de preenchimento obrigatório ou não.
     * 
     * @param bool $required
     * @return FieldInterface
     */
    public function required(bool $required): FieldInterface;
    
    /**
     * Indica se o cmapo está configurado como obrigatório ou não.
     * 
     * @return bool
     */
    public function isRequired(): bool;
    
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
