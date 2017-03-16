<?php


class Expressor {

    const PATTERN = '/(?:\-?\d+(?:\.?\d+)?[\+\-\*\/\%\^])+\-?\d+(?:\.?\d+)?/';
    const PARENTHESIS_DEPTH = 10;

    public function calculate($input) {
        if (strpos($input, '+') != null ||
            strpos($input, '-') != null ||
            strpos($input, '*') != null ||
            strpos($input, '/') != null ||
            strpos($input, '%') != null ||
            strpos($input, '^') != null) {

            $result = str_replace(',', '.', $input);
            $result = preg_replace('[^0-9\.\+\-\*\/\%\^\(\)]', '', $result);

            $i = 0;

            while (strpos($result, '(') || strpos($result, ')')) {
                $result = preg_replace_callback('/\(([^\(\)]+)\)/', 'self::callback', $result);

                $i++;

                if ($i > self::PARENTHESIS_DEPTH) {
                    break;
                }
            }

            if (preg_match(self::PATTERN, $result, $match)) {
                return $this->compute($match[0]);
            }

            return 'Error parsing expression';

        }

        return $input;

    }

    private function compute($input) {
        $result = str_replace('^', '**', $input);
        $compute = create_function('', 'return '.$result.';');
        return 0 + $compute();
    }

    private function callback($input) {
        if (is_numeric($input[1])) {
            return $input[1];
        } elseif (preg_match(self::PATTERN, $input[1], $match)) {
            return $this->compute($match[0]);
        }

        return 0;
    }

}
