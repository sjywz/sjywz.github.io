---
title: 浅尝vue之感
date: 2022-06-01 16:46:22
tags:
- 个人随笔
- vue
- react
---

### 引

最近因为做小程序，鉴于之前使用过taro不尽人意，这次就换uniapp试试了。taro同时支持vue和react开发，但uniapp只能使用vue。一直没有用过vue做开发，就当练手了。

想起vue刚出来那会儿，前端开发还在使用jQuery，那时node也刚出不就，我的工作也主要是php。当时比较火的是anggular，做后台管理页面的时候还引入angular做过小小的尝试，并未觉得有啥新意。判断循环php模板一样能实现，还不用单独写接口，也没有js加载缓慢的页面闪动。自然也就没有进一步深入了解。

因为工作需要自己也开始学习前端，毕竟php作为网站开发语言跟网页靠得太紧了。正所谓成也萧何败萧何，当初php因此发展，前端独立发展又导致了php的式微。后面web开发的借助node发展可谓是日新月异，从grunt、yoman到webpack、vite；从seajs、requirejs到commonjs、esm；从Backbone、angular到vue,react;不端的推陈出新，看得人眼花缭乱。

最开始学习的时候vue和react都有看，网上各种说vue简单易学，react学习曲线陡峭。工作中也经常听到说vue不行，不适合做大型项目，对于这些我想说的是：项目真大到了连vue都不配么？我从一开始喜欢react，纯属react的jsx比vue各种指令更符合我的直观感受。没有什么方法、属性、指令，不需要按选项一个一个的是写，不用在视图模板和js之间来回切换，寻找变量方法。jsx搞定一切，一切都是js，开发更自由、更少的心智负担和更少的样板代码。随着最近的开发学习也有了更多的体会。

### 示例

以点击反转字符串为例：

```javascript
// react
const Index = () => {
  const [ text, setText ] = useState('this is test');
  const reversal = () => {
    setText(text.split('').reverse().join(''));
  }
  return <p onClick={reversal}>{text}</p>
}
```

```html
<!-- vue -->
<template>
  <p @click="reversal">{{text}}</p>
</template>
<script>
  export default {
    data() {
      return {
        text: 'this is test'
      }
    },
    methods: {
      reversal() {
        this.text = this.text.split('').reverse().join('')
      }
    }
  }
</script>
```

```html
<!-- vue3 组合式 API -->
<template>
  <p @click="reversal">{{text}}</p>
</template>
<script setup>
  import { ref } from 'vue'
  const text = ref('this is test')
  function reversal() {
    text.value = text.value.split('').reverse().join('')
  }
</script>
```

### 我的选择

通过示例可以看出，在书写流畅上react有着绝对的优势，vue3的组合式api算是改进很多，比起之前的选项式看着要简洁不少。但模板代码跟js之间的切换、各种指令还是必不可少。也不是说vue不好，一些限制反而能降低代码的出错率，react的自由对新手来说确实更容易出错。不管怎么说vue和react并列为两大主流框架，看过尤大的一些视频，框架的开发本来就是平衡的技术，总得有所取舍，不可能尽善尽美。

*我个人更喜欢react的开发方式，但我还是会用vue做一些开发。*