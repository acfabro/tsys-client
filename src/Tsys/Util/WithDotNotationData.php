<?php


namespace Acfabro\Tsys\Util;


use Adbar\Dot;

trait WithDotNotationData
{
    /**
     * @var Dot
     */
    protected $data;

    public function __construct($data = [])
    {
        $this->data = new Dot();

        foreach ($data as $key => $value) {
            if (!in_array($key, $this->fields)) continue; // skip invalid fields
            $this->data[$key] = $value;
        }
    }

    public function get($name)
    {
        return $this->data->get($name);
    }

    public function set($name)
    {
        $this->data->set($name);
    }

    public function __get($name)
    {
        return $this->data->get($name);
    }

    public function __set($name, $value)
    {
        return $this->data->set($name, $value);
    }

    public function toArray()
    {
        return $this->data->all();
    }

}