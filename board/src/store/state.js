let defaultClassID = '0'  //定义一个默认的名字
//部分浏览器不支持localStorage会抛出异常，所以我们需要用try catch来获取异常，这样就不报异常了。
try {
  if (localStorage.ClassID) {   //localSrorage是HTML5的新东西，可以将数据保存在本地，类似于cookie，但是保存时间是永久
    defaultClassID = localStorage.ClassID
  }
} catch (e) {}

export default{
    ClassID: defaultClassID    //导出userName到index.js
}