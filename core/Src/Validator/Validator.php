<?php
namespace Src\Validator;
class Validator
{
    protected array $data;
    protected array $rules;
    protected array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data  = $data;
        $this->rules = $rules;
    }

    public function fails(): bool
    {
        foreach ($this->rules as $field => $ruleList) {

            $value = $this->data[$field] ?? '';

            foreach ($ruleList as $rule) {

                $param = null;
                if (str_contains($rule, ':')) {
                    [$ruleName, $param] = explode(':', $rule, 2);
                } else {
                    $ruleName = $rule;
                }

                if ($ruleName === 'required' && $this->isEmpty($field)) {
                    $this->errors[$field][] = 'Поле не может быть пустым';
                }

                if ($ruleName === 'max' && !$this->isEmpty($field)) {
                    if (mb_strlen((string)$value) > (int)$param) {
                        $this->errors[$field][] = "Максимальная длина — {$param} символов";
                    }
                }

                if ($ruleName === 'digits' && !$this->isEmpty($field)) {
                    if (!ctype_digit((string)$value)) {
                        $this->errors[$field][] = 'Допускаются только цифры';
                    }
                }

                // наш новый валидатор телефона
                if ($ruleName === 'phone' && !$this->isEmpty($field)) {
                    $clean = preg_replace('/\D+/', '', (string)$value);

                    if (mb_strlen($clean) < 10 || mb_strlen($clean) > 15) {
                        $this->errors[$field][] = 'Телефон должен содержать от 10 до 15 цифр';
                    } elseif (!ctype_digit($clean)) {
                        $this->errors[$field][] = 'Телефон должен состоять только из цифр';
                    }
                }
            }
        }

        return !empty($this->errors);
    }


    protected function isEmpty(string $field): bool
    {
        return !isset($this->data[$field]) || trim((string)$this->data[$field]) === '';
    }

    public function errors(): array
    {
        return $this->errors;
    }
}