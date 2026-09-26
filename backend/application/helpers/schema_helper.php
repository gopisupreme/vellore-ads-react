<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('render_json_ld'))
{
	/**
	 * Prints the structured-data (JSON-LD) value stored in category.c_schema safely.
	 *
	 * - empty value                     -> prints nothing
	 * - value that already has <script> -> printed as it is (complete block saved by the admin)
	 * - bare / cut-off JSON fragment    -> repaired (missing "{", quotes and closing brackets) and wrapped in
	 *                                      <script type="application/ld+json">; if it still is not valid JSON
	 *                                      nothing is printed, so raw JSON never shows up as text on the page.
	 */
	function render_json_ld($raw)
	{
		$raw = trim((string) $raw);

		if ($raw === '')
		{
			return '';
		}

		if (stripos($raw, '<script') !== FALSE)
		{
			return $raw;
		}

		$json = ltrim($raw);
		if ($json[0] !== '{')
		{
			$json = '{' . $json;
		}

		// walk the text once to find what is still open at the end (a string, objects, arrays)
		$stack = array();
		$in_string = FALSE;
		$escaped = FALSE;
		$length = strlen($json);

		for ($i = 0; $i < $length; $i++)
		{
			$c = $json[$i];

			if ($in_string)
			{
				if ($escaped) { $escaped = FALSE; }
				elseif ($c === '\\') { $escaped = TRUE; }
				elseif ($c === '"') { $in_string = FALSE; }
				continue;
			}

			if ($c === '"') { $in_string = TRUE; }
			elseif ($c === '{') { $stack[] = '}'; }
			elseif ($c === '[') { $stack[] = ']'; }
			elseif ($c === '}' || $c === ']') { array_pop($stack); }
		}

		if ($in_string)
		{
			$json .= '"';
		}

		$json = rtrim($json);
		if (substr($json, -1) === ',')
		{
			$json = substr($json, 0, -1);
		}

		$json .= implode('', array_reverse($stack));

		$data = json_decode($json, TRUE);
		if ( ! is_array($data))
		{
			return '';
		}

		// default json_encode flags escape "/" as "\/", so "</script>" cannot appear inside the block
		return '<script type="application/ld+json">' . json_encode($data, JSON_UNESCAPED_UNICODE) . '</script>';
	}
}
