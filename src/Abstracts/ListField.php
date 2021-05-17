<?php
namespace Otomaties\AcfObjects\Abstracts;

/**
 * A Listfield is a field which behaves like an array
 */
abstract class ListField extends Field implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * Get field value
     *
     * @return array
     */
    public function value()
    {
        if (is_array($this->value)) {
            return $this->value;
        }
        return array();
    }

    /**
     * Whether or not an offset exists.
     *
     * @param mixed $offset An offset to check for.
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->value[$offset]);
    }

    /**
     * Returns the value at specified offset.
     *
     * @param [type] $offset The offset to retrieve.
     * @return mixed
     */
    abstract public function offsetGet($offset);

    /**
     * Assigns a value to the specified offset.
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->value[] = $value;
        } else {
            $this->value[$offset] = $value;
        }
    }

    /**
     * Unsets an offset.
     *
     * @param mixed $offset The offset to unset.
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->value[$offset]);
    }

    /**
     * Rewinds back to the first element of the Iterator.
     *
     * @return void
     */
    public function rewind()
    {
        if (!empty($this->value())) {
            reset($this->value);
        }
    }

    /**
     * Returns the key of the current element.
     *
     * @return mixed
     */
    public function key()
    {
        $value = key($this->value);
        return $value;
    }

    /**
     * Returns the current element.
     *
     * @return mixed
     */
    abstract public function current();

    /**
     * Moves the current position to the next element.
     *
     * @return void
     */
    public function next()
    {
        next($this->value);
    }

    /**
     * This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.
     *
     * @return boolean
     */
    public function valid()
    {
        $value = null;
        if (! empty($this->value())) {
            $key   = key($this->value);
            $value = ( $key !== null && $key !== false );
        }
        return $value;
    }

    /**
     * Check if field is empty
     *
     * @deprecated deprecated since version 2.0.5
     * @return boolean
     */
    public function is_empty()
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use empty() instead.', E_USER_DEPRECATED);
        return $this->empty();
    }

    /**
     * Count elements of an object
     *
     * @return int The element count
     */
    public function count()
    {
        return count($this->value);
    }
}
