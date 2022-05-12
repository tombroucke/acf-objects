<?php
namespace Otomaties\AcfObjects\FlexibleContent;

class Row
{
    /**
     * Set row
     *
     * @param array $row The ACF Flexible content row
     * @return void
     */
    public function __construct(protected array $row = [])
    {
    }

    /**
     * Get row value
     *
     * @param string $key The sub field key
     * @return mixed
     */
    public function get(string $key) : mixed
    {
        return isset($this->row[$key]) ? $this->row[$key] : null;
    }

    /**
     * Get layout name
     *
     * @return string
     */
    public function layout() : string
    {
        return $this->get('acf_fc_layout');
    }
}
