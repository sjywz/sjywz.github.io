---
title: PHP魔术方法
date: 2023-03-23 09:56:45
tags:
- php
---


php存在很多的魔术方法，这些方法在我们触发时会自动调用。这些方便可以大大提升我们的编程便捷性。

__construct()：当创建一个新的对象时自动调用此方法，用于初始化对象的成员变量。这可能是php中最常用的魔术方法了，因为基本每一个对象都需要初始化一些数据。

__destruct()：在对象被销毁前自动调用此方法，用于清理资源，比如自动断开数据库连接之类。

__invoke()：在将对象当做函数调用时，自动调用该方法。主要用于编写直接调用类，闭包函数默认实现了__invoke()。

```php
class Test{
  public $name;
  function __construct($name){
    $this->name = $name;
  }

  function __invoke(){
    return 'Hello '.$this->name;
  }
}

$closure = function($name){
  return 'Hello '.$name;
};

$test = new Test('Lisi');
echo $test();//Hello Lisi
echo $closure('Lisi'); //Hello Lisi
echo $closure->__invoke('Zhangsan'); //Hello Zhangsan
```

__get()：在访问一个不存在的或者私有的属性时自动调用此方法。

__set()：在设置一个不存在的或者私有的属性时自动调用此方法。

__call()：在调用一个不存在的或者私有的方法时自动调用此方法。

__callStatic()：在调用一个不存在的或者私有的静态方法时自动调用此方法。

__toString()：在尝试将对象转换为字符串时自动调用此方法。

__clone()：当复制一个对象时自动调用此方法，用于复制对象的成员变量。

__sleep()：在序列化对象时自动调用此方法，用于返回实例中包含的所有值的名称数组。

__wakeup()：在反序列化对象时自动调用此方法，用于重新读取所有值。

__isset()：在判断一个不存在的或者私有的属性是否被设置时自动调用此方法。

__unset()：在删除一个不存在的或者私有的属性时自动调用此方法。

__set_state()：在使用var_export()函数导出一个类或对象时自动调用此方法。

__debugInfo()：在调用var_dump()函数时自动调用此方法，用于返回对象的调试信息。