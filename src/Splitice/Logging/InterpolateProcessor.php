<?php
namespace Splitice\Logging;


class InterpolateProcessor
{
	/**
	 * Interpolate
	 *
	 * From PSR-3 doc
	 *
	 * @param $message
	 * @param array $context
	 * @return string
	 */
	protected function interpolate($message, array $context = array())
	{
		$from = $to = array();

		foreach ($context as $key => $val) {
			if (is_string($val)) {
				$from[] = '{' . $key . '}';
				$to[] = $val;
			}
		}

		return str_replace ($from, $to, $message);
	}

	function __invoke(array $record)
	{
		$record['message'] = $this->interpolate($record['message'], $record);
		return $record;
	}
}