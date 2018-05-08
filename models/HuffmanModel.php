<?php
namespace app\models;
use yii\base\Model;
use app\service\lib\Huffman;
use app\service\lib\HuffmanCodeFile;
class HuffmanModel extends Model
{

/*  public function encode(&$buf)
    {
       $obj = new Huffman($buf) ;
       $obj->encode();
       return $obj->encoded;
    }
*/
    public function getSize()
    {
        $in_file = __DIR__ . '/../service/lib/in_file.bin';
        $out_fie = __DIR__ . '/../service/lib/out_file.bin';
        $obj = new HuffmanCodeFile($in_file, $out_fie, 1024);
        $obj->encode_file();
        //'arr_tree' =>$obj->char_tree
        return ['size_org' => $obj->buff_size, 'size_enc' => $obj->buff_packed_size];
    }

    public function getFileSize(){
        $path = __DIR__ . '/../service/lib/in_file.bin';
        $fileSize   = filesize($path) ;
        return \Yii::$app->formatter->asShortSize( $fileSize ) ;
    }

}