export default{
    changeClassID (state, ClassID) {  //改变userName的方法 ，userName是页面传过来的参数。
      state.ClassID = ClassID  //改变state中的userName
      try {
        localStorage.ClassID = ClassID  //本地存储userName
      } catch (e) {}
    }
  }