<?php namespace Dencker\SimpleExpressions\Expressions;

use Dencker\SimpleExpressions\Context;

abstract class AbstractExpression
{
    protected $matches;

    public function interpret(Context $context)
    {
        if ( preg_match( $this->regex(), $context->getInput(), $matches ) )
        {
            $full_match    = array_shift( $matches );
            $this->matches = $matches;

            $expression_id = $context->addExpression( clone $this );

            $context->setInput( preg_replace( '/' . preg_quote( $full_match ) . '/', $this->replace( $expression_id ), $context->getInput() ) );

//            d( get_class( $this ) . " was matched ({$full_match}) and is now identified as {$expression_id}. Context is now " . $context->getInput() );

            $this->interpret( $context );
        }
    }

    abstract protected function regex();

    abstract public function evaluate(Context $context);

    /**
     * Decides how to replace the expression.
     *
     * @param $expression_id
     *
     * @return mixed
     */
    protected function replace($expression_id)
    {
        return $expression_id;
    }


}