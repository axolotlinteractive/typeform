<?php
namespace AxolotlInteractive\TypeForm;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use stdClass;

/**
 * Created by PhpStorm.
 * User: bryce
 * Date: 5/21/16
 * Time: 9:30 PM
 */
class TypeFormClient
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
     * @var Client The guzzle client instance for this TypeForm Client
     */
    private $guzzleClient;

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

        $this->guzzleClient = new Client(["base_uri", $this->baseURL . $apiVersion]);

        $this->apiKey = $apiKey;
    }

    /**
     * Sends a get request to the type form api and returns a response
     *
     * @param string $endPoint The end point requested
     * @param array $params An array of params for this
     * @return stdClass The response from the server
     * @throws Exception if the end point failed
     */
    public function getEndPoint($endPoint, array $params = []) {
        $params["key"] = $this->apiKey;

        $data = ["query" => $params];

        $response = $this->guzzleClient->get($endPoint, $data);

        $this->validateKey($response);

        $body = $response->getBody();
        $responseData = json_decode($body, true);

        return $responseData;
    }

    /**
     * Validates that the response did not receive a 403 status code
     *
     * @param ResponseInterface $response A response received from Type Form
     * @throws Exception If the status code on the response is 403
     */
    private function validateKey(ResponseInterface $response) {
        if ($response->getStatusCode() == 403)
            throw new Exception('The supplied API key is not a valid Type Form API Key.');
    }
}