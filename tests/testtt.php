<?php
/*
public function actionIndex()
{
    $text = Yii::$app->request->post('text');
    if(isset($text)) {
        $model = new Huffman($text);
        $model->encode();
        return $this->render('index', ['model' => $model]);
    } else {
        return $this->render('index');
    }
}

<h2>Zip(ARJ)</h2>
        <form action="" method="POST">
            <h3>Text for encode</h3><br />
            <input type="text" name="text" /><br />
            <input type="submit" value="Encode" /><br />
        </form>
        <p><?php if(isset($model)){
            var_dump($model->encoded);
            }
            ?></p>


<?php
namespace app\models;
use yii\base\Model;
class Huffman extends Model
{
    private $string;
    private $char_f;
    private $char_tree;
    private $dictionary;
    public $encoded;
    public $decoded;
    public function __construct(&$buf)
    {
        $this->string = $buf;
    }
    private function _init()
    {
        $this->count_char();
        $this->char_tree = array_keys($this->char_f);
        $this->char_tree = array_map (array($this, 'character'), $this->char_tree);
        $this->build_tree();
        $this->dictionary = [];
        $this->bin_tree($this->char_tree[0], '');
    }
    public function character($i) {
        return chr($i);
    }
    private function count_char()
    {
        $this->char_f = count_chars($this->string,1);
        asort($this->char_f);
    }
    private function build_tree()
    {
        while (count($this->char_tree) > 1)
        {
            $one = array_shift($this->char_tree);
            $two = array_shift($this->char_tree);
            $this->char_tree[] = [$one, $two];
        }
    }
    private function bin_tree($lives, $pref)
    {
        if(is_array($lives))
        {
            $this->bin_tree($lives[0], $pref . '0');
            $this->bin_tree($lives[1], $pref . '1');
        } else {
            $this->dictionary[$lives] = $pref;
        }
    }
    public function encode()
    {
        $this->_init();
        $leng = strlen($this->string);
        for($i = 0; $i < $leng; $i++ )
        {
            $this->encoded .= $this->dictionary[$this->string[$i]];
        }
    }
    public function decode()
    {
        $n = strlen($this->encoded);
        $bin = '';
        for ($j = 0; $j < $n; $j++)
        {
            $bin .= $this->encoded[$j];
            if (in_array($bin, $this->dictionary, TRUE))
            {
                $this->decoded .= array_search($bin, $this->dictionary);
                $bin = '';
            }
        }
    }
}


require __DIR__ . '/../service/lib/Huffman.php';

