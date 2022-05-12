<?php
namespace Otomaties\AcfObjects;

use DateTime;
use Otomaties\AcfObjects\Abstracts\Field;

class DatePicker extends Field
{
    private $date;

    public function __construct(protected mixed $value, protected mixed $postId = 0, protected array $field = [])
    {
        $this->date = DateTime::createFromFormat($field['display_format'], $value);
    }

    public function format(string $format = 'd/m/Y') : string
    {
        return $this->date->format($format);
    }

    public function getTimestamp() : int
    {
        return $this->date->getTimestamp();
    }

    public function dateTime() : DateTime
    {
        return $this->date;
    }
}
