<?php

namespace Ello;

class Benchmark
{
    private static function getOp($time, $r)
    {
        // 1 s => 1.000 ms
        // 1 s => 1.000.000 µs
        // 1 s => 1.000.000.000 ns
        return round(($time / $r) * 1000 * 1000 * 1000) . " ns/op";
    }

    public static function run($callback)
    {
        $r = 1;
        $start = microtime(true);
        $i = 0;
        $duration = 0;
        while (microtime(true) - $start < 1) {
            $callback();

            if ($i++ == $r) {
                $r = $r * 10;
                $duration = microtime(true) - $start;
            }
        }

        echo "\t" . $r . "\t" . self::getOp($duration, $r) . "\t" . round($duration, 3) . "s" .
            "\t" . (memory_get_peak_usage(true)/1024/1024) . "Mb" . PHP_EOL;
    }
}
