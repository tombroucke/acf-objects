<?php
namespace Otomaties\AcfObjects;

use DateTime;
use Otomaties\AcfObjects\Abstracts\Field;

class DatePicker extends Field
{
    private bool|DateTime $date;

     /**
     * Construct datepicker object
     *
     * @param mixed $value The field's raw value
     * @param mixed $postId The field's post ID. Zero when field is not for a post
     * @param array<string, mixed> $field The default ACF Field array
     */
    public function __construct(protected mixed $value, protected mixed $postId = 0, protected array $field = [])
    {
        $date = DateTime::createFromFormat($field['display_format'], $value);
        
        $this->date = $date;
    }

    public function format(string $format = 'd/m/Y') : string
    {
        if (!$this->date instanceof DateTime) {
            throw new \Exception(sprintf('Call to a member function format() on %s', gettype($this->date)));
        }
        return $this->date->format($format);
    }

    public function getTimestamp() : int
    {
        if (!$this->date instanceof DateTime) {
            throw new \Exception(sprintf('Call to a member function getTimestamp() on %s', gettype($this->date)));
        }
        return $this->date->getTimestamp();
    }

    public function dateTime() : bool|DateTime
    {
        return $this->date;
    }

    public function __toString() : string
    {
        return date_i18n(get_option('date_format'), $this->getTimestamp());
    }
}
