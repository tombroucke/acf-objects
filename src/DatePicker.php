<?php
namespace Otomaties\AcfObjects;

use DateTime;
use Otomaties\AcfObjects\Abstracts\Field;

class DatePicker extends Field
{
    private DateTime $date;

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

        if (!$date) {
            throw new \Exception(sprintf('Invalid input value for datepicker: %s', $value));
        }
        
        $this->date = $date;
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
