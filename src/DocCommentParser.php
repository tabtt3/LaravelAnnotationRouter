<?php

namespace Tabtt\Sample;

class DocCommentParser
{
    private $comment;

    public function __construct(string $comment)
    {
        $this->comment = $comment;
    }

    public function parse(): array
    {
        preg_match_all(
            '/@[a-z][A-Z]* [a-z][A-Z]*/iu',
            //'/@[a-z][A-Z]* [a-z][A-Z]*$/iu',
            $this->comment,
            $match
        );

        return array_map(function($line) {
            $foo = explode(' ', $line);

            return [
                trim($foo[0], '@') => $foo[1]
            ];
        }, $match[0]);
    }
}
