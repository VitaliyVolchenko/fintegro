<?php
namespace app\models;
use yii\base\Model;
use app\service\lib\Huffman;
class HuffmanModel extends Model
{

    public function encode(&$buf)
    {
       $obj = new Huffman($buf) ;
       $obj->encode();
       return $obj->encoded;
    }

}