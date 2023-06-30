<?php
declare(strict_types = 1);


namespace Toolkit\Exception;

use Cake\Error\FatalErrorException;
use Cake\Utility\Text;
use Throwable;

class ApexChartWrongOptionException extends FatalErrorException
{

    /**
     * ApexChartWrongOptionException constructor.
     *
     * @param string|null $option
     * @param string|null $passed
     * @param array $valid
     * @param int|null $code
     * @param string|null $file
     * @param int|null $line
     * @param \Throwable|null $previous
     */
    public function __construct(string $option = null, string $passed = null, array $valid = [], ?int $code = null, ?string $file = null, ?int $line = null, ?Throwable $previous = null)
    {
        if (empty($option)) {
            $message = 'Some option is wrong!';
        } elseif (!empty($passed)) {
            $message = sprintf('Option "%s" with passed value "%s" is wrong.', $option, $passed);
        } else {
            $message = sprintf('Option "%s" is wrong.', $option);
        }
        if (!empty($valid)) {
            foreach ($valid as $key => $value) {
                $valid[$key] = "\"$value\"";
            }
            $message .= ' ' . sprintf("Valid options are: %s.", Text::toList($valid, 'and'));
        }
        parent::__construct($message, $code, $file, $line, $previous);
    }
}