<?php namespace Dencker\SimpleExpressions;

use Dencker\SimpleExpressions\Expressions\AbstractExpression;

class ExpressionFactory
{

    protected static $expression_stack = [];

    public function solve($context)
    {
        $context = new Context( $context );

        /** @var AbstractExpression $exp */
        foreach (self::$expression_stack as $exp)
        {
            $exp->interpret( $context );
        }

        return $context->solve();

    }

    public static function extend($expressions)
    {
        if ( !is_array( $expressions ) )
        {
            $expressions = [$expressions];
        }

        foreach ($expressions as $expression)
        {
            if ( !$expression instanceof AbstractExpression )
            {
                throw new \Exception( 'Expression must extend AbstractExpression' );
            }
            self::$expression_stack[] = $expression;
        }
    }
}