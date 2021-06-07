<?php

namespace PTK\Console\Form\Field;

/**
 * Campo de texto multilinhas
 *
 * @author Everton
 */
class MemoField extends FieldAbstract {

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
        if ($this->requiredIndicator !== null && $this->required) {
            $label .= " {$this->requiredIndicator}";
        }

        if ($this->default !== null && $this->showDefaultInLabel) {
            $label .= " [{$this->default}]";
        }

        $this->climate->out("$label:");
        if (\PTK\Console\Form\Helper\System::getOS() == \PTK\Console\Form\Helper\System::WINDOWS) {
            $this->climate->out("CTRL+Z to end!");
        } elseif (\PTK\Console\Form\Helper\System::getOS() == \PTK\Console\Form\Helper\System::LINUX) {
            $this->climate->out("CTRL+D to end!");
        }
        $input = $this->climate->input('>');
        $input->multiLine();
        $this->answer = $input->prompt();

        if ($this->answer === '') {
            if ($this->default !== null)
                $this->answer = $this->default;
        }

        if ($this->required) {
            if ($this->answer === '') {
                $this->climate->error('Required!');
                $this->ask();
            }
        }

        if ($this->validator !== null) {
            $validator = $this->validator;
            if ($validator($this->answer) === false) {
                $this->climate->error($this->validatorMessage);
                $this->ask();
            }
        }
    }

}
