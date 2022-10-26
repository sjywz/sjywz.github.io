---
title: css伪元素
date: 2021-09-03 11:12:07
tags:
- css
---

### 伪元素

MDN的说明：[伪元素是一个附加至选择器末的关键词，允许你对被选择元素的特定部分修改样式。](https://developer.mozilla.org/zh-CN/docs/Web/CSS/Pseudo-elements)

伪元素不像span/p/div之类的标签元素可以直接写于页面用作布局或显示，只能通过选择器操作，这就是伪元素的“伪”。它依附于其他已有元素，如果页面没有该元素，伪元素自然也就不生效。 另一方面伪元素一直存在于页面上的每个标签元素，只是没有显现出来，因此任何一个元素都能支持大部分的伪元素选择，某些伪元素只能用作块级元素，也可以通过修改元素display实现。

> 注：按照规范，应该使用双冒号（::）而不是单个冒号（:），以便区分伪类和伪元素。但是，由于旧版本的 W3C 规范并未对此进行特别区分，因此目前绝大多数的浏览器都同时支持使用这两种方式来表示伪元素。

### ::before和::after

通常伪元素::before和::after是使用最多的两个伪元素。这两个作用相同，只是一个是在被选元素之前一个是在之后，但显示在页面上的前后可以通过css调整，完全可以让`::after`显示在前`::before`显示在后。通过指定css`content`属性就可以显示出来，即使伪元素没有任何内容也需添加`content:''`，否则伪元素不显示。一般会伴随设置选择元素相对定位，伪元素绝对定位用作布局展示只用。

### ::first-line和::first-letter

::first-line 选择容器元素内（块级元素）第一行，第一行的内容受设备宽度、元素宽度、字体大小影响而不同；
::first-letter 选择容器元素内（块级元素）第一个字，通常用于英文首字母大写或新闻段落提醒。

### ::selection

::selection 选择用户选中内容，通常用于设置用户选中内容的高亮。

### ::placeholder

::placeholder 可以选择input占位文本，设置占位文本样式。

还有一些其他不常用的伪元素，就不一一列出了。点此查看[标准伪元素](https://developer.mozilla.org/zh-CN/docs/Web/CSS/Pseudo-elements#%E6%A0%87%E5%87%86%E4%BC%AA%E5%85%83%E7%B4%A0%E7%B4%A2%E5%BC%95)

#### 示例

```html
<style>
.p::before{
  content: '♥';
}
.p::after{
  content: '♥';
}
</style>
<p class="p">hello word</p>
```

![img](http://cms.bcode.cc/uploads/medium_WX_20220601_144115_2x_43a9b59573.png)

---

```css
/* 添加`::first-line` */
.p::first-line{
  color: white;
  background-color: black;
}
```

![img](http://cms.bcode.cc/uploads/medium_WX_20220601_144945_2x_8ad2785fde.png)

---

```css
/* 添加`::first-line` */
.p::first-letter{
  font-size: 35px;
  color: red;
}
```

![img](http://cms.bcode.cc/uploads/medium_WX_20220601_145131_2x_d4b1300686.png)