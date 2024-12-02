<?php

namespace Core;

abstract class Controller 
{
    protected function render($view, $data = [])
    {
        extract($data);

        $errors = unFlash('errors', []);
        $old = unFlash('old', []);

        require '../app/views/'. str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php';
    }

    protected function redirect($url)
    {
        header("Status: 301 Moved Permanently", false, 301);
        header('Location: ' . $url);
    }

    protected function validate(array $validationRules , string|null $method = 'post'): array
    {
        $errors = [];
        
        foreach ($validationRules as $key => $rules) {

            if ($method === 'post') {
                $value = trim($_POST[$key] ?? '');
            } else {
                $value = trim($_GET[$key] ?? '');
            }
            
            if (! is_array($rules)) {
                $rules = explode('|', $rules);
            }

            foreach ($rules as $rule) {

                @list($rule, $options) = explode(':', $rule);
                
                $options = explode(',', $options ?? '');

                switch($rule){
                    case 'required':
                        if ($value == '') {
                            $errors[$key] = 'Le champ est obligatoire';
                            break 2;
                        }
                        break;
                    case 'max':
                        if (strlen($value) > $options[0]) {
                            $errors[$key] = 'Le champ ne doit pas dépasser ' . $options[0] . ' caractères';
                            break 2;
                        }
                        break;
                    case 'decimal':
                        if (filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
                            $errors[$key] = 'Le champ doit être un nombre décimal';
                            break 2;
                        }
                        break;
                    case 'min':
                        if ($value < $options[0]) {
                            $errors[$key] = 'Le champ doit être supérieur à ' . $options[0];
                            break 2;
                        }
                        break;
                    case 'nullable':
                        if ($value == '') {
                            break 2;
                        }
                        break;
                    case 'exists':
                        $model = "App\Models\\" . $options[0];
                        $column = $options[1] ?? 'id';

                        if ($column === 'id') {
                            if (! $model::find($value)) {
                                $errors[$key] = 'La valeur du champ n\'existe pas';
                                break 2;
                            }
                        } else {
                            if (! $model::where($column, $value)->first()) {
                                $errors[$key] = 'La valeur du champ n\'existe pas';
                                break 2;
                            }
                        }

                        break;
                    
                }
            }
        }

        if (! empty($errors)) {
            flash('errors', $errors);

            flash('old', $method === 'post' ? $_POST : $_GET);

            $this->redirect($_SERVER['HTTP_REFERER']);
        }

        return $errors;
    }
}