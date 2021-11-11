<?php

namespace HtmlToProseMirror\Nodes;

class Picture extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'figure'
            && str_contains(
                $this->DOMNode->getAttribute('class'),
                'image'
            )
            && $this->DOMNode->getElementsByTagName('picture')->length > 0
            && $this->DOMNode->getElementsByTagName('img')->length > 0;
    }

    public function data()
    {
        $img = $this->DOMNode->getElementsByTagName('img')->item(0);

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

        $data = [
            'type' => 'image',
            'attrs' => [
                'alt' => $img->getAttribute('alt') ?: null,
                'src' => $img->getAttribute('src') ?: null,
                'title' => $figcaption ?: $img->getAttribute('title') ?: null,
            ],
        ];

        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        return $data;
    }
}
