<?php

namespace HtmlToProseMirror\Nodes;

class TableHeader extends TableCell
{
    protected $tagName = 'th';
    protected $nodeType = 'tableHeader';
}
