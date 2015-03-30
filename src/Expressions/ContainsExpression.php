<?php namespace Dencker\SimpleExpressions\Expressions;

use Dencker\SimpleExpressions\Context;

class ContainsExpression extends AbstractExpression
{

    protected function regex()
    {
        return '/([a-z0-9A-Z-_.]+) +(?:contains) +([a-z0-9A-Z-_.]+)/';
    }

    public function evaluate(Context $context)
    {
        list($left, $right) = $this->matches;

        $left  = $context->getExpression( $left )->evaluate( $context );
        $right = $context->getExpression( $right )->evaluate( $context );

        return strpos( $left, $right ) > -1;
    }
}