<?php
namespace Otomaties\AcfObjects\FlexibleContent;

use Otomaties\AcfObjects\Exceptions\InvalidSubFieldException;

class Row
{
    /**
     * Set row
     *
     * @param array<string, mixed> $row The ACF Flexible content row
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
        if (!isset($this->row[$key])) {
            $possibleKeys = array_keys($this->row);
            throw new InvalidSubFieldException(
                sprintf('Sub field %s does not exist. Possible keys are: %s', $key, implode(', ', $possibleKeys))
            );
        }
        return $this->row[$key];
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
