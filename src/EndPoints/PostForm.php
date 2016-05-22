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
use Exception;

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

    /**
     * Use this to retrieve the url for the render url of a form
     *
     * @return string|bool The url to render the form or null if it is not found
     * @throws Exception If the form was not executed yet
     */
    public function getFormRenderUrl() {
        if (!$this->executed)
            throw new Exception("Please execute the end point before attempting to get the form rendering url");

        $links = $this->responseData->_links;

        foreach ($links as $link) {
            if ($link->rel == "form_render")
                return $link->href;
        }

        return false;
    }
}