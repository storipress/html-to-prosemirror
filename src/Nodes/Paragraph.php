<?php

namespace HtmlToProseMirror\Nodes;

class Paragraph extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'p'
            || $this->DOMNode->nodeName === 'figcaption';
    }

    public function data()
    {
        return [
            'type' => 'paragraph',
        ];
    }
}
