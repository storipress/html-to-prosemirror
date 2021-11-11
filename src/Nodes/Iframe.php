<?php

namespace HtmlToProseMirror\Nodes;

class Iframe extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'iframe';
    }

    public function data()
    {
        return [
            'type' => 'resource',
            'attrs' => [
                'type' => 'embed',
                'url' => $this->DOMNode->hasAttribute('src') ? $this->DOMNode->getAttribute('src') : null,
            ],
        ];
    }
}
