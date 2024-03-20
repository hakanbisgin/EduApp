<?php

namespace App\Controllers;

class CRUDController
{
    protected $model;
    protected $modelClass;
    protected $viewPath = 'crud';

    public function __construct()
    {
        $this->model = new $this->modelClass();
    }

    public function index()
    {
        view("$this->viewPath.index",
            ['model' =>
                $this->model,
                $this->model->pluralName => $this->model->all()
            ]);
    }

    public function show($id)
    {
        $entity = $this->model->find($id);
        if (!$entity) {
            addMessage(ucfirst($this->model->name) . " not found");
            back();
        }
        view("$this->viewPath.show",
            ['model' =>
                $this->model,
                $this->model->name => $entity
            ]);
    }

    public function create()
    {
        view("$this->viewPath.create",
            ['model' => $this->model]);
    }

    public function store()
    {
        try {
            $error = "";
            foreach ($_POST as $key => $value) {
                if (in_array($key, $this->model->attributes)) {
                    if (!empty($value)) {
                        if ($value == "") {
                            $error .= ucfirst(str_replace(["_", "id"], [" ", ""], $key)) . " is required <br>";
                        } else {
                            $params[$key] = $value;
                        }
                    } else {
                        $error .= ucfirst(str_replace(["_", "id"], [" ", ""], $key)) . " can not be null <br>";
                    }

                } else {
                    $error .= ucfirst(str_replace("_", " ", $key)) . " is not valid <br>";
                }

            }
            if ($error !== "") {
                $error .= "Please check your input and try again. <br>";
                throw new \Exception();
            }
            $this->model->create(...$params);
            addMessage('Created successfully', 'success');
            redirect("/{$this->model->pluralName}");
        } catch (\Exception $e) {
            $error .= ucfirst($this->model->name) . " could not be created ";
            addMessage($error);
            back();
        }
    }

    public function edit($id)
    {
        $entity = $this->model->find($id);
        if (!$entity) {
            addMessage(ucfirst($this->model->name) . " not found");
            back();
        }
        view("$this->viewPath.edit",
            ['model' =>
                $this->model,
                $this->model->name => $entity
            ]);
    }

    public function update($id)
    {
        try {
            $error = "";
            foreach ($_POST as $key => $value) {
                if (in_array($key, $this->model->attributes)) {
                    if (!empty($value)) {
                        if ($value == "") {
                            $error .= ucfirst(str_replace(["_", "id"], [" ", ""], $key)) . " is required <br>";
                        } else {
                            $params[$key] = $value;
                        }
                    } else {
                        $error .= ucfirst(str_replace(["_", "id"], [" ", ""], $key)) . " can not be empty <br>";
                    }
                } else {
                    $error .= ucfirst(str_replace("_", " ", $key)) . " is not valid <br>";
                }

            }
            if ($error !== "") {
                $error .= "Please check your input and try again. <br>";
                throw new \Exception();
            }
            $this->model->update($id, ...$params);
            addMessage('Updated successfully', 'success');
        } catch (\Exception $e) {
            $error .= ucfirst($this->model->name) . " could not be updated ";
            addMessage($error);
        }
        back();
    }

    public function destroy($id)
    {
        try {
            $this->model->delete($id);
        } catch (\Exception $e) {
            addMessage(ucfirst($this->model->name) . " could not be deleted ");
            back();
        }
        addMessage('Deleted successfully', 'success');
        redirect("/{$this->model->pluralName}");
    }

}