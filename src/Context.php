<?php namespace Dencker\SimpleExpressions;

use Dencker\SimpleExpressions\Expressions\AbstractExpression;

class Context
{

    protected $input;
    protected $output;
    protected $expressions;

    function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param mixed $input
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param mixed $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function addExpression(AbstractExpression $expression)
    {
        $id = "__EXP_" . substr(md5(uniqid().microtime()),0,6) . "__";

        $this->expressions[$id] = $expression;

        return $id;
    }

    public function solve()
    {
        return $this->getExpression(trim($this->getInput()))->evaluate($this);
    }

    /**
     * @param $identifier
     *
     * @return AbstractExpression
     */
    public function getExpression($identifier)
    {
        return $this->expressions[$identifier];
    }


}