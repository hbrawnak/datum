<?php


namespace App\Services;


use Generator;

class CSVReaderService
{
    /**
     * @var false|resource
     */
    private $file;
    /**
     * @var string
     */
    private $delimiter;
    /**
     * @var int
     */
    private $iterator;
    /**
     * @var null
     */
    private $header;

    /**
     * CSVReaderService constructor.
     * @param $filename
     * @param string $delimiter
     */
    public function __construct($filename, string $delimiter = "\t")
    {
        $this->file      = fopen($filename, 'r');
        $this->delimiter = $delimiter;
        $this->iterator  = 0;
        $this->header    = null;
    }

    /**
     * @return Generator
     */
    public function toArray(): Generator
    {
        $data_1901_50 = [];
        $data_1951_00 = [];
        $data_2001_20 = [];

        while (($row = fgetcsv($this->file, 300, $this->delimiter)) !== false) {
            $remaining = false;
            if (!$this->header) {
                $this->header = ['id', 'email', 'name', 'birthday', 'phone', 'ip', 'country', 'year', 'month'];
            } else {
                $this->iterator++;
                $row['year']  = date('Y', strtotime($row[3]));
                $row['month'] = date('m', strtotime($row[3]));

                if ($row['year'] < 1951) {
                    $data_1901_50[] = array_combine($this->header, $row);
                }

                if ($row['year'] < 2001 && $row['year'] >= 1951) {
                    $data_1951_00[] = array_combine($this->header, $row);
                }

                if ($row['year'] >= 2001) {
                    $data_2001_20[] = array_combine($this->header, $row);
                }


                if ($this->iterator != 0 && $this->iterator % 300 == 0) {
                    $remaining       = true;

                    $chunk_data_1901_50 = $data_1901_50;
                    $chunk_data_1951_00 = $data_1951_00;
                    $chunk_data_2001_20 = $data_2001_20;

                    $data_1901_50       = array();
                    $data_1951_00       = array();
                    $data_2001_20       = array();
                    yield [
                        '1901-1950' => $chunk_data_1901_50,
                        '1951-2000' => $chunk_data_1951_00,
                        '2001-2020' => $chunk_data_2001_20
                    ];
                }
            }
        }

        fclose($this->file);
        if (!$remaining) {
            yield [
                '1901-1950' => $data_1901_50,
                '1951-2000' => $data_1951_00,
                '2001-2020' => $data_2001_20
            ];
        }
    }
}
