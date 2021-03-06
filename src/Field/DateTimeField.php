<?php

namespace PTK\Console\Form\Field;

use DateTime;
use InvalidArgumentException;

/**
 * Campo de data/hora
 *
 * @author Everton
 */
class DateTimeField extends FieldAbstract implements DefaultInterface, RequiredInterface, ValidateInterface {
    use DefaultTrait, RequiredTrait, ValidadeTrait;

    protected string $inputFormat;
    protected string $labelInputFormat = '';
    protected bool $showFormatInLabel = true;
    protected DateTime $object;

    /**
     * 
     * @param string|int $id
     * @param string $label
     * @param string $inputFormat Formato suportado por date().
     */
    public function __construct(string|int $id, string $label, string $inputFormat) {
        parent::__construct($id, $label);
        $this->inputFormat = $inputFormat;
    }
    
    public function setLabelInputFormat(string $label): DateTimeField {
        $this->labelInputFormat = $label;
        return $this;
    }

    public function setDefault(mixed $default): DateTimeField {
        if ($default instanceof DateTime) {
            $this->default = $default;
            return $this;
        }
        throw new InvalidArgumentException(get_class($default));
    }

    public function ask(): void {
        $label = $this->label;

        if ($this->requiredIndicator !== null && $this->required) {
            $label .= " {$this->requiredIndicator}";
        }

        if ($this->showFormatInLabel) {
            if($this->labelInputFormat === ''){
                $label .= " [{$this->inputFormat}]";
            }else{
                $label .= " [{$this->labelInputFormat}]";
            }
        }

        if ($this->default !== null && $this->showDefaultInLabel) {
            $default = date($this->outputFormat, $this->default->getTimestamp());
            $label .= " [Default: $default]";
        }

        $this->climate->out("$label:");
        $input = $this->climate->input('>');
        $this->answer = (string) $input->prompt();

        if ($this->answer === '') {
            if ($this->default !== null)
                $this->answer = $this->default;
        }
        $this->parseInput();

        if ($this->required) {
            if ($this->answer === '') {
                $this->climate->error('Required!');
                $this->ask();
            }
        }

        while ($this->validate() === false) {
            $this->climate->error($this->validatorMessage);
            $this->ask();
        }
    }

    /**
     * 
     * @return void
     */
    protected function parseInput(): void {
        $this->object = DateTime::createFromFormat($this->inputFormat, $this->answer);
    }

    /**
     * 
     * @param bool $show
     * @return NumberField
     */
    public function showFormatInLabel(bool $show): DateTimeField {
        $this->showFormatInLabel = $show;
        return $this;
    }

    /**
     * 
     * @return DateTime
     */
    public function object(): DateTime {
        return $this->object;
    }
    
    /**
     * 
     * @return DateTime
     */
    public function answer(): DateTime {
        return $this->object();
    }

}
