<?php
 
/**
* check if the coverage of phpunit is above specified threshold
*/
 
if ($argc != 3) {
    echo "Usage: " . $argv[0] . " <path/to/PHP_CodeCoverage object to file> <threshold>".PHP_EOL;
    exit(-1);
}
 
$file = $argv[1];
$threshold = (double) $argv[2];
$ratio = ratio($file);
echo "Line coverage: $ratio%".PHP_EOL;
 
if ($ratio < $threshold) {
    echo "Minimum coverage threshold ($threshold%) not reached".PHP_EOL;
    exit(-1);
}
 
 
function ratio(string $file): ?float
{
    $summary = file_get_contents($file);
    $regexp = '/Summary:[\s\S]*?Lines:\s+(\d+\.\d+)%\s+\(\d+\/\d+\)/';
    if (preg_match($regexp, $summary, $maches)) {        
        return $maches[1] ?? null;
    }
    return null;
}
