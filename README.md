gp_manager
==========

个人博客使用github page 托管, 写了个alfred workflow, 方便管理博文

![7da330f5-e6fb-4a48-835b-e7caf2bfb001](https://cloud.githubusercontent.com/assets/3114995/4807774/94768a24-5e98-11e4-9374-e865fd52926b.png)

##模板

新建的博文都使用模板来创建, 当前仅支持默认模板

###修改模板:

	gp templet *search*

##新建博文:

新建的博文会使用`{yyyy-mm-dd}-{title}.md`的格式来新建文件

  	gp add title
  	
还可以在目录下建博文, 下面会在 dirname目录下创建博文{yyyy-mm-dd}-{title}.md

	gp add dirname/title
  	
![9c63d7ed-19e3-4cdc-b4b1-fa879d4b601d](https://cloud.githubusercontent.com/assets/3114995/4807784/ba6c9bf6-5e98-11e4-9457-0281f8a48c58.png)
  
##修改编辑博文

输入想查找的文件名, 会进行模糊匹配, 选择列表来打开修改

  	gp edit *search* 
  	
![70f992ae-3a6d-4e10-9230-074506cbbb0b](https://cloud.githubusercontent.com/assets/3114995/4807792/d1b69604-5e98-11e4-9e24-0ddc24c1de78.png)
