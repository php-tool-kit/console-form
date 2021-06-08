<?php

namespace PTK\Console\Form\Field;

/**
 * Campo de seleção de Sim/Não
 *
 * @author Everton
 */
class YesNoField extends FieldAbstract {

    protected mixed $default = null;

    public function __construct(string|int $id, string $label) {
        parent::__construct($id, $label);
    }

    public function isRequired(): bool {
        throw new FeatureNotSupportedException('Yes/No always required.');
    }

    public function required(bool $required): FieldInterface {
        throw new FeatureNotSupportedException('Yes/No always required.');
    }

    public function setRequiredIndicator(?string $indicator): FieldInterface {
        throw new FeatureNotSupportedException('Yes/No always required.');
    }

    public function showDefaultInLabel(bool $show): FieldInterface {
        throw new FeatureNotSupportedException('Yes/No always required.');
    }

    /**
     * 
     * @param mixed $default Aceita y/n (case insensitive), 1/0, true/false.
     * @return FieldInterface
     * @throws InvalidArgumentException
     */
    public function setDefault(mixed $default): YesNoField {
        switch ($default) {
            case 'y':
            case 'Y':
            case true:
            case 1:
                $this->default = true;
                break;
            case 'n':
            case 'N':
            case false:
            case 0:
                $this->default = false;
                break;
            default:
                throw new InvalidArgumentException($default);
        }
        return $this;
    }

    public function ask(): void {
        $label = $this->label;

        $yes = 'y';
        $no = 'n';
        if ($this->default !== null) {
            switch ($this->default) {
                case true:
                    $yes = 'Y';
                    break;
                case false:
                    $no = 'N';
                    break;
            }
        }

        $label .= " [$yes/$no]";

        $this->climate->out("$label?");

        do {
            $input = $this->climate->input('>');
            $this->answer = $input->prompt();
            switch ($this->answer) {
                case 'y':
                case 'Y':
                    $this->answer = true;
                    break;
                case 'n':
                case 'N':
                    $this->answer = false;
                    break;
                case '':
                    if ($this->default !== null) {
                        $this->answer = $this->default;
                    };
                    break;
                default:
                    break;
            }
        } while ($this->answer !== true && $this->answer !== false);
    }

}
