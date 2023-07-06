<?php
namespace Otomaties\AcfObjects;

use Otomaties\AcfObjects\Abstracts\Field;

class Acf
{
    /**
     * @deprecated Please use getField() instead
     */
    public static function get_field(string $selector, mixed $postId = false, bool $formatValue = true) : mixed // phpcs:ignore
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use getField() instead.', E_USER_DEPRECATED);
        return self::getField($selector, $postId, $formatValue);
    }

    /**
     * Try to replace ACF's default field array by a custom object
     *
     * @param $selector string the field name or key
     * @param $postId mixed the post_id of which the value is saved against
     * @param $formatValue boolean whether or not to format the value as described above
     * @return (mixed)
     */
    public static function getField(string $selector, mixed $postId = false, bool $formatValue = true) : mixed
    {
        $postId = acf_get_valid_post_id($postId);
        $field = acf_maybe_get_field($selector, $postId);

        if (! $field) {
            $field = acf_get_valid_field(
                array(
                    'name' => $selector,
                    'key'  => '',
                    'type' => '',
                )
            );
            $formatValue = false;
        }

        $field['return_object'] = true;
        $field = self::recursiveAddReturnObject($field);

        $value = acf_get_value($postId, $field);
        
        if ($formatValue) {
            // to be able to use get_field() and Acf::get_field() at the same time, different data store keys are needed
            $field['name'] = $field['name'] . ':acf-object';
            $value = acf_format_value($value, $postId, $field);
        }
        if (! $value) {
            $field = acf_get_field($selector);
            if ($field) {
                $field['return_object'] = true;
                $field = self::recursiveAddReturnObject($field);
                $field['name'] = $field['name'] . ':acf-object';
                $value = acf_format_value($value, $postId, $field);
            } else {
                throw new \Exception(sprintf('Field with key %s not found', $selector), 1);
            }
        }

        return $value;
    }

    /**
     * Add 'return_object' => '1' to each sub_field recursively
     *
     * @param array<string, mixed> $field
     * @return array<string, mixed> The field array with added return_object keys
     */
    public static function recursiveAddReturnObject(array $field) : array
    {
        $subFieldKeys = [
            'sub_fields',
            'layouts',
        ];

        foreach ($subFieldKeys as $subFieldKey) {
            if (isset($field[$subFieldKey]) && is_array($field[$subFieldKey])) {
                foreach ($field[$subFieldKey] as $key => $subField) {
                    $field[$subFieldKey][$key]['return_object'] = true;
                    $field[$subFieldKey][$key] = self::recursiveAddReturnObject($field[$subFieldKey][$key]);
                }
            }
        }

        return $field;
    }

    /**
     * Find class for field
     *
     * @param mixed $value
     * @param integer|string|null $postId
     * @param array<string, mixed> $field
     * @return mixed
     */
    public static function findClassByFieldType(mixed $value, int|string $postId = null, array $field) : mixed
    {
        $type = $field['type'];
        $type = str_replace('_', ' ', $type);
        $type = ucwords($type);
        $type = str_replace(' ', '', $type);
        $class = '\\Otomaties\\AcfObjects\\' . $type;
        if (isset($field['return_object']) && $field['return_object'] === true) {
            if (class_exists($class)) {
                $value = new $class($value, $postId, $field);
            }
        }
        return $value;
    }
}
