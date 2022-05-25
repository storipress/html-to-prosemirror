<?php

namespace HtmlToProseMirror\Nodes;

class Ignore extends Node
{
    public function matching()
    {
        return $this->theNewsletterPlugin();
    }

    protected function theNewsletterPlugin()
    {
        return $this->DOMNode->nodeName === 'div'
               && str_contains(
                   $this->DOMNode->getAttribute('class'),
                   'wp-block-tnp-minimal'
               );
    }

    public function data()
    {
        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        return null;
    }
}
