<?php

namespace IceTea\Console;

use IceTea\Console\Intro\AvailableCommand;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class Intro
{

    private $show;


    public function buildContext()
    {
        $this->show  = $this->frameworkVersion();
        $this->show .= PHP_EOL.$this->usageInfo();
        $this->show .= PHP_EOL.$this->optionInfo();
        $this->show .= PHP_EOL.$this->avaiableCommand();

    }//end buildContext()


    public function show()
    {
        print $this->show;

    }//end show()


    private function frameworkVersion()
    {
        return 'IceTea Framework '.Color::clr(ICETEA_VERSION, 'green').PHP_EOL;

    }//end frameworkVersion()


    private function usageInfo()
    {
        return Color::clr('Usage:', 'brown').PHP_EOL.'  command [options] [arguments]'.PHP_EOL;

    }//end usageInfo()


    private function optionInfo()
    {
        return Color::clr('Options:', 'brown').PHP_EOL.'  '.Color::clr('-h, --help', 'green').'            Display this help message
  '.Color::clr('-q, --quiet', 'green').'           Do not output any message
  '.Color::clr('-V, --version', 'green').'         Display this application version
      '.Color::clr('--ansi', 'green').'            Force ANSI output
      '.Color::clr('--no-ansi', 'green').'         Disable ANSI output
  '.Color::clr('-n, --no-interaction', 'green').'  Do not ask any interactive question
      '.Color::clr('--env[=ENV]', 'green').'       The environment the command should run under
  '.Color::clr('-v|vv|vvv, --verbose', 'green').'  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug'.PHP_EOL;

    }//end optionInfo()


    private function avaiableCommand()
    {
        $st = new AvailableCommand();
        $st->buildContext();
        return $st;

    }//end avaiableCommand()
}//end class
