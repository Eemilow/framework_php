<?php

class Controller{
	
	protected $data;

	protected $model;

	protected $params;

	public function __construct($data = array()){
		$this->data = $data;
		$this->params = App::getRouter()->getParams();
	}

    /**
     * Gets the value of data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets the value of model.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Gets the value of params.
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }
}