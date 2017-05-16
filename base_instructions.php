<?php
/*
Процесс установки под Linux/Ubuntu:

sudo apt-get update
sudo apt-get upgrade
sudo apt-get -y install memcached
nano /etc/memcached.conf
systemctl restart memcached         //перезапуск сервера memcached
sudo apt-get install php-memcached  //установка расширения для PHP
systemctl restart apache2           //перезапуск сервера apache

Основные команды:
*/

$obj = new Memcached();                   //создание объекта Memcached
$obj->addServer('localhost', 11211);      //добавили 1 сервер с указанием порта 11211
$obj->add('ключ', 'значение');            //инициализировали и установили значение для ключа
$obj->get('ключ');                        //извлечение значения
$obj->replace('ключ', 'новое значение');  //заменили старое зачение ключа на новое
$obj->delete('ключ');                     //удалили ключ со значением
$obj->append('ключ', 'добавка');          //к строковому значению добавили строку
$obj->set('ключ', 'значение');            //установка значения поверх старого, даже если оно уже было инициализировано 
$obj->setMulti($mas_vars);                //установка значений из массива
?>
