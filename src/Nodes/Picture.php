<?php

namespace HtmlToProseMirror\Nodes;

class Picture extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'figure'
            && count($this->DOMNode->getElementsByTagName('picture')) > 0
            && str_contains(
                $this->DOMNode->getAttribute('class'),
                'image'
            );
    }

    public function data()
    {
        $img = $this->DOMNode->getElementsByTagName('img');

        if (empty($img)) {
            return null;
        }

        $img = $img[0];

        $figcaption = $this->DOMNode->getElementsByTagName('figcaption');

        $figcaption = empty($figcaption) ? null : $figcaption[0];

        if ($figcaption) {
            $html = $figcaption->ownerDocument->saveHTML($figcaption);

            $figcaption = str_replace(
                ['<figcaption>', '</figcaption>'],
                ['<p>', '</p>'],
                $html
            );
        }

        if ($this->DOMNode->hasChildNodes()) {
            foreach ($this->DOMNode->childNodes as $node) {
                $this->DOMNode->removeChild($node);
            }
        }

        return [
            'type' => 'image',
            'attrs' => [
                'alt' => $img->getAttribute('alt') ?: null,
                'src' => $img->getAttribute('src') ?: null,
                'title' => $figcaption ?: $img->getAttribute('title') ?: null,
            ],
        ];
    }
}
