<?php

namespace PTK\Console\Form\Field;

/**
 * Campo de número
 *
 * @author Everton
 */
class NumberField extends FieldAbstract implements DefaultInterface, RequiredInterface {
    use DefaultTrait, RequiredTrait;

    protected int|float|null $min = null;
    protected int|float|null $max = null;
    protected bool $onlyInt = false;
    protected int|null $decimals = null;
    protected string|null $decimalSeparator = null;
    protected string|null $thousandsSeparator = null;
    protected bool $showFormatInLabel = true;
    protected bool $showMinMaxInLabel = true;

    /**
     * 
     * @param string|int $id
     * @param string $label
     * @inheritDoc
     */
    public function __construct(string|int $id, string $label) {
        parent::__construct($id, $label);
    }

    public function showFormatInLabel(bool $show): NumberField {
        $this->showFormatInLabel = $show;
        return $this;
    }
    
    public function showMinMaxInLabel(bool $show): NumberField {
        $this->showMinMaxInLabel = $show;
        return $this;
    }

    public function setMin(int|float $min): NumberField {
        $this->min = $min;
        return $this;
    }

    public function setMax(int|float $max): NumberField {
        $this->max = $max;
        return $this;
    }

    public function onlyInt(bool $onlyInt): NumberField {
        $this->onlyInt = $onlyInt;
        return $this;
    }

    public function setDecimals(int $decimals): NumberField {
        $this->decimals = $decimals;
        return $this;
    }

    public function setDecimalSeparator(string $separator): NumberField {
        $this->decimalSeparator = $separator;
        return $this;
    }

    public function setThousandsSeparator(string $separator): NumberField {
        $this->thousandsSeparator = $separator;
        return $this;
    }

    /**
     * 
     * @return void
     * @inheritDoc
     */
    public function ask(): void {

        $label = $this->label;

        if ($this->showFormatInLabel) {
            if ($this->decimalSeparator === null)
                $this->decimalSeparator = localeconv()['decimal_point'];
            if ($this->thousandsSeparator === null)
                $this->thousandsSeparator = localeconv()['thousands_sep'];
            if ($this->decimals === null)
                $this->decimals = localeconv()['frac_digits'];

            if ($this->onlyInt === false || $this->decimals > 0) {
                $digits = '';
                $digits = str_pad($digits, $this->decimals, '0');
                $label .= " [1{$this->thousandsSeparator}234{$this->decimalSeparator}$digits]";
            } else {
                $label .= " [1{$this->thousandsSeparator}234]";
            }
        }



        if ($this->requiredIndicator !== null && $this->required) {
            $label .= " {$this->requiredIndicator}";
        }

        if ($this->default !== null && $this->showDefaultInLabel) {
            $default = number_format($this->default, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
            $label .= " [Default: $default]";
        }
        
        if($this->showMinMaxInLabel){
            $minmax = '';
            if($this->min !== null && $this->max === null){
                $min = number_format($this->min, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $minmax = "[$min ~]";
            }elseif($this->min === null && $this->max !== null){
                $max = number_format($this->max, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $minmax = "[~ $max]";
            }elseif($this->min !== null && $this->max !== null){
                $min = number_format($this->min, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $max = number_format($this->max, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $minmax = "[$min ~ $max";
            }
        }

        $this->climate->out("$label:");
        if($this->showMinMaxInLabel){
            $this->climate->out($minmax);
        }
        $input = $this->climate->input('>');
        $this->answer = (string) $input->prompt();
        $this->parseInput();
        
        if ($this->answer === null) {
            if ($this->default !== null)
                $this->answer = $this->default;
        }

        if ($this->required) {
            if ($this->answer === null) {
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

        if ($this->min !== null) {
            if ($this->answer < $this->min) {
                $min = number_format($this->min, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $this->climate->error("Min: $min");
                $this->ask();
            }
        }

        if ($this->max !== null) {
            if ($this->answer > $this->max) {
                $max = number_format($this->max, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
                $this->climate->error("Max: $max");
                $this->ask();
            }
        }

        if ($this->onlyInt) {
            if (is_int($this->answer) === false) {
                $this->climate->error("Only integer!");
                $this->ask();
            }
        }
    }

    protected function parseInput(): void {
        if($this->answer === '') {
            $this->answer = null;
            return;
        }
        if ($this->thousandsSeparator !== null) {
            $this->answer = str_replace($this->thousandsSeparator, '', $this->answer);
        }
        if ($this->decimalSeparator !== null) {
            $this->answer = str_replace($this->decimalSeparator, '.', $this->answer);
        }
        if ($this->onlyInt) {
            settype($this->answer, 'integer');
        } else {
            settype($this->answer, 'float');
        }
    }

    public function format(): string {
        if ($this->decimalSeparator == null)
            $this->decimalSeparator = localeconv()['decimal_point'];
        if ($this->thousandsSeparator == null)
            $this->thousandsSeparator = localeconv()['thousands_sep'];

        if ($this->onlyInt === true) {
            $this->decimals = 0;
        } else {
            if ($this->decimals == null)
                $this->decimals = localeconv()['frac_digits'];
        }

        return number_format($this->answer, $this->decimals, $this->decimalSeparator, $this->thousandsSeparator);
    }

}
