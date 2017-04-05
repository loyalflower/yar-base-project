# yar-base-project

基于鸟哥Yar框架的一个基础项目框架

Yar上手非常简单，安装了之后，就可以根据鸟哥给的示例进行项目的开发。

但是也正因为如此简单，在进行项目开发时，开发者还是需要搭建基础的架构，所以，本框架，就是构建这些基础设施的，目的是希望能在此基础上，更轻松如意的进行扩展。

## startup
### 下载项目后，初始化composer
> composer install

### /src/server/apilist.php
显示当前支持的所有api，并输出链接及api文件注释

### /src/server/?m=apiName
index.php为入口文件，m参数，就是api的名字。 可以通过url rewrite优化url。

### /src/client/ 
为客户端的调用示例。

## TODO
1. 在client中并行调用时，为需要依赖执行顺序的接口回调，进行封装
