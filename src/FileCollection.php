<?php
namespace Live\Collection;

/**
 * File Collection
 */
class FileCollection
{
    /**
     * @var array
     */
    protected $anyFile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anyFile = null;
    }

    /**
     * Validate File
     */
    public function valid(string $anyFile)
    {
        return file_exists($anyFile);
    }

    /**
     * create test file
     */
    public function doAnyFile()
    {
        $pathFile = '/teste/myFile.txt';
        $text = 'name: youFile.txt; type: text/plain \r\n';
        $file = fopen($pathFile, 'wb');
        fwrite($file, $text);
        fclose($file);

        return $pathFile;
    }

    /**
     * file read
     */
    public function readFile(string $anyFile)
    {
        $result = [];
        if ($this->valid($anyFile)) {
            $anyFile = fopen($anyFile, 'r');
            $index = 0;
            while (!feof($anyFile)) {
                $result[$index][] = explode(";", preg_replace("/\r|\n/", "", fgets($anyFile)));
                $index++;
            }
            fclose($anyFile);
        }

        return $result;
    }

    /**
     * count
     */
    public function countArray(array $array)
    {
        return count($array);
    }

    /**
     * written to file
     */
    public function write(string $anyFile, array $my_array)
    {
        $someFile = fopen($anyFile, 'a+');
        fwrite($someFile, print_r($my_array, true));

        return $someFile;
    }
}
