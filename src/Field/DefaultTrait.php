<?php

namespace PTK\Console\Form\Field;

/**
 *
 * Acrescenta funcionalidade de valores padrão nos campos adequados
 */
trait DefaultTrait {
    /**
     * 
     * @var mixed Valor padrão.
     */
    protected mixed $default = null;
    
    /**
     * 
     * @var bool O valor default é exibido?
     */
    protected bool $showDefaultInLabel = true;
    
    /**
     * 
     * @param mixed $default
     * @return FieldInterface
     * @inheritDoc
     */
    public function setDefault(mixed $default): FieldInterface {
        $this->default = $default;
        return $this;
    }
    
    /**
     * 
     * @param bool $show
     * @return FieldInterface
     * @inheritDoc
     */
    public function showDefaultInLabel(bool $show): FieldInterface {
        $this->showDefaultInLabel = $show;
        return $this;
    }
}
