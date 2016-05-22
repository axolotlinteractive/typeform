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
    private $choices = [];

    /**
     * @var bool whether or not this field will allow multiple choice
     */
    private $allow_multiple_selections = false;

    /**
     * @var bool whether or not to randomize the order of the choices
     */
    private $randomize = false;

    /**
     * @var bool whether or not to align the choices vertically
     */
    private $vertical_alignment = false;

    /**
     * @var bool whether or not there should be a field to enter a 'other' answer on the form
     */
    private $add_other_choice = false;

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

        $data["choices"] = [];

        foreach ($this->choices as $choice)
            $data["choices"][] = $choice->toArray();

        $data["allow_multiple_selections"] = $this->allow_multiple_selections;
        $data["randomize"] = $this->randomize;
        $data["vertical_alignment"] = $this->vertical_alignment;
        $data["add_other_choice"] = $this->add_other_choice;

        return $data;
    }

    /**
     * @param Choice $choice
     */
    public function addChoices($choice) {
        $this->choices[] = $choice;
    }

    /**
     * @param boolean $allow_multiple_selections
     */
    public function setAllowMultipleSelections($allow_multiple_selections) {
        $this->allow_multiple_selections = $allow_multiple_selections;
    }

    /**
     * @param boolean $randomize
     */
    public function setRandomize($randomize) {
        $this->randomize = $randomize;
    }

    /**
     * @param boolean $vertical_alignment
     */
    public function setVerticalAlignment($vertical_alignment) {
        $this->vertical_alignment = $vertical_alignment;
    }

    /**
     * @param boolean $add_other_choice
     */
    public function setAddOtherChoice($add_other_choice) {
        $this->add_other_choice = $add_other_choice;
    }
}