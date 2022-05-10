<?php

namespace Ozh\PHPUnit\Printer;

use PHPUnit\TextUI\DefaultResultPrinter;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Util\Filter;

class StormPrinter extends DefaultResultPrinter
{

    protected function printDefectTrace(TestFailure $defect): void
    {
        $this->write(($defect->getExceptionAsString()));
        $trace = Filter::getFilteredStacktrace(
            $defect->thrownException()
        );
        if (!empty($trace)) {
            // From:   D:\home\planetozh\ozh.in\tests\tests\install\install.php:14
            // To:     storm --line 14 /d/home/planetozh/ozh.in/tests/tests/install/install.php
            $trace =  str_replace('\\', '/',  $trace);
            // replace 'DRIVE:/' with '/drive/'
            $trace = preg_replace_callback('/^([A-Z]+):/', function ($re) {return '/'.strtolower($re[1]);}, $trace);
            list($file, $line) = explode(':', trim($trace));
            $this->write("\nstorm --line $line $file \n");
        }
        $exception = $defect->thrownException()->getPrevious();
        while ($exception) {
            $this->write(
                "\nCaused by\n" .
                TestFailure::exceptionToString($exception) . "\n" .
                Filter::getFilteredStacktrace($exception)
            );
            $exception = $exception->getPrevious();
        }
    }

}
