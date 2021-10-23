<?php


namespace App\Services;


class CsvReaderService
{

    public function __construct($filename, $delimiter = "\t")
    {
        $this->file      = fopen($filename, 'r');
        $this->delimiter = $delimiter;
        $this->iterator  = 0;
        $this->header    = null;
    }

    public function toArray()
    {
        $data = array();
        while (($row = fgetcsv($this->file, 300, $this->delimiter)) !== false) {
            $is_mul_10000 = false;
            if (!$this->header) {
                $this->header = ['id', 'email', 'name', 'birthday', 'phone', 'ip', 'country', 'year', 'month'];
            } else {
                $this->iterator++;
                $row['year'] = date('Y', strtotime($row[3]));
                $row['month'] = date('m', strtotime($row[3]));
                $data[] = array_combine($this->header, $row);
                if ($this->iterator != 0 && $this->iterator % 300 == 0) {
                    $is_mul_10000 = true;
                    $chunk       = $data;
                    $data        = array();
                    yield $chunk;
                }
            }
        }

        fclose($this->file);
        if (!$is_mul_10000) {
            yield $data;
        }
        return;
    }
}
