<?php

namespace Laramate\StructuredDocument\Models\Traits;

trait ModelArrayAccess
{
    public function offsetExists($offset): bool 
    {
        return true;
    }

    public function offsetGet($offset) 
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value): void 
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset): void 
    {
        $this->$offset = null;
    }
}
