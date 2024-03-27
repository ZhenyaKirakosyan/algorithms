<?php

namespace BinaryTrees;

class Node
{
    public function __construct(public mixed $value, public ?Node $left = null, public ?Node $right = null) { }
}