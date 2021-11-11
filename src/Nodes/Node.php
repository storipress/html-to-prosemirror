<?php

namespace HtmlToProseMirror\Nodes;

use DOMNode;

class Node
{
    public $wrapper = null;

    public $type = 'node';

    protected DOMNode $DOMNode;

    public function __construct(DOMNode $DOMNode)
    {
        $this->DOMNode = $DOMNode;
    }

    public function matching()
    {
        return false;
    }

    public function data()
    {
        return [];
    }
}
