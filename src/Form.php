<?php

namespace PTK\Console\Form;

use League\CLImate\CLImate;
use PTK\Console\Form\Field\FieldInterface;

/**
 * Implementa um formulário.
 * 
 * Formulário é um conjunto de campos \PTK\Console\Form\Field\FieldInterface 
 * para entrada de dados do usuário.
 *
 * @author Everton
 */
class Form {

    /**
     * 
     * @var array<\PTK\Console\Form\Field\FieldInterface> Lista de campos 
     * do formulário.
     */
    protected array $fields = [];

    /**
     * 
     * @var CLImate
     */
    protected CLImate $climate;

    /**
     * 
     * @var string Título do formulário.
     */
    protected string $title = '';

    /**
     * 
     * @var string Detalhes do formulário.
     */
    protected string $detail = '';

    /**
     * 
     */
    public function __construct() {
        $this->climate = new CLImate();
    }

    /**
     * Define um campo no formulário.
     * 
     * Pode ser utilizado para adicionar/modificar campos.
     * 
     * @param FieldInterface $field
     * @return Form
     */
    public function setField(FieldInterface $field): Form {
        $this->fields[$field->id()] = $field;
        
        return $this;
    }

    /**
     * Retorna o campo do formulário de acordo com o id de campo fornecido.
     * 
     * @param mixed $fieldId
     * @return FieldInterface
     * @throws \PTK\Console\Forma\Exception\FieldNotFoundException
     */
    public function getField($fieldId): FieldInterface {
        if (key_exists($fieldId, $this->fields)) {
            return $this->fields[$fieldId];
        }

        throw new \PTK\Console\Forma\Exception\FieldNotFoundException($fieldId);
    }

    /**
     * Retorna todos os campos do formulário.
     * 
     * @return array<\PTK\Console\Form\Field\FieldInterface>
     */
    public function getAllFields(): array {
        return $this->fields;
    }

    /**
     * Exibe o título do formulário, se existir.
     * 
     * @return void
     */
    protected function showTitle(): void {
        $this->climate->bold()->out($this->title);
        $this->climate->border('*');
    }

    /**
     * Exibe mensagem de detalhes do formulário, se existir.
     * 
     * @return void
     */
    protected function showDetail(): void {
        $this->climate->green()->out($this->detail);
        $this->climate->border('-');
    }

    /**
     * Exibe o final do formulário.
     * @return void
     */
    protected function showEnd(): void {
        $this->climate->br();
        $this->climate->border('$');
    }

    /**
     * Inicia o preenchimento dos campos do formulário.
     * 
     * @return void
     */
    public function ask(): void {
        //inicia o formulário
        $this->climate->border('#');

        //mostra o título
        if ($this->title !== '') {
            $this->showTitle();
        }

        //mostra os detalhes
        if ($this->detail !== '') {
            $this->showDetail();
        }

        //recebe os dados de cada campo
        foreach ($this->fields as $field) {
            $field->ask();
        }

        //mostra o fim do formulário
        $this->showEnd();
    }

    /**
     * Retorna o conjunto de respostas, onde a chave do array é o id do campo.
     * 
     * @return array
     */
    public function answers(): array {
        $answers = [];

        foreach ($this->fields as $id => $field) {
            $answers[$id] = $field->answer();
        }

        return $answers;
    }

    /**
     * Título do formulário.
     * 
     * @param string $title
     * @return Form
     */
    public function setTitle(string $title): Form {
        $this->title = $title;
        return $this;
    }

    /**
     * Define um texto de detalhe do formulário.
     * 
     * Ideal para detalhar instruções de preenchimentos, finalidade do 
     * formulário ou outras instruções.
     * 
     * @param string $detail
     * @return Form
     */
    public function setDetail(string $detail): Form {
        $this->detail = $detail;
        return $this;
    }

}
