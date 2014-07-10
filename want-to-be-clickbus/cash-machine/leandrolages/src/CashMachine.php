<?php

class CashMachine
{

    private $availableNotes = array(100, 50, 20, 10);

    public function withDraw($amount)
    {
        return $this->_run($amount, $this->availableNotes);
    }

    private function _run($amount, array $note)
    {

        if ($amount === NULL)
            return array();

        $this->_validate($amount);

        $currentNote = array_shift($note);

        $mod = $amount % $currentNote;

        if (empty($note) && $mod > 0)
            throw new NoteUnavailableException();

        $div = floor($amount / $currentNote);

        $notes = ($div > 0) ? array_fill(0, $div, (float) number_format($currentNote, 2)) : array();

        return ($mod === 0) ? $notes : array_merge($notes, $this->_run($mod, $note));
    }

    private function _validate($amount)
    {

        if (!preg_match('/^(\d+)(\.\d+)?$/', $amount))
            throw new InvalidArgumentException();

        if (!preg_match('/^(\d+)(\.0+)?$/', $amount))
            throw new NoteUnavailableException();
    }

}
