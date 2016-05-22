<?php
/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/22/16
 * Time: 1:17 AM
 */

namespace AxolotlInteractive\TypeForm\Fields;


use AxolotlInteractive\TypeForm\Fields\Components\Choice;

class MultipleChoice extends Field
{

    /**
     * @var Choice[] all the choices for this field
     */
    public $choices = [];

    /**
     * @var bool whether or not this field will allow multiple choice
     */
    public $allow_multiple_selections = false;

    /**
     * @var bool whether or not to randomize the order of the choices
     */
    public $randomize = false;

    /**
     * @var bool whether or not to align the choices vertically
     */
    public $vertical_alignment = false;

    /**
     * @var bool whether or not there should be a field to enter a 'other' answer on the form
     */
    public $add_other_choice = false;

    /**
     * MultipleChoice constructor.
     * @param string $question
     */
    public function __construct($question) {
        parent::__construct('multiple_choice', $question);
    }

    /**
     * Transforms this field into an array
     *
     * @return array
     */
    public function toArray() {

        $data = parent::toArray();

        $data["choices"] = $this->choices;
        $data["allow_multiple_selections"] = $this->allow_multiple_selections;
        $data["randomize"] = $this->randomize;
        $data["vertical_alignment"] = $this->vertical_alignment;
        $data["add_other_choice"] = $this->add_other_choice;

        return $data;
    }
}