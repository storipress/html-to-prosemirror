<?php

namespace HtmlToProseMirror\Nodes;

class Bookmark extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'div'
            && str_contains(
                $this->DOMNode->getAttribute('class'),
                'bookmark-container'
            );
    }

    public function data()
    {
        $node = $this->DOMNode->getElementsByTagName('a');

        if (empty($node) || !$node[0]->hasAttribute('href')) {
            return null;
        }

        return [
            'type' => 'resource',
            'attrs' => [
                'type' => 'bookmark',
                'url' => $node[0]->getAttribute('href'),
            ],
        ];
    }
}
