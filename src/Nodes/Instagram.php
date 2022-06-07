<?php

namespace HtmlToProseMirror\Nodes;

class Instagram extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'blockquote' &&
               str_contains($this->DOMNode->getAttribute('class'), 'instagram-media') &&
               str_contains($this->DOMNode->getAttribute('data-instgrm-permalink'), 'instagram.com');
    }

    public function data()
    {
        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        return [
            'type' => 'resource',
            'attrs' => [
                'type' => 'embed',
                'url' => $this->DOMNode->getAttribute('data-instgrm-permalink'),
            ],
        ];
    }
}
