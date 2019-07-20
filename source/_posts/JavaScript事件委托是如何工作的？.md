---
title: JavaScript事件委托是如何工作的？
date: 2019-07-20 22:44:06
tags:
- 他山之石
- js
---

> 原文链接：[How JavaScript Event Delegation Works](https://davidwalsh.name/event-delegate)

事件委托有着充分的理由作为JavaScript中最热门的方法之一。事件委托避免你为每一个明确节点添加事件监听，与之代替的是添加事件到父节点。通过事件冒泡查找到匹配的子元素。基础概念相当简单，不过许多人并不理解事件委托是如何工作的。下面让我们通过一个基础的JavaScript示例来演示事件委托是如果工作的。

假设我们有这样一个带有子节点的`ul`标签:

``` html
<ul id="parent-list">
    <li id="post-1">Item 1</li>
    <li id="post-2">Item 2</li>
    <li id="post-3">Item 3</li>
    <li id="post-4">Item 4</li>
    <li id="post-5">Item 5</li>
    <li id="post-6">Item 6</li>
</ul>
```

通常点击子元素时需要发生些事情。你当然可以为每一个`li`元素添加事件监听，但如果需要频繁的从列表中添加或删除`li`呢？添加和删除事件监听将会是一场噩梦，特别是如果添加和删除代码位于程序的不同位置。最好的解决方案是将监听事件添加到父元素`ul`。监听事件添加到父元素，又如何知道是哪个元素被点击了呢？

简单：但事件冒泡至`ul`元素，通过事件对象`target`属性获取真实点击元素。下面是一段非常基础的JavaScript片段，它演示了事件委托：

``` js
// 获取元素,添加click监听事件...
document.getElementById("parent-list").addEventListener("click", function(e) {
    // e.target是被点击的元素
    // 如果是列表元素
    if(e.target && e.target.nodeName == "LI") {
	// 找到列表元素，输出ID
	    console.log("List item ", e.target.id.replace("post-", ""), " was clicked!");
    }
});
```

首先添加一个点击事件监听器。当监听事件被触发，检测事件元素以确保它就是要响应的元素。如果刚好是`li`，噢：这正是我们需要的。如果不是我们想要的元素，就忽略事件。示例相当简单——`ul`和`li`是一个直接的比较。让我们试试更难的，我们有一个父`div`，它有很多子元素，但我们只关心一个class为`classA `的`a`标签。

``` js
// 拿到父元素DIV，添加click监听事件...
document.getElementById("myDiv").addEventListener("click",function(e) {
    // e.target是被点击的元素
    if (e.target && e.target.matches("a.classA")) {
        console.log("Anchor element clicked!");
    }
});
```

使用[Element.matches API](https://davidwalsh.name/element-matches-selector)（注：[MDN](https://developer.mozilla.org/zh-CN/docs/Web/API/Element/matches)），可以查看元素是否为我们期望目标。

因为大多数开发者使用了JavaScript库来处理DOM元素事件，因此建议使用类库提供的事件委托方法，它们能够进行高级委派和元素识别。

希望这可以帮助您直观地了解事件委托背后的概念，并发挥它的力量！
