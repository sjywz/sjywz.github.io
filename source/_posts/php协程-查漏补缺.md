---
title: php协程-查漏补缺
date: 2019-07-10 11:54:49
tags:
- php
---

> 原文：http://www.laruence.com/2015/05/28/3038.html
之前就看过鸟哥的「在PHP中使用协程实现多任务调度」，看的迷迷糊糊的，好多的没明白的也就搁置，反正工作中也用不上。最近又重新看了一遍，顺便梳理一下。

### yield生成器
> 生成器提供了一种更容易的方法来实现简单的对象迭代，相比较定义类实现 Iterator 接口的方式，性能开销和复杂性大大降低。
``` php
function test(){
  for($i = 1; $i <= 3; $i++){
    $out = (yield $i);
    if($out){
      echo PHP_EOL;
      var_dump($out);//外部传入值
    }
  }
}

foreach(test() as $v){
  echo $v,' ';
}

echo PHP_EOL;
$it = test();
echo $it->current();
echo $it->send(111);
echo $it->send(222);
```
以上程序输出：
```
1 2 3
1
int(111)
2
int(222)
3
```

`yield`生成器还能通过`send()`实现遍历和回传数据，实现调用者与被调用者的双向通信。也可以通过遍历器的`next()`、`current()`实现遍历，只是不能回传数据。

``` php
$it = test();
while($it->valid()){
  echo $it->current();
  $it->next();
}
//输出：123 
//通过调用cureent()获取当前值，next()将指针指向下一个，valid()判断是否已完成迭代
```
`yield`更多的用来实现读取内存有限的情况下读取超大文件。

### SplQueue
> SplQueue 类通过使用一个双向链表来提供队列的主要功能。
> 队列是一种先进先出的数据结构。
> 双链表 (DLL) 是一个链接到两个方向的节点列表。当底层结构是 DLL 时, 迭代器的操作、对两端的访问、节点的添加或删除都具有 O (1) 的开销。因此, 它为栈和队列提供了一个合适的实现。
```php
$queue = new SplQueue();
$queue->enqueue('task 1');
$queue->enqueue('task 2');
foreach($queue as $v){
  echo $v,PHP_EOL;
}
echo '===============',PHP_EOL;
while(!$queue->isEmpty()){
  echo $queue->dequeue(),PHP_EOL;
}
```
以上程序输出：
```
task 1
task 2
===============
task 1
task 2
```
[`SplQueue`](https://www.php.net/manual/zh/class.splqueue.php)列队本身实现了`Iterator`接口，可以直接使用`foreach`进行遍历。使用`enqueue()`将一个元素添加到队列中，`dequeue()`按先进先出原则从队列中取出一个元素，`isEmpty()`判断队列是否为空。