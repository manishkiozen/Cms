<?php namespace App\Html;

class Toolbar {

    protected $css_class = null;
    protected $tools = [];

    /**
     * Creates a new toolbar instance
     *
     * @param string $css_class
     */
    public function __construct($css_class = null)
    {
        $this->css_class = $css_class;
    }

    /**
     * Returns a new toolbar instance.
     *
     * @param string $css_class
     * @return Toolbar
     */
    public static function make($css_class = null)
    {
        return new static($css_class);
    }

    /**
     * Adds a tool to the toolbar.
     *
     * @param string $html
     * @return Toolbar
     */
    public function addTool($html)
    {
        $this->tools[] = $html;
        return $this;
    }

    /**
     * Renders the toolbar.
     *
     * @return string
     */
    public function render()
    {
        return view('widgets.toolbar')
            ->with(get_object_vars($this))
            ->render();
    }

    /**
     * Displays the toolbar after adding the last tool.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Adds a cancel button.
     *
     * @param string $route
     * @return Toolbar
     */
    public function cancel($route)
    {
        return$this->addTool(view('widgets.toolbar.cancel', compact('route'))->render());
    }

    /**
     * Adds a button for creating a new model.
     *
     * @param string $route
     * @return Toolbar
     */
    public function create($route)
    {
        return $this->addTool(view('widgets.toolbar.create', compact('route'))->render());
    }

    /**
     * Adds a submit button for storing a new model.
     *
     * @return Toolbar
     */
    public function store()
    {
        return $this->addTool(view('widgets.toolbar.store')->render());
    }

    /**
     * Adds a search form to the toolbar.
     *
     * @return Toolbar
     */
    public function search()
    {
        return $this->addTool(view('widgets.toolbar.search')->render());
    }

    /**
     * Adds a trash button to the toolbar.
     *
     * @param string $route
     * @param int $id
     * @return Toolbar
     */
    public function trash($route, $id)
    {
        return $this->addTool(view('widgets.toolbar.trash', compact('route', 'id'))->render());
    }

}
