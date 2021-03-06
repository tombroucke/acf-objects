<?php
namespace Otomaties\AcfObjects\FlexibleContent;

class Row
{
    /**
     * The ACF Flexible content row
     *
     * @var array
     */
    protected $row = [];

    /**
     * Set row
     *
     * @param array $row The ACF Flexible content row
     * @return void
     */
    public function __construct(array $row = [])
    {
        $this->row = $row;
    }

    /**
     * Get row value
     *
     * @param string $key The sub field key
     * @return mixed
     */
    public function get($key)
    {
        return $this->row[ $key ];
    }

    /**
     * Get layout name
     *
     * @return string
     */
    public function layout()
    {
        return $this->get('acf_fc_layout');
    }
}
