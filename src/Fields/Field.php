<?php
/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/22/16
 * Time: 12:49 AM
 */

namespace AxolotlInteractive\TypeForm\Fields;


class Field
{

    /**
     * @var string the type for this field
     */
    public $type;

    /**
     * @var string the question text
     */
    public $question;

    /**
     * @var string the description for this field
     */
    public $description = '';

    /**
     * @var bool whether or not this field is required
     */
    public $required = false;

    /**
     * @var string|null An internal reference to this field
     */
    public $ref;

    /**
     * Field constructor.
     * @param string $type the type of this field
     * @param string $question the content of this question
     */
    public function __construct($type, $question) {

        $this->type = $type;
        $this->question = $question;
    }

    /**
     * Transforms this field into an array
     *
     * @return array
     */
    public function toArray() {
        $data = [
            "type" => $this->type,
            "question" => $this->question,
            "required" => $this->required
        ];

        if ($this->description)
            $data["description"] = $this->description;
        if ($this->ref)
            $data["ref"] = $this->ref;

        return $data;
    }

}