gp_manager
==========

github page manager, alfred workflow

#Changelog

* v0.2

> feature: save snapshot of clipboard to file

##Feature

* new post file use default templet
* edit post file by search keyword
* edit templet
* save snapshot of clipboard to file

##How to install

1. download the last release zip: [gp_manager.alfredworkflow.zip](https://github.com/liang8305/gp_manager/releases/download/v1.0/gp_manager.alfredworkflow.zip)
1. unzip `gp_manager.alfredworkflow.zip` you will get `gp_manager.alfredworkflow`.
1. double click the `gp_manager.alfredworkflow` file , alfred will open and install it.
1. use `gp config` to open config file , and set `home` to your blog dir.

![](https://cloud.githubusercontent.com/assets/3114995/4970599/f89519b6-6885-11e4-892c-0ad89ea72c1c.png)
![](https://cloud.githubusercontent.com/assets/3114995/4970605/17f851e2-6886-11e4-9767-5637ca2d3b5f.png)


##How to use

alfred keyword is `gp`

![7da330f5-e6fb-4a48-835b-e7caf2bfb001](https://cloud.githubusercontent.com/assets/3114995/4807774/94768a24-5e98-11e4-9374-e865fd52926b.png)

##Edit default templet:

	gp templet *search*

##New post file:

it will create new post file, filename format `{yyyy-mm-dd}-{title}.md`

  	gp new title
  	
it will create new post file in dir `{dirname}`

	gp new dirname/title
  	
![9c63d7ed-19e3-4cdc-b4b1-fa879d4b601d](https://cloud.githubusercontent.com/assets/3114995/4807784/ba6c9bf6-5e98-11e4-9457-0281f8a48c58.png)
  
##Edit post file

it will search the file

  	gp edit *search* 
  	
![70f992ae-3a6d-4e10-9230-074506cbbb0b](https://cloud.githubusercontent.com/assets/3114995/4807792/d1b69604-5e98-11e4-9e24-0ddc24c1de78.png)

##Save snapshot of clipboard

###config
use `gp config` to open config file , and set `post_images_dir` to which dir you want to save the images of post.

###use

1. do snapshot to clipboard just like `Shift + Cmmand + Control + 4`
![image](https://cloud.githubusercontent.com/assets/3114995/4971381/4d04ac7e-68da-11e4-8173-a3a06b84302d.png)
2. use `gp paste2image`
![image](https://cloud.githubusercontent.com/assets/3114995/4971385/76ff5a60-68da-11e4-9e9c-4e844e9a05bd.png)
3. then you and paste the file name `/Volumes/f/liang8305.github.com/assets/images/posts/20141110/20141110130825.png




 



