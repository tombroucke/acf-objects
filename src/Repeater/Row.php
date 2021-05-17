<?php
namespace Otomaties\AcfObjects\Repeater;

class Row
{
    /**
     * Repeater row
     *
     * @var array
     */
    protected $row = [];

    /**
     * Set row
     *
     * @param array $row
     */
    public function __construct(array $row = [])
    {
        $this->row = $row;
    }

    /**
     * Get sub field value
     *
     * @param string $key The sub field key
     * @return mixed
     */
    public function get($key)
    {
        return $this->row[ $key ];
    }
}
