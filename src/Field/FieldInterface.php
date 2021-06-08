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
    
}
