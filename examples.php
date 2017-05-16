<html>
    <head>
        <meta charset="UTF-8">
        <title>Изучение простейшей работы с memcached</title>
    </head>
    <body>
        <p><a href="\">На главную</a></p>
<?php

//Изучение работы с memcached

$memcached = new Memcached();               //создали объект
$memcached->addServer('localhost', 11211);  //задали сервер memcached
$memcached->setOption(Memcached::OPT_COMPRESSION, false);   //запрещаем компрессию кеша, чтобы работал append()
print_r($memcached->getOption(Memcached::OPT_COMPRESSION)); echo "<br />";
print_r($memcached->getVersion()); echo "<br />";

$memcached->set('key', 'value');            //записали значение для переменной key
echo "1. obj-><b>set</b>('key', 'value')<br />'".$memcached->get('key')."'<br />";                //прочитали и вывели значение переменной key

$memcached->replace('key', 'value1');   //заменили переменную
echo "2. obj-><b>replace</b>('key', 'value1')<br />'".$memcached->get('key')."'<br />";

if($memcached->append('key', 'abc')) {  //добавили строку в конец к значению
    echo "3. obj-><b>append</b>('key', 'abc')<br />'".$memcached->get('key')."'<br />";
} else {
    echo $memcached->getResultMessage()."<br />";   //вывели информацию о последней операции
}

$memcached->delete('key');  //удалили переменную
echo "4. obj-><b>delete</b>('key')<br />'".$memcached->get('key')."'<br />";

$mas_tmp = array('key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3');
$memcached->setMulti($mas_tmp); //установили сразу 3 переменных
echo "5. obj-><b>setMulti</b>($mas_tmp)<br />'".$memcached->get('key1')."', '".$memcached->get('key2')."', '".$memcached->get('key3')."'<br />";

$memcached->set('num', 2);
$memcached->increment('num', 2);        //увеличили значение инкрементом на 2
echo "6. obj-><b>increment</b>('num', 2)<br />'".$memcached->get('num')."'";
$memcached->increment('num', 3);
echo ", '".$memcached->get('num')."'<br />";

$memcached->decrement('num', 2);        //уменьшили значение декрементом на 2
echo "7. obj-><b>decrement</b>('num', 2)<br />'".$memcached->get('num')."'";
$memcached->decrement('num', 3);
echo ", '".$memcached->get('num')."'<br />";



$memcached->close();    //закрыли соединение с сервером
?></body>
</html>