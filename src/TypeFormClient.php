<?php
namespace AxolotlInteractive\TypeForm;
use Exception;
use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/21/16
 * Time: 9:30 PM
 */
class TypeFormClient extends Client
{

    /**
     * @var string The base url for the typeform api
     */
    private $baseURL = "https://api.typeform.io/v";

    /**
     * @var string the key passed in by the user
     */
    private $apiKey;


    /**
     * TypeFormClient constructor.
     * @param double $apiVersion The version of the api as a double
     * @param string $apiKey The api key for type form
     * @throws Exception If an incorrect version was passed in
     */
    public function __construct($apiVersion, $apiKey)
    {
        if (!in_array($apiVersion, [0.4]))
            throw new Exception("Type Form api version $apiVersion is not currently supported");

        parent::__construct(["base_uri", $this->baseURL . $apiVersion]);

        $this->apiKey = $apiKey;
    }
}