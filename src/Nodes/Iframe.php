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
        if (!$this->DOMNode->hasAttribute('src')) {
            return null;
        }

        return [
            'type' => 'resource',
            'attrs' => [
                'type' => 'embed',
                'url' => $this->DOMNode->getAttribute('src'),
            ],
        ];
    }
}
