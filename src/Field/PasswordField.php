<?php

namespace PTK\Console\Form\Field;

use PTK\Console\Form\Exception\FeatureNotSupportedException;
use PTK\Console\Form\Field\FieldAbstract;
use PTK\Console\Form\Field\FieldInterface;

/**
 * Campo de senha
 *
 */
class PasswordField extends FieldAbstract implements RequiredInterface, ValidateInterface {
    use RequiredTrait, ValidadeTrait;
    
    /**
     * 
     * @param string|int $id
     * @param string $label
     * @inheritDoc
     */
    public function __construct(string|int $id, string $label) {
        parent::__construct($id, $label);
    }
    
    /**
     * 
     * @return void
     * @inheritDoc
     */
    public function ask(): void {
        $label = $this->label;
        if($this->requiredIndicator !== null && $this->required){
            $label .= " {$this->requiredIndicator}";
        }
        
        $this->climate->out("$label:");
        $input = $this->climate->password('>');
        $this->answer = $input->prompt();
        
        
        if($this->required){
            if($this->answer === ''){
                $this->climate->error('Required!');
                $this->ask();
            }
        }
        
        while ($this->validate() === false) {
            $this->climate->error($this->validatorMessage);
            $this->ask();
        }
    }
    
}
