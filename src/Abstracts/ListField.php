<?php
namespace Otomaties\AcfObjects\Abstracts;

use Otomaties\AcfObjects\Repeater\Row;

/**
 * A Listfield is a field which behaves like an array
 */
abstract class ListField extends Field implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * Get field value
     *
     * @return array<string, mixed>
     */
    public function value() : array
    {
        return is_array($this->value) ? $this->value : [];
    }

    /**
     * Whether or not an offset exists.
     *
     * @param mixed $offset An offset to check for.
     * @return boolean
     */
    public function offsetExists($offset) : bool
    {
        return isset($this->value[$offset]);
    }

    /**
     * Returns the value at specified offset.
     *
     * @param mixed $offset The offset to retrieve.
     * @return mixed
     */
    abstract public function offsetGet(mixed $offset) : mixed;

    /**
     * Assigns a value to the specified offset.
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     * @return void
     */
    public function offsetSet($offset, $value) : void
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
    public function offsetUnset($offset) : void
    {
        unset($this->value[$offset]);
    }

    /**
     * Rewinds back to the first element of the Iterator.
     *
     * @return void
     */
    public function rewind() : void
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
    public function key() : mixed
    {
        return key($this->value);
    }

    /**
     * Returns the current element.
     *
     * @return mixed
     */
    abstract public function current() : mixed;

    /**
     * Moves the current position to the next element.
     *
     * @return void
     */
    public function next() : void
    {
        next($this->value);
    }

    /**
     * This method is called after Iterator::rewind() and Iterator::next() to check if the current position is valid.
     *
     * @return boolean
     */
    public function valid() : bool
    {
        $value = false;
        if (! empty($this->value())) {
            $key   = key($this->value);
            $value = ( $key !== null && $key !== false );
        }
        return $value;
    }

    /**
     * @deprecated
     * Check if field is empty
     *
     * @deprecated deprecated since version 2.0.5
     * @return boolean
     */
    public function is_empty() : bool // phpcs:ignore
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use isEmpty() instead.', E_USER_DEPRECATED);
        return $this->isEmpty();
    }

    /**
     * Count elements of an object
     *
     * @return int The element count
     */
    public function count() : int
    {
        return count($this->value());
    }

    /**
     * Filter the list
     *
     * @param callable $filterFunction
     * @return static
     */
    public function filter(callable $filterFunction) : static
    {
        foreach ($this->value as $key => $item) {
            if (!$filterFunction(new Row($item))) {
                unset($this->value[$key]);
            }
        }
        return new static($this->value);
    }

    /**
     * Map the list
     *
     * @param callable $mapFunction
     * @return static
     */
    public function map(callable $mapFunction) : static
    {
        foreach ($this->value as $key => $item) {
            $this->value[$key] = $mapFunction(new Row($item))->value();
        }
        return new static($this->value);
    }
}
