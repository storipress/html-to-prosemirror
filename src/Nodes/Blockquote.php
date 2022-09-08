<?php

namespace HtmlToProseMirror\Nodes;

class Blockquote extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'blockquote';
    }

    public function data()
    {
        $this->DOMNode->textContent = trim(
            $this->DOMNode->textContent,
            " “”<>\"\n\r\t\v\x00",
        );

        return [
            'type' => 'blockquote',
        ];
    }
}
