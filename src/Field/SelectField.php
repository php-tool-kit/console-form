<?php

namespace PTK\Console\Form\Field;

/**
 * Campo para escolha de valores múltiplos a partir de uma lista.
 *
 * @author Everton
 */
class SelectField extends FieldAbstract implements DefaultInterface {
    use DefaultTrait;

    protected array $options;

    /**
     * Exibe só a primeira vez a lista de opções.
     */
    const SHOW_MODE_NORMAL = 0;

    /**
     * A cada interação, exibe a lista de opções com as selecionadas.
     */
    const SHOW_MODE_REPEAT = 1;

    /**
     * Limpa a tela a cada interação.
     */
    const SHOW_MODE_CLEAR = 2;

    protected int $showMode = 0;
    protected string $listTitle = '';
    protected array $selection = [];
    protected string $sentinel = '';

    public function __construct(string|int $id, string $label, array $options) {
        parent::__construct($id, $label);
        $this->options = $options;
    }

    public function setShowMode(int $mode): SelectField {
        $this->showMode = $mode;
        return $this;
    }

    public function setSentinel(string $sentinel): SelectField {
        $this->sentinel = $sentinel;
        return $this;
    }

    public function setListTitle(string $title): ChoiceField {
        $this->listTitle = $title;
        return $this;
    }

    public function setDefault($default): SelectField {

        $this->default = $default;
        $this->selection = $default;
        return $this;
    }

    /**
     * 
     * @return void
     * @inheritDoc
     */
    public function ask(): void {

        $label = $this->label;

        if ($this->listTitle !== '') {
            $this->climate->out($this->listTitle);
        }

        $this->printList();
        $repeat = false;

        $this->climate->br();
        $this->climate->out("$label:");

        do {
            if ($this->showMode === self::SHOW_MODE_CLEAR) {
                $this->climate->clear();
                if ($this->listTitle !== '') {
                    $this->climate->out($this->listTitle);
                }
                $this->printList();
                $this->climate->br();
                $this->climate->out("$label:");
            }

            if ($this->showMode === self::SHOW_MODE_REPEAT) {
                if ($repeat === true) {
                    $this->printList();
                    $this->climate->br();
                    $this->climate->out("$label:");
                }
                $repeat = true;
            }
            $input = $this->climate->input('>');
            $this->answer = $input->prompt();

            if ($this->answer === $this->sentinel) {
                $this->climate->info("Seleção finalizada!");
                break;
            }
            if (key_exists($this->answer, $this->options)) {
                $value = array_search($this->answer, $this->selection);
                if ($value !== false) {
                    unset($this->selection[$value]);
                } else {
                    $this->selection[] = $this->answer;
                }
            } else {
                $this->climate->error("Chave [{$this->answer}] não é opção válida!");
            }
        } while ($this->answer !== $this->sentinel);
    }

    protected function determineMaxSizeOfKeys(): int {
        $maxSize = 0;
        foreach (array_keys($this->options) as $key) {
            $currentSize = strlen($key);
            if ($currentSize > $maxSize)
                $maxSize = $currentSize;
        }

        return $maxSize;
    }

    protected function printList(): void {
        foreach ($this->options as $key => $item) {
            $selected = ' ';

            if (array_search($key, $this->selection) !== false)
                $selected = 'X';

            $label = "[$selected] " . '[ ' . str_pad($key, $this->determineMaxSizeOfKeys(), ' ', STR_PAD_BOTH) . ' ] ';
            $this->climate->inline($label)->out($item);
        }
    }

    public function getSelection(): array {
        $selection = [];
        foreach ($this->selection as $key) {
            $selection[$key] = $this->options[$key];
        }

        return $selection;
    }

    public function answer() {
        return $this->getSelection();
    }

}
