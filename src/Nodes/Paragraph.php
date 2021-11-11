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
        if (empty(trim($this->DOMNode->nodeValue))) {
            return null;
        }

        return [
            'type' => 'paragraph',
        ];
    }
}
