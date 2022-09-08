<?php

namespace HtmlToProseMirror\Nodes;

use DOMNode;

class Paragraph extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'p'
            || $this->DOMNode->nodeName === 'figcaption';
    }

    public function data()
    {
        if (empty(trim($this->DOMNode->textContent))) {
            return null;
        }

        if ($this->DOMNode->nodeName === 'figcaption') {
            if ($this->hasChildParagraphNode($this->DOMNode)) {
                return null;
            }
        }

        return [
            'type' => 'paragraph',
        ];
    }

    protected function hasChildParagraphNode(DOMNode $node): bool
    {
        if (!$node->hasChildNodes()) {
            return $node->nodeName === 'p';
        }

        foreach ($node->childNodes as $child) {
            if ($this->hasChildParagraphNode($child)) {
                return true;
            }
        }

        return false;
    }
}
