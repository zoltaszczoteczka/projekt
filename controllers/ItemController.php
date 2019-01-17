<?php
/**
 * Created by PhpStorm.
 * User: Kasia
 * Date: 17.01.2019
 * Time: 13:24
 */

class ItemController extends AppController
{
function showItems(){
    $list = ['monitor', '123'];
    $this->render('item', ['lista' => $list]);
}
}