<?php

namespace PTK\Console\Form\Field;

/**
 * Campo de texto
 *
 * @author Everton
 */
class TextField extends FieldAbstract {

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
        $this->climate->out("{$this->label}:");
        $input = $this->climate->input('>');
        $this->answer = $input->prompt();
        
        if($this->answer === ''){
            if($this->default !== null) $this->answer = $this->default;
        }
        
        if($this->required){
            if($this->answer === ''){
                $this->climate->error('Required!');
                $this->ask();
            }
        }
        
        if($this->validator !== null){
            $validator = $this->validator;
            if($validator($this->answer) === false){
                $this->climate->error($this->validatorMessage);
                $this->ask();
            }
        }
    }

}
