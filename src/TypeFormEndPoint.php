<?php
/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/21/16
 * Time: 11:03 PM
 */

namespace AxolotlInteractive\TypeForm;


use Exception;
use Psr\Http\Message\ResponseInterface;

abstract class TypeFormEndPoint
{

    /**
     * @var string the HTTP method type
     */
    private $method;

    /**
     * @var string the url for the endpoint after the version number
     */
    private $endPointUrl;

    /**
     * @var int the response code we are expecting if the call was successful
     */
    private $successCode;

    /**
     * @var object the response from the server
     */
    protected $responseData = null;

    /**
     * @var bool whether or not this end point has been executed
     */
    protected $executed = false;

    /**
     * TypeFormEndPoint constructor.
     * @param string $method The method for this end point
     * @param string $endPointUrl The base url for this end point e.g. /forms/
     * @param int $successCode The response code if this endpoint is a successful response
     */
    public function __construct($method, $endPointUrl, $successCode) {

        $this->method = $method;
        $this->endPointUrl = $endPointUrl;
        $this->successCode = $successCode;
    }

    /**
     * @param TypeFormClient $client
     * @return object
     * @throws Exception
     */
    public function execute(TypeFormClient $client) {

        $response = $client->sendEndPoint($this->method, $this->endPointUrl, $this->getParams());
        $body = $response->getBody();
        $json = json_decode($body);

        if ($response->getStatusCode() != $this->successCode) {

            throw new Exception($json ? $json->message : "Unknown error with typeform API");
        }

        $this->responseData = $json;
        $this->executed = true;
    }


    /**
     * Override this to get all params for this call
     *
     * @return array
     */
    protected abstract function getParams();
}