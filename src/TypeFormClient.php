<?php
namespace AxolotlInteractive\TypeForm;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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
     * Helper constant for get requests
     */
    const METHOD_GET = 'GET';

    /**
     * Helper constant for post requests
     */
    const METHOD_POST = 'POST';

    /**
     * Helper constant for put requests
     */
    const METHOD_PUT = 'PUT';

    /**
     * Helper constant for delete requests
     */
    const METHOD_DELETE = 'DELETE';


    /**
     * @var string The base url for the typeform api
     */
    private $baseURL = "https://api.typeform.io/v";

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

        $options = [
            "base_uri" => $this->baseURL . $apiVersion,
            "headers" => [
                "X-API-TOKEN" => $apiKey
            ]
        ];

        $this->guzzleClient = new Client($options);
    }


    /**
     * Sends a get request to the type form api and returns a response
     *
     * @param string $method the method we are running
     * @param string $endPoint The end point requested
     * @param array $params An array of params for this
     * @return stdClass The response from the server
     * @throws Exception If the status code on the response is 403 or the method is not valid
     */
    public function sendEndPoint($method, $endPoint, array $params = []) {
        $data = [];

        switch ($method) {
            case static::METHOD_DELETE:
            case static::METHOD_GET:
                $data["query"] = $params;
                break;
            case static::METHOD_POST:
            case static::METHOD_PUT:
                $data["json"] = $params;
                break;
            default:
                throw new Exception("Invalid HTTP method passed into endpoint");
        }

        $response = $this->guzzleClient->request($method, $endPoint, $data);

        if ($response->getStatusCode() == 403)
            throw new Exception('The supplied API key is not a valid Type Form API Key.');

        $body = $response->getBody();
        $responseData = json_decode($body, true);

        return $responseData;
    }

}