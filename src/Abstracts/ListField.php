<?php
namespace Otomaties\AcfObjects\Abstracts;

abstract class ListField extends Field implements \ArrayAccess, \Iterator, \Countable
{

    public function offsetExists($offset)
    {
        return isset($this->value[ $offset ]);
    }

    abstract public function offsetGet($offset);

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->value[] = $value;
        } else {
            $this->value[ $offset ] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->value[ $offset ]);
    }

    public function rewind()
    {
        if (! empty($this->value())) {
            reset($this->value);
        }
    }

    public function key()
    {
        $value = key($this->value);
        return $value;
    }

    abstract public function current();

    public function next()
    {
        $value = next($this->value);
        return $value;
    }

    public function valid()
    {
        $value = null;
        if (! empty($this->value())) {
            $key   = key($this->value);
            $value = ( $key !== null && $key !== false );
        }
        return $value;
    }

    public function is_empty()
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated. Use empty() instead.', E_USER_DEPRECATED);
        return $this->empty();
    }

    public function count()
    {
        return count($this->value);
    }
}
