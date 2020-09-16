---
title: 初探Web Components
date: 2020-09-12 15:58:46
tags:
- web
- html
- 组件
---

web components是一套无需react/vue，浏览器就可实现的自定义组件方法。

> 通过`customElements.define()`定义组件，有二个必填和一个选填参数：

- 名称，一个带中划线的字符串，如：my-control
- 自定义组件类
- 继承，包含extends属性的对象（选填）

> 自定义组件类的是通过继承[HTMLElement](https://developer.mozilla.org/zh-CN/docs/Web/API/HTMLElement)接口实现，组件类的生命周期有：

- connectedCallback：组件首次被插入文档DOM时，被调用。
- disconnectedCallback：组件从文档DOM中删除时，被调用。
- adoptedCallback：组件被移动到新的文档时，被调用。
- attributeChangedCallback: 组件增加、删除、修改自身属性时，被调用。

### 实现一个按钮组件

```js
class MyButton extends HTMLElement {
    constructor() {
        super();
        const text = this.getAttribute('text');//获取按钮显示内容
        const color = this.getAttribute('color');//获取按钮颜色
        const button = document.createElement('span');//创建span标签
        button.style.color = color;
        button.style.border = `1px solid ${color}`;
        button.textContent = text;
        this.appendChild(button);
    }
    //组件生命周期
    connectedCallback() {
        console.log('组件载入');
    }
}
//注册组件
customElements.define('my-button',MyButton);
```
调用
```html
<my-button text="自定义组件按钮" color="blue"/>
<!-- <my-button text="自定义组件按钮" color="blue"></my-button> -->
```

### 继承内置元素的组件

上面是用span创建模拟button实现的一个自定义按钮组件，而`customElements.define()`的第三个参数设置继承自内置元素，实现对内置元素的扩展。
```js
class CustomButton extends HTMLButtonElement {
    constructor() {
        super();
        this.style.color = 'red';
        this.style.fontWeight = 'bold';
    }

    connectedCallback() {
        console.log('扩展button载入')
    }
}
customElements.define('custom-button',CustomButton,{extends:'button'});
```
调用
```html
<button is="custom-button">定制按钮</button>
```
> 继承元素组件类的继承需要继承相应的内置接口，比如button的`HTMLButtonElement`，调用也不再是直接调用，而是直接调用内容元素传入`is="custom-button"`。

Web Components还有一些其他定义，比如：Shadow DOM 、Templates、slot等，可用于实现更加复杂、灵活的组件。个人觉得Web Components不需要任何框架即可实现组件开发非常好，补足了web开发不能拆分的缺陷。虽然是各种框架的出现算是补足了这一块，但如果浏览器默认就支持自然是更好了，现阶段的Web Components还不及框架，但随着浏览器的发展，谁知道呢？