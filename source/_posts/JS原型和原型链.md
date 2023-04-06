---
title: JS原型和原型链
date: 2023-03-31 12:57:28
tags:
- js
---

构造函数：构造函数就是使用了`new`操作符调用的普通函数，它与普通函数别无二致，一般会以首字母大写作区分。

原型[对象]：创建函数时会自动为函数创建一个prototype属性，这个属性指向函数的【原型对象】。原型对象默认有一个constructor属性，指回与之关联的函数；在原型对象上定义的方法和属性可以被【对象实例】共享（继承）。

对象实例：通过new操作符创建的对象。

原型链：每个对象都有一个指向原型对象（构造函数的prototype）的指针（__proto__属性），原型链从对象本身的prototype到Object.prototype为止的链。

> 原型对象中的属性和方法可以被对象实例共享。当我们在一个对象上调用一个属性/方法时，JavaScript 引擎首先会查找这个对象自身是否拥有这个属性/方法，如果没有，则会沿着这个对象的 [[Prototype]] 属性继续查找，直到找到这个属性/方法或者到达了原型链的尽头。

以代码为例：

```js
function Parent(){}//Parent是一个构造函数

//prototype是Parent的原型对象，对象上现在默认有一个constructor属性，指回函数Parent
//即Parent.prototype.constructor === Parent
console.log(Parent.prototype.constructor === Parent);// true
//在原型上添加方法sayHello
Parent.prototype.sayHello = function(){
  console.log('hello');
}

//使用new创建了对象实例a
//这里a的__proto__指向Parent.prototype
const a = new Parent();
//a调用了sayHello方法
a.sayHello();//输出 hello
console.log(a.__proto__ === Parent.prototype);// true
```

对象实例a的原型链就是：

```js
a--->a.__proto__--->a.__proto__.__proto__->a.__proto__.__proto__.__proto__ 
a
//a.__proto__ === Parent.prototype
//a.__proto__.__proto__ === Object.prototype
//a.__proto__.__proto__.__proto__ === null
```
