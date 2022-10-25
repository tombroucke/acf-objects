<?php
namespace Otomaties\AcfObjects\Repeater;

class Row
{
    /**
     * Repeater row
     *
     * @var array<string, mixed>
     */
    protected array $row = [];

    /**
     * Set row
     *
     * @param array<string, mixed> $row
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
    public function get(string $key) : mixed
    {
        return isset($this->row[$key]) ? $this->row[$key] : null;
    }
}
