<?php

namespace IceTea\Foundation\Exceptions;

use Exception;
use IceTea\Exceptions\InternalExceptionList;
use IceTea\Exceptions\Handler as InternalExceptionHandler;

class Handler
{

    /**
     * @var array
     */
    protected $dontReport = [];

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var string
     */
    protected $name;


    /**
     * Constructor.
     *
     * @param \Exception $e
     */
    public function __construct(Exception $e)
    {
        $this->exception = $e;
        $this->name      = get_class($this->exception);

    }


    public function report()
    {
        $this->buildReportContext();

        if (! $this->shouldntReport()) {
            throw $this->exception;
        }

        if ($this->isInternalException()) {
            $handler = new InternalExceptionHandler($this->exception);
            $handler->report();
        }

    }


    protected function shouldntReport()
    {
        return in_array($this->name, $this->dontReport);

    }


    protected function buildReportContext()
    {
        $this->dontReport = array_merge(InternalExceptionList::$list, $this->dontReport);

    }


    protected function isInternalException()
    {
        return in_array($this->name, InternalExceptionList::$list);

    }
}
