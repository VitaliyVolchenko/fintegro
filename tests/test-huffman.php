<?php
class HuffmanCodeFile extends Huffman
{
    private $huffmanBuff;
    private $buffSize;
    private $fileSrcHandle;
    private $fileSrcName;
    private $fileDstHandle;
    private $fileDstName;

    public function __construct($fileSrc, $fileDst, $buffSize)
    {
        $this->buffSize = $buffSize;
        $this->fileSrcName = $fileSrc;
        $this->fileDstName = $fileDst;
        $this->huffmanBuff = str_repeat(pack('C',0), $buffSize);
        parent::__construct();
    }

    public function encode_file() {
        $status = 1;
        try {
            if (!is_file($this->fileSrcName) === true){
                throw new \Exception("file not exist ");
            }
                $this->fileSrcHandle = fopen($this->fileSrcName, 'r');
                if (!is_resource($this->fileSrcHandle) === true) {
                    throw new \Exception("fileSrcHandle is not resourse");
                }
                    $this->fileDstHandle = fopen($this->fileDstName, 'w');
                    if (!is_resource($this->fileDstHandle) === true) {
                        throw new \Exception("fileDstHandle is not resourse");
                    }
                        while (!feof($this->fileSrcHandle)) {
                            $this->huffmanBuff = fread($this->fileSrcHandle, $this->buffSize);
                            parent::encode($this->huffmanBuff);
                            if (fwrite($this->fileDstHandle, $this->encoded) === FALSE) {
                                throw new \Exception("Error encode");
                                break;
                            }
                        }
        } catch (\Exception $e) {
            echo "ERROR: $e";
        }
        return $status;
    }
    public function __toString(){
        $output = '';
        foreach($this->dictionary as $key=>$value){
            $output .= $key . "=>" . $value . ", ";
        }
        return $output;
    }
    public function __toString()
    {
        return "Debug message from HuffmanModel Class : Char Tree = " . serialize($this->char_tree) . ",
               Dictionary = " . serialize($this->dictionary);
    }
    /*origin master
     * public function encode_file() {
        $status = 1;
        try {
            if (is_file($this->fileSrcName) === true) {
                $this->fileSrcHandle = fopen($this->fileSrcName, 'r');
                if (is_resource($this->fileSrcHandle) === true) {
                    $this->fileDstHandle = fopen($this->fileDstName, 'w');
                    if (is_resource($this->fileDstHandle) === true) {
                        while (!feof($this->fileSrcHandle)) {
                            $this->huffmanBuff = fread($this->fileSrcHandle, $this->buffSize);
                            parent::encode($this->huffmanBuff);
                            if (fwrite($this->fileDstHandle, $this->encoded) === FALSE) {
                                $status = -1;
                                throw new Exception("Can't write to file!");
                                break;
                            }
                        }
                    } else {
                        $status = -2;
                        throw new Exception("Can't open Destination file!");
                    }
                } else {
                    $status = -3;
                    throw new Exception("Can't open Source file!");
                }
            } else {
                $status = -4;
                throw new Exception("Source file does not exists!");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $status;
    }*/
}