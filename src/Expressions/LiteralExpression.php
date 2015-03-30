<?php namespace Dencker\SimpleExpressions\Expressions;

class LiteralExpression extends AbstractExpression{

    protected function regex()
    {
        return '/(["\'])(.*?)(\1)/';
    }

    public function evaluate(Context $context)
    {
        return strval($this->matches[1]);
    }

}