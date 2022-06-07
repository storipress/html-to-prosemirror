<?php

namespace HtmlToProseMirror\Nodes;

class HardBreak extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'br';
    }

    public function data()
    {
        $node = $this->DOMNode->parentNode;

        while (
            $node->nodeName !== 'p' &&
            $node = $node->parentNode
        );

        if (!$node) {
            return null;
        }

        if (empty(trim($node->nodeValue))) {
            return null;
        }

        return [
            'type' => 'hardBreak',
        ];
    }
}
