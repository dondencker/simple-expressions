<?php namespace Dencker\SimpleExpressions\Expressions;

class AndExpression extends AbstractExpression
{

    protected function regex()
    {
        return '/\(?([a-zA-Z0-9-_ ]+)\)? and \(?([a-zA-Z0-9-_ ]+)\)?/';
    }

    public function evaluate(Context $context)
    {
        list($left, $right) = $this->matches;

        $left  = $context->getExpression( trim( $left ) )
                         ->evaluate( $context );

        $right = $context->getExpression( trim( $right ) )
                         ->evaluate( $context );

        return $left && $right;
    }
}