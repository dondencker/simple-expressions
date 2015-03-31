<?php

    namespace spec\Dencker\SimpleExpressions;

    use Dencker\SimpleExpressions\Context;
    use Dencker\SimpleExpressions\Expressions\ExpressionContract;
    use PhpSpec\ObjectBehavior;
    use Prophecy\Argument;

    class ExpressionFactorySpec extends ObjectBehavior
    {
        function it_is_initializable()
        {
            $this->shouldHaveType( 'Dencker\SimpleExpressions\ExpressionFactory' );
        }

        function it_registers_an_expression_to_be_evaluated_with_every_factory(ExpressionContract $expression)
        {
            self::extendSingleton( $expression )->shouldReturn( null );
        }


        function it_fails_to_register_an_expression_to_be_evaluated_with_every_factory_if_it_does_not_implement_expression_contract()
        {
            self::shouldThrow( new \Exception( 'Expression must implement Dencker\SimpleExpressions\Expressions\ExpressionContract' ) )
                ->during( 'extendSingleton', [new \stdClass] );
        }

        function it_registers_an_array_of_expressions_to_be_evaluated_with_every_factory(ExpressionContract $expression_a, ExpressionContract $expression_b)
        {
            self::extendSingleton( [
                $expression_a,
                $expression_b
            ] )->shouldReturn( null );
        }

        function it_registers_an_expression_to_be_evaluated_with_the_instance_only(ExpressionContract $expression)
        {
            $this->extend( $expression )->shouldReturn( null );
        }

        function it_calls_both_singleton_and_instance_expressions_when_solving_an_expression(ExpressionContract $global, ExpressionContract $local, Context $context)
        {
            self::extendSingleton( $global );
            $this->extend( $local );

            $global->interpret( $context )->shouldBeCalled();
            $local->interpret( $context )->shouldBeCalled();

            $this->solve( $context );
        }

        function letGo()
        {
            /*
             * After each test, forget the singleton expression stack
             */
            self::clearExpressionStack();
        }
    }
