<?php

namespace Luozhenyu\JinRiTeMai\Kernel;


use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Luozhenyu\JinRiTeMai\Kernel\Exception\HttpRequestException;
use Luozhenyu\JinRiTeMai\Kernel\Exception\JsonException;

/**
 * Class BaseClient
 * @package Luozhenyu\JinRiTeMai\Kernel
 */
abstract class BaseClient
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * BaseClient constructor.
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $path
     * @param array $query
     * @return array
     * @throws HttpRequestException
     * @throws JsonException
     */
    public function httpGet(string $path, array $query = [])
    {
        $app_key = $this->app->getAppKey();
        $method = str_replace('/', '.', $path);
        $param_json = $this->buildParameterJson($query);
        $timestamp = $this->getCurrentTimestamp();
        $v = $this->app->getAppVersion();

        $sign = $this->makeSign(compact('app_key', 'method', 'param_json', 'timestamp', 'v'));
        return $this->request($path, 'GET', [
            'query' => compact('app_key', 'method', 'param_json', 'timestamp', 'v', 'sign'),
        ]);
    }

    /**
     * @param array $arr
     * @return string
     * @throws JsonException
     */
    protected function buildParameterJson(array $arr)
    {
        if (!$result = json_encode($this->sortByKey($arr), JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE)) {
            throw new JsonException;
        }
        return $result;
    }

    /**
     * @param array $arr
     * @return array
     */
    protected function sortByKey(array $arr)
    {
        foreach ($arr as $k => &$v) {
            $v = (string)$v;
        }
        ksort($arr, SORT_STRING);
        return $arr;
    }

    /**
     * @return string
     */
    protected function getCurrentTimestamp()
    {
        return Carbon::now()->toDateTimeString();
    }

    protected function makeSign(array $credentials)
    {
        $combine = '';
        foreach ($this->sortByKey($credentials) as $k => $v) {
            $combine .= $k . $v;
        }
        $app_secret = $this->app->getAppSecret();
        return md5($app_secret . $combine . $app_secret);
    }

    /**
     * @param $url
     * @param string $method
     * @param array $options
     * @return array
     * @throws HttpRequestException
     */
    public function request($url, $method = 'GET', array $options = [])
    {
        $request = $this->app->getConfig()['request'];

        $options ['base_uri'] = $request['base_uri'];
        $options ['timeout'] = $request['timeout'];

        try {
            $response = $this->getHttpClient()->request($method, $url, $options);
        } catch (GuzzleException $e) {
            throw new HttpRequestException;
        }
        $responseArray = json_decode($response->getBody(), true);

        $err_no = $responseArray['err_no'];
        $message = $responseArray['message'];
        if ($err_no !== 0) {
            throw new HttpRequestException($message, $err_no);
        }

        return $responseArray['data'];
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient()
    {
        if (!($this->httpClient instanceof ClientInterface)) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }
}