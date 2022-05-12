<?php
namespace Otomaties\AcfObjects;

class Acf
{
    /**
     * Try to replace ACF's default field array by a custom object
     *
     * @param $selector string the field name or key
     * @param $postId mixed the post_id of which the value is saved against
     * @param $formatValue boolean whether or not to format the value as described above
     * @return (mixed)
     */
    public static function get_field(string $selector, mixed $postId = false, bool $formatValue = true) : mixed // phpcs:ignore
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use getField() instead.', E_USER_DEPRECATED);
        return self::getField($selector, $postId, $formatValue);
    }

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
            $value = acf_format_value($value, $postId, $field);
        }

        if (! $value) {
            $field = acf_get_field($selector);
            if ($field) {
                $field['return_object'] = true;
                $value = self::findClassByFieldType($value, $postId, $field);
            } else {
                throw new \Exception(sprintf('Field with key %s not found', $selector), 1);
            }
        }

        return $value;
    }

    /**
     * Add ['return_object'] to each child
     *
     * @param array $array
     * @return array The array with added return_object keys
     */
    public static function recursiveAddReturnObject(array $array)
    {
        $arrayIterator     = new \RecursiveArrayIterator($array);
        $recursiveIterator = new \RecursiveIteratorIterator($arrayIterator, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($recursiveIterator as $key => $value) {
            if (is_array($value) && isset($value['key'])) {
                $value['return_object'] = true;

                $currentDepth = $recursiveIterator->getDepth();
                for ($subDepth = $currentDepth; $subDepth >= 0; $subDepth--) {
                    $subIterator = $recursiveIterator->getSubIterator($subDepth);
                    $subIterator->offsetSet(
                        $subIterator->key(),
                        ($subDepth === $currentDepth ?
                            $value :
                            $recursiveIterator->getSubIterator(($subDepth + 1))->getArrayCopy())
                    );
                }
            }
        }
        return $recursiveIterator->getArrayCopy();
    }

    /**
     * Find class for field
     *
     * @param mixed $value
     * @param int|boolean $postId
     * @param array $field
     * @return mixed
     */
    public static function findClassByFieldType(mixed $value, int|string $postId, array $field)
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
