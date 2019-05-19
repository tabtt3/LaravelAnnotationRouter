<?php

namespace Tabtt\Sample;

class DocComment
{
    private $methodName;
    private $docComments;

    public function __construct(
        string $methodName,
        array $docComments
    )
    {
        $this->methodName = $methodName;
        $this->docComments = $docComments;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function hasComment(string $annotate): bool
    {
        foreach ($this->docComments as $comment) {
        }

        dd($this->docComments);
        return array_key_exists($annotate, $this->docComments);
    }

    public function getComments(): array
    {
        return array_values($this->docComments);
    }

    public function getComment(string $annotate): string
    {
        return $this->docComments[$annotate];
    }
}
