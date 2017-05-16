<html>
    <head>
        <title>Простейшая работа с memcached</title>
    </head>
    <body><?php
$memcached = new Memcached();                               //создали объект
$memcached->addServer('localhost', 11211);                  //задали сервер memcached
$memcached->setOption(Memcached::OPT_COMPRESSION, false);   //запрещаем компрессию кеша, чтобы работал append()
print_r($memcached->getOption(Memcached::OPT_COMPRESSION)); echo "<br />";
print_r($memcached->getVersion()); echo "<br />";

$memcached->set('key', 'value');                               //записали значение для переменной key
echo "1. obj-><b>set</b>('key', 'value')<br />'".$memcached->get('key')."'<br />";  //прочитали и вывели значение переменной key
/*
Выведет:
1. obj->set('key', 'value')
'value'
*/

$memcached->replace('key', 'value1');   //заменили переменную
echo "2. obj-><b>replace</b>('key', 'value1')<br />'".$memcached->get('key')."'<br />";
/*
Выведет:
2. obj->replace('key', 'value1')
'value1'
*/

if($memcached->append('key', 'abc')) {  //добавили строку в конец к значению
    echo "3. obj-><b>append</b>('key', 'abc')<br />'".$memcached->get('key')."'<br />";
} else {
    echo $memcached->getResultMessage()."<br />";   //вывели информацию о последней операции
}
/*
Выведет:
3. obj->append('key', 'abc')
'value1abc'
*/

$memcached->delete('key');  //удалили переменную
echo "4. obj-><b>delete</b>('key')<br />'".$memcached->get('key')."'<br />";
/*
Выведет:
4. obj->delete('key')
''
*/

$mas_tmp = array('key1' => 'value1', 'key2' => 'value2', 'key3' => 'value3');
$memcached->setMulti($mas_tmp); //установили сразу 3 переменных
echo "5. obj-><b>setMulti</b>($mas_tmp)<br />'".$memcached->get('key1')."', '".$memcached->get('key2')."', '".$memcached->get('key3')."'<br />";
/*
Выведет:
5. obj->setMulti(Array)
'value1', 'value2', 'value3'
*/

$memcached->set('num', 2);              //установили num=2
$memcached->increment('num', 2);        //увеличили значение инкрементом на 2
echo "6. obj-><b>increment</b>('num', 2)<br />'".$memcached->get('num')."'";
$memcached->increment('num', 3);        //увеличили значение инкрементом на 3
echo ", '".$memcached->get('num')."'<br />";
/*
Выведет:
6. obj->increment('num', 2)
'4', '7'
*/

$memcached->decrement('num', 2);        //уменьшили значение декрементом на 2
echo "7. obj-><b>decrement</b>('num', 2)<br />'".$memcached->get('num')."'";
$memcached->decrement('num', 3);        //уменьшили значение декрементом на 3
echo ", '".$memcached->get('num')."'<br />";
/*
Выведет:
7. obj->decrement('num', 2)
'5', '2'
*/

$memcached->close();                    //закрыли соединение с сервером
?></body>
</html>
