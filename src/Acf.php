<?php
namespace Otomaties\AcfObjects;

class Acf
{

    public static function get_field($selector, $post_id = false, $format_value = true)
    {
        $post_id = acf_get_valid_post_id($post_id);
        $field = acf_maybe_get_field($selector, $post_id);

        if (! $field) {
            $field = acf_get_valid_field(
                array(
                    'name' => $selector,
                    'key'  => '',
                    'type' => '',
                )
            );
            $format_value = false;
        }

        $field['return_object'] = true;
        $field = self::recursive_add_return_object($field);

        $value = acf_get_value($post_id, $field);
        if ($format_value) {
            $value = acf_format_value($value, $post_id, $field);
        }

        if (! $value) {
            $field = acf_get_field($selector);
            if ($field) {
                $field['return_object'] = true;
                $value = self::findClassByFieldType($value, $post_id, $field);
            } else {
                throw new \Exception(sprintf('Field with key %s not found', $selector), 1);
            }
        }

        return $value;
    }

    public static function recursive_add_return_object($array)
    {
        $array_iterator     = new \RecursiveArrayIterator($array);
        $recursive_iterator = new \RecursiveIteratorIterator($array_iterator, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($recursive_iterator as $key => $value) {
            if (is_array($value) && isset($value['key'])) {
                $value['return_object'] = true;

                $current_depth = $recursive_iterator->getDepth();
                for ($sub_depth = $current_depth; $sub_depth >= 0; $sub_depth--) {
                    $sub_iterator = $recursive_iterator->getSubIterator($sub_depth);
                    $sub_iterator->offsetSet($sub_iterator->key(), ( $sub_depth === $current_depth ? $value : $recursive_iterator->getSubIterator(( $sub_depth + 1 ))->getArrayCopy() ));
                }
            }
        }
        return $recursive_iterator->getArrayCopy();
    }

    public static function findClassByFieldType($value, $post_id, $field)
    {
        $type = $field['type'];
        $type = str_replace('_', ' ', $type);
        $type = ucwords($type);
        $type = str_replace(' ', '', $type);
        $class = '\\Otomaties\\AcfObjects\\' . $type;
        if (class_exists($class) && isset($field['return_object']) && $field['return_object'] === true) {
            $value = new $class($value, $post_id, $field);
        }
        return $value;
    }
}
