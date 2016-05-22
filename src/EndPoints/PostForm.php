<?php
/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/22/16
 * Time: 12:34 AM
 */

namespace AxolotlInteractive\TypeForm\EndPoints;


use AxolotlInteractive\TypeForm\Fields\Field;
use AxolotlInteractive\TypeForm\TypeFormClient;
use AxolotlInteractive\TypeForm\TypeFormEndPoint;

class PostForm extends TypeFormEndPoint
{

    /**
     * @var string the title of this form
     */
    public $title;

    /**
     * @var Field[] all fields for this form
     */
    public $fields = [];

    /**
     * @var array all tags for this form
     */
    public $tags = [];

    /**
     * @var string the url for the web hook to process this form
     */
    public $webhook_submit_url = null;

    /**
     * @var bool whether or not the typeform branding should be disabled
     */
    public $branding = true;


    /**
     * PostForm constructor.
     * @param string $title the title for this form
     */
    public function __construct($title) {

        parent::__construct(TypeFormClient::METHOD_POST, "/forms/", 201);

        $this->title = $title;
    }

    /**
     * Override this to get all params for this call
     *
     * @return array
     */
    protected function getParams() {
        return (array) $this;
    }
}