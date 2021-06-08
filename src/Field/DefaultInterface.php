<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Interface para campos que implementam valor default.
 */
interface DefaultInterface {
    /**
     * Valor padrão para o campo.
     * 
     * @param mixed $default
     * @return FieldInterface
     */
    public function setDefault($default): FieldInterface;
    
    /**
     * Indica se o valor default será exibido no rótulo do campo (quando ele existir).
     * 
     * @param bool $show
     * @return FieldInterface
     */
    public function showDefaultInLabel(bool $show): FieldInterface;
}
