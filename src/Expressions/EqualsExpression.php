<?php namespace Dencker\SimpleExpressions\Expressions;

class EqualsExpression extends  AbstractExpression{

    protected function regex()
    {
        return '/([a-z0-9A-Z-_.]+) +(?:is|equals|==) +([a-z0-9A-Z-_.]+)/';
    }

    public function evaluate(Context $context)
    {
        list($left, $right) = $this->matches;

        $left = $context->getExpression($left)->evaluate($context);
        $right = $context->getExpression($right)->evaluate($context);

        return $left == $right;
    }
}