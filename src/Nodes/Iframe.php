<?php

namespace HtmlToProseMirror\Nodes;

class Iframe extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'iframe'
               || ($this->DOMNode->nodeName === 'figure' && str_contains($this->DOMNode->getAttribute('class'), 'wp-block-embed'));
    }

    public function data()
    {
        $url = null;

        if ($this->DOMNode->nodeName === 'iframe') {
            $url = $this->DOMNode->getAttribute('src');
        } else if ($this->DOMNode->nodeName === 'figure') {
            $url = trim($this->DOMNode->textContent);

            while ($this->DOMNode->hasChildNodes()) {
                $this->DOMNode->removeChild($this->DOMNode->firstChild);
            }
        }

        if (empty($url)) {
            return null;
        }

        return [
            'type' => 'resource',
            'attrs' => [
                'type' => 'embed',
                'url' => $url,
            ],
        ];
    }
}
