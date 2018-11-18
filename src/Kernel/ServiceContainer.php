<?php

namespace Luozhenyu\JinRiTeMai\Kernel;

use Pimple\Container;

class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * @var array
     */
    protected $providers = [];

    /**
     * ServiceContainer constructor.
     * @param string $appKey
     * @param string $appSecret
     * @param array $config
     */
    public function __construct(string $appKey, string $appSecret, array $config = [])
    {
        parent::__construct();
        $this->registerProviders($this->getProviders());
        $this->userConfig = array_merge(compact('appKey', 'appSecret'), $config);
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    /**
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->userConfig['appKey'];
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->userConfig['appSecret'];
    }

    /**
     * @return string
     */
    public function getAppVersion()
    {
        return (string)$this->getConfig()['app']['version'];
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return array_replace_recursive($this->defaultConfig, $this->userConfig);
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function rebind(string $id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function __get(string $id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function __set(string $id, $value)
    {
        $this->offsetSet($id, $value);
    }
}