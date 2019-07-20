---
title: php反射类
date: 2019-07-20 21:17:03
tags:
- php
---

很多东西在就算知道也没啥用。比如php反射类，以前翻看手册时也看过，但就是不知道有啥用。官网介绍：PHP 5 具有完整的反射 API，添加了对类、接口、函数、方法和扩展进行反向工程的能力。 此外，反射 API 提供了方法来取出函数、类和方法中的文档注释。最近看了[深入 Laravel 核心 ](https://learnku.com/docs/laravel-core-concept/5.5)，其中介绍到Laravel的Ioc容器就是依靠php反射类的实现才算明白，于是又看了一遍[php反射类](https://php.net/manual/zh/book.reflection.php)，顺便记录一下。

> ReflectionClass 类报告了一个类的有关信息。
> ReflectionClass::getConstructor — 获取类的构造函数
> ReflectionClass::getName — 获取类名
> ReflectionClass::newInstance — 从指定的参数创建一个新的类实例
> ReflectionClass::getMethod — 获取一个类方法
> ReflectionMethod::setAccessible — 设置方法是否访问
> ReflectionMethod::invoke — 执行一个反射的方法
> ReflectionFunctionAbstract::getParameters — 获取参数

```php
<?php
class Test
{
  public $num;
  function __construct($num = 0)
  {
    $this->num = $num;
  }

  public function getNum()
  {
    return $this->num;
  }

  private function _modifyNum($num)
  {
    if($num){
      $this->num = $num;
    }
  }
}

$reflection = new ReflectionClass('Test');//获取Test类的构造函数
echo $reflection->getName(),PHP_EOL;//获取类名
$test = $reflection->newInstance(1);//传入参数创建实例
echo $test->getNum(),PHP_EOL;//调用方法getNum
$method = $reflection->getmethod('_modifyNum');//获取类的私有方法_modifyNum
print_r($method->getParameters());//获取方法参数
$method->setAccessible(true);//设置方法可访问
$method->invoke($test,2);//传入参数调用私有方法
echo $test->getNum(),PHP_EOL;//再次调用方法getNum
```
以上程序输出：
```
Test
1
Array
(
    [0] => ReflectionParameter Object
        (
            [name] => num
        )
)
2
```


