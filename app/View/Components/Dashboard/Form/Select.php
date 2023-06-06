<?php

namespace App\View\Components\dashboard\Form;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The select id.
     *
     * @var string
     */
    public $id;

    /**
     * The select name.
     *
     * @var string
     */
    public $name;

    /**
     * The select is required.
     *
     * @var boolean
     */
    public $isRequired;

    /**
     * The select required message.
     *
     * @var string
     */
    public $requiredMessage;

    /**
     * The select default option name.
     *
     * @var string
     */
    public $defaultOptionName;

    /**
     * The select required message.
     *
     * @var array|Collection
     */
    public $options;

    /**
     * The select selected option value.
     *
     * @var string
     */
    public $selectedOption;

    /**
     * The select is multiple.
     *
     * @var boolean
     */
    public $isMultiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $defaultOptionName, $options, $selectedOption = '', $isRequired = false, $requiredMessage = '', $isMultiple = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->defaultOptionName = $defaultOptionName;
        $this->options = $options;
        $this->isRequired = $isRequired;
        $this->requiredMessage = $requiredMessage;
        $this->selectedOption = $selectedOption;
        $this->isMultiple = $isMultiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.form.select');
    }
}
