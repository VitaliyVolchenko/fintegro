<?php
namespace app\service\lib;

class Huffman
{
    private $string;
    private $char_f;
    private $char_tree;
    private $pack_char;
    public $unPakedSize;
    private $dictionary;
    public $encoded;
    public $decoded;

    public function __construct()
    {
    }

    private function _init()
    {
        $this->count_char();
        $this->char_tree = array_keys($this->char_f);

        $this->pack_char = pack('LC*', $this->unPakedSize, count($this->char_tree), ...$this->char_tree);
        $this->build_tree();
        $this->dictionary = [];
        $this->bin_tree($this->char_tree[0], '');
    }

    public function __toString()
    {
        return "Debug message from Huffman Class : Char Tree = " . serialize($this->char_tree) . ",
               Dictionary = " . serialize($this->dictionary);
    }

    public function __debugInfo()
    {
        return ['CharTree' => $this->char_tree,
            'Dictionary' => $this->dictionary];
    }

    private function count_char()
    {
        $this->char_f = array_count_values($this->string);
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

    public function encode(&$buff)
    {
        $this->string = unpack('C*', $buff);
        $this->unPakedSize = strlen($buff);
        $this->_init();
        $this->encoded = '';
        $bite_counter = 0;
        $bite_max = 7;
        $bite = 0;
        foreach ($this->string as $value)
        {
            $cnt_bit = strlen($this->dictionary[$value]);
            $bit_code = $this->dictionary[$value];
            for($b = 0; $b < $cnt_bit; $b++) {
                $bite |= (int)$bit_code[$b];
                $bite <<= 1;
                $bite_counter++;
                if ($bite_counter == $bite_max) {
                    $this->encoded .= pack('C', $bite);
                    $bite = 0;
                    $bite_counter = 0;
                }
            }
        }
        if ($bite_counter > 0) {
            $bite <<= ($bite_max - $bite_counter);
            $this->encoded .= pack('C', $bite);
        }
        // Size of packed file
        $this->pack_char .= pack('LC', strlen($this->encoded), ($bite_max - $bite_counter));
        $this->encoded = $this->pack_char . $this->encoded;
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
