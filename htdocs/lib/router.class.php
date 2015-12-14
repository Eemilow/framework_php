<?php

class Router{
	
	protected $uri;

	protected $controller;

	protected $action;

	protected $params;

	protected $route;

	protected $method_prefix;

	protected $language;

	public function __construct($uri)
	{
		$this->uri = urldecode(trim($uri, '/'));

		//get defaults
		//
		$routes = Config::get('routes');
		$this->route = Config::get('default_route');
		$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
		$this->language = Config::get('default_language');
		$this->controller = Config::get('default_controller');
		$this->action = Config::get('default_action');

		$uri_parts = explode('?', $this->uri);

		$path = $uri_parts[0];

		$path_parts = explode('/', $path);

		// echo "<pre>"; print_r($path_parts);
		
		if( count($path_parts) )
		{
			if( in_array(strtolower(current($path_parts)), array_keys($routes)) )
			{
				$this->route = strtolower(current($path_parts));
				$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
				array_shift($path_parts);
			}	elseif ( in_array(strtolower(current($path_parts)), Config::get('languages')) ) {
				$this->language = strtolower(current($path_parts));
				array_shift($path_parts);
			}

			//get the controller
			if( current($path_parts) )
			{
				$this->controller = strtolower(current($path_parts));
				array_shift($path_parts);
			}

			//get the action
			if( current($path_parts) )
			{
				$this->action = strtolower(current($path_parts));
				array_shift($path_parts);
			}
			
			//get the params
			$this->params = $path_parts;
		}
	}
    /**
     * Gets the value of uri.
     *
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Gets the value of controller.
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Gets the value of action.
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
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

    /**
     * Gets the value of route.
     *
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Gets the value of method_prefix.
     *
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * Gets the value of language.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }
}