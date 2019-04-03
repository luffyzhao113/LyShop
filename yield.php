<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/4/2 19:03
 */

function create($num){
    return time();
}

function each1($num){
    for ($i = 0; $i < $num; $i++){
        yield create($i);
    }
}

foreach (each1(13) as $val){
    echo '-----' . time() . "\n";
    sleep(1);
    echo $val . "\n";
}

