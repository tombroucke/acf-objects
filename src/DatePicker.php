<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class DatePicker extends Field
{

    private $date;

    public function __construct($value, $post_id = 0, array $field = array())
    {
        $this->date = \DateTime::createFromFormat($field['display_format'], $value);
        parent::__construct($value, $post_id, $field);
    }

    public function format(string $format = 'd/m/Y') : string
    {
        return $this->date->format($format);
    }

    public function getTimestamp() {
        return $this->date->getTimestamp();
    }

    public function dateTime() {
        return $this->date;
    }
}
