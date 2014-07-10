<?php

require_once __DIR__.'/vendor/autoload.php'; 

$amount = (isset($argv[1])) ? $argv[1] : NULL;

try {

    $cashMachine = new CashMachine();
    $notes = $cashMachine->withDraw($amount);
    
    print_r($notes);
    
} catch (NoteUnavailableException $e) {
    echo "Note Unavailable Exception\n\n";
} catch (InvalidArgumentException $e) {
    echo "Invalid Argument Exception\n\n";
}
?>
