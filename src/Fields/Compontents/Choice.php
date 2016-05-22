<?php
namespace AxolotlInteractive\TypeForm\Fields\Components;

/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/22/16
 * Time: 1:19 AM
 */
class Choice
{

    /**
     * @var string the label of this choice
     */
    public $label;

    /**
     * Choice constructor.
     * @param $label
     */
    public function __construct($label) {
        $this->label = $label;
    }
}