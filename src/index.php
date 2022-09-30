<?php
    require __DIR__. '/../vendor/autoload.php';

    use Psr\Http\Message\RequestInterface;
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\Handler\CurlHandler;
    use GuzzleHttp\Client;

    function add_header($header, $value)
    {
        return function (callable $handler) use ($header, $value) {
            return function (
                RequestInterface $request,
                array $options
            ) use ($handler, $header, $value) {
                $request = $request->withHeader($header, $value);
                return $handler($request, $options);
            };
        };
    }

    $stack = new HandlerStack();
    $stack->setHandler(new CurlHandler());
    $stack->push(add_header('Authorization', 'eW9ob21vYmlsZV8xOjQ2ZTIwNTI4LTJiNTQtNDQ1NS1iOTZmLWUyODhlZjM2MDFiMw=='));
    $stack->push(add_header('ApiKey', '270a3027-a926-490c-b669-eadf3f61e7af'));
    $client = new Client(['handler' => $stack]);

    $config = new Swagger\Client\Configuration();

    $config->setHost('https://ws.telna.com/ds/u/distributorPPUService/v1');

    $apiInstance = new Swagger\Client\Api\InventoryApi(
        $client,
        $config
    );
    $distributor_id = 69936; // int | The unique identifier of a distributor
    $inventory_id = 49026; // int | The unique identifier of an inventory
    $request_id = "request_id_example"; // string | It will be returned in the response header, the purpose of the RequestId to provide a reference ID to the client side developer if one is using a asynchronous system

    try {
        $result = $apiInstance->getInventoryOverdraft($distributor_id, $inventory_id, $request_id);
        print_r($result);
    } catch (Exception $e) {
        echo 'Exception when calling InventoryApi->getInventoryOverdraft: ', $e->getMessage(), PHP_EOL;
    }
?>
