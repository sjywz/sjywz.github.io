---
title: 中间件之array_reduce与call_user_func
date: 2019-07-04 18:00:31
tags:
- php函数
- js
---
 在社区看到[Laravel中间件,管道之面向切面编程](https://learnku.com/docs/laravel-core-concept/5.5/%E4%B8%AD%E9%97%B4%E4%BB%B6/3022)，介绍了中间件实现原理。主要的实现就两个函数：
 
> call_user_func() 把第一个参数作为回调函数调用
> array_reduce() 用回调函数迭代地将数组简化为单一的值

单看手册这两个函数都很简单，我也都知道。对`call_user_func()`理解就停留在既然知道函数名，直接调用就行了，何必要参数传入作为回调函数调用，这不是多此一举么？`array_reduce()`无非就是能拼接个字符串或者求个和，拼接字符串我可以用`implode()`实现，复杂点还可以迭代数组实现，求和`array_sum()`就能完成了。看完文章才发现原来还能这么玩儿。

想到[Express](http://www.expressjs.com.cn/)也是有中间件的，试着写了下js的实现。

```js
function VerfiyCsrfToekn(next){
  console.log('验证csrf Token');
  next();
}

function VerfiyAuth(next){
  console.log('验证是否登录');
  next();
}

function SetCookie(next){
  next();
  console.log('设置cookie信息！');
}

const pipe_arr = [
  'VerfiyCsrfToekn',
  'VerfiyAuth',
  'SetCookie',
];

const callback = pipe_arr.reduce(function(stack,pipe){
  return `function(){${pipe}(${stack})}`
},function(){
  console.log('当前要执行的程序');
});

//console.log(callback);php是返回闭包再用call_user_fun()函数调用，js这里直接使用eval执行，打印可以发现执行逻辑更清晰。
console.log(eval(`(${callback})()`));
```