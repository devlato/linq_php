<?php

namespace Qmaker\Linq\Operation;

interface Grouping
{
    /**
     * Groups elements that share a common attribute. Each group is represented by an IGrouping<TKey, TElement> object
     * @param mixed $expression
     * @param callable|null $comparator
     * @return $this
     */
    function groupBy($expression, callable $comparator = null);
}