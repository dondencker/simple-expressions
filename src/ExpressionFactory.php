<?php namespace Dencker\SimpleExpressions;

use Dencker\SimpleExpressions\Expressions\AbstractExpression;
use Dencker\SimpleExpressions\Expressions\ExpressionContract;

class ExpressionFactory
{

    protected static $global_expression_stack = [];
    protected $local_expression_stack = [];

    public function solve($context)
    {
        if ( !$context instanceof Context )
        {
            $context = new Context( $context );
        }

        /** @var AbstractExpression $exp */
        foreach (array_merge( $this->local_expression_stack, self::$global_expression_stack ) as $exp)
        {
            $exp->interpret( $context );
        }

        return $context->solve();

    }

    public function extend($expressions)
    {
        if ( !is_array( $expressions ) )
        {
            $expressions = [$expressions];
        }

        foreach ($expressions as $expression)
        {
            if ( !$expression instanceof ExpressionContract )
            {
                throw new \Exception( 'Expression must implement Dencker\SimpleExpressions\Expressions\ExpressionContract' );
            }

            $this->local_expression_stack[] = $expression;
        }
    }

    public static function extendSingleton($expressions)
    {
        if ( !is_array( $expressions ) )
        {
            $expressions = [$expressions];
        }

        foreach ($expressions as $expression)
        {
            if ( !$expression instanceof ExpressionContract )
            {
                throw new \Exception( 'Expression must implement Dencker\SimpleExpressions\Expressions\ExpressionContract' );
            }
            self::$global_expression_stack[] = $expression;
        }
    }

    public function clearExpressionStack()
    {
        self::$global_expression_stack = [];
    }
}
