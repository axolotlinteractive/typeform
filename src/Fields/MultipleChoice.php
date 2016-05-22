<?php
/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/22/16
 * Time: 1:17 AM
 */

namespace AxolotlInteractive\TypeForm\Fields;


use Choice;

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
}