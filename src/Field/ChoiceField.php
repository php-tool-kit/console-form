<?php

namespace PTK\Console\Form\Field;

/**
 * Campo para escolha de um valor único a partir de uma lista.
 *
 * @author Everton
 */
class ChoiceField extends FieldAbstract implements DefaultInterface {
    use DefaultTrait;
    
    protected array $options;
    
    protected string $listTitle = '';
    
    public function __construct(string|int $id, string $label, array $options) {
        parent::__construct($id, $label);
        $this->options = $options;
    }
    
    public function isRequired(): bool {
        throw new FeatureNotSupportedException('Always required.');
    }

    public function required(bool $required): FieldInterface {
        throw new FeatureNotSupportedException('Always required.');
    }

    public function setRequiredIndicator(?string $indicator): FieldInterface {
        throw new FeatureNotSupportedException('Always required.');
    }

    public function setListTitle(string $title): ChoiceField {
        $this->listTitle = $title;
        return $this;
    }
    
    /**
     * 
     * @return void
     * @inheritDoc
     */
    public function ask(): void {
        
        $label = $this->label;
        
        if($this->default !== null && $this->showDefaultInLabel){
            $label .= " [{$this->default}]";
        }
        
        if($this->listTitle !== ''){
            $this->climate->out($this->listTitle);
        }
        
        $this->printList();
        
        $this->climate->br();
        $this->climate->out("$label:");
        
        do{
            $input = $this->climate->input('>');
            $this->answer = $input->prompt();

            if ($this->answer === '') {
                if ($this->default !== null)
                    $this->answer = $this->default;
            }
        }while (key_exists($this->answer, array_keys($this->options)) === false);
    }

    protected function determineMaxSizeOfKeys(): int {
        $maxSize = 0;
        foreach (array_keys($this->options) as $key){
            $currentSize = strlen($key);
            if($currentSize > $maxSize) $maxSize = $currentSize;
        }
        
        return $maxSize;
    }
    
    protected function printList(): void {
        foreach ($this->options as $key => $item){
            $label = '[ '. str_pad($key, $this->determineMaxSizeOfKeys(), ' ', STR_PAD_BOTH).' ] ';
            $this->climate->inline($label)->out($item);
        }
    }
    
    public function getChoice(): mixed {
        return [
            $this->answer => $this->options[$this->answer]
        ];
    }
    
    public function answer() {
        return $this->getChoice();
    }
}
