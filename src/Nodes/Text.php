<?php

namespace HtmlToProseMirror\Nodes;

class Text extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === '#text';
    }

    public function data()
    {
        $text = trim($this->DOMNode->nodeValue, "\n");

        if ($text === '') {
            return null;
        }

        $passes = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'td'];

        $node = $this->DOMNode->parentNode;

        while (
            !in_array($node->nodeName, $passes, true) &&
            $node = $node->parentNode
        );

        $text = [
            'type' => 'text',
            'text' => $text,
        ];

        if ($node) {
            return $text;
        }

        return [
            'type'    => 'paragraph',
            'content' => [$text],
        ];
    }
}
