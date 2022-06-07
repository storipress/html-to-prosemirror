<?php

namespace HtmlToProseMirror\Nodes;

class GettyImages extends Node
{
    public function matching()
    {
        $node = $this->DOMNode;

        if ($this->DOMNode->nodeName === 'p') {
            $a = $this->DOMNode->getElementsByTagName('a');

            if ($a->length !== 1) {
                return false;
            }

            $node = $a[0];
        }

        if ($node->nodeName !== 'a') {
            return false;
        }

        $href = $node->getAttribute('href');

        if (!str_contains($href, 'gettyimages.com')) {
            return false;
        }

        $class = $node->getAttribute('class');

        return str_contains($class, 'gie-slideshow') ||
               str_contains($class, 'gie-single');
    }

    public function data()
    {
        $node = $this->DOMNode;

        if ($this->DOMNode->nodeName !== 'a') {
            $node = $this->DOMNode->getElementsByTagName('a')[0];
        }

        $data = [
            'type' => 'resource',
            'attrs' => [
                'type' => 'embed',
                'url' => $node->getAttribute('href'),
            ],
        ];

        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        return $data;
    }
}
