<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Interface para campos que são requeridos
 */
interface RequiredInterface {
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
     * Define o indicador de de campo requerido
     * @param string|null $indicator Um ou mais caracteres. Null se não for exibido. O padrão é *
     * @return FieldInterface
     */
    public function setRequiredIndicator(?string $indicator): FieldInterface;
}
