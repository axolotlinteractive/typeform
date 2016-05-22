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
    private $label;

    /**
     * Choice constructor.
     * @param $label
     */
    public function __construct($label) {
        $this->label = $label;
    }

    /**
     * Used to properly turn this into an array
     *
     * @return array
     */
    public function toArray() {
        return [
            "label" => $this->label
        ];
    }


}