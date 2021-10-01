<?php
namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FileCollectionTest extends TestCase
{
    protected $someFile = null;

    /**
     * @test
     */
    public function fileIsEmpty()
    {
        $someFile = [];
        $this->assertEmpty($someFile);

        return $someFile;
    }

    /**
     * @test
     * @depends fileIsEmpty
     * Simulate File
     */
    public function validSingleFile()
    {
        $files = new FileCollection();
        $path = $files->doAnyFile();

        $this->assertTrue($files->valid($path));

        return $path;
    }

     /**
     * @test
     * @depends validSingleFile
     */
    public function transformFileIntoArray(string $path)
    {
        $files = new FileCollection();
        $someFile = $files->readFile($path);

        $this->assertGreaterThan(0, $files->countArray($someFile));
    }

    /**
     * @test
     * @depends validSingleFile
     */
    public function writtenFile(string $path)
    {
        $files = new FileCollection();
        $array = [
            'name' => 'youFile.txt',
            'type' => 'text/plain',
            'size' => '124',
            'tmp_name' => '/tmp/myFile.txt',
            'error' => 0
        ];

        $someFile = $files->write($path, $array);
        $this->assertIsReadable($path);
    }
}
