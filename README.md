# LyShop

v1.x 分支是后台权限管理

v2.x 分支是商城分支

## 安装说明

### 生成配置文件

> php -r "file_exists('.env') || copy('.env.example', '.env');"

### 建立数据

> php artisan migrate

### 添加数据

> php artisan backup:restore

ps: /database/back-up/地区数据 是恢复地区数据 另外再加一个最新日期的就好了


## 开发

### 前端
    
ps: 前端开发要安装 node.js 详情请查看 [package.json](./package.json)

### 后台开发 

```
|-- app
    |-- Http
        |-- Controllers
            |-- Controller.php                                              基类
            |-- Api
                |-- AuthController.php                                      登陆&验证控制器
                |-- UeditorController.php                                   Ueditor编辑器控制器
                |-- Authorities                                             权限控制器目录
                |   |-- AuthorityController.php                             权限控制器
                |   |-- MenuController.php                                  菜单控制器
                |   |-- RoleController.php                                  角色控制器
                |   |-- UserController.php                                  用户控制器
                |-- Goods                                                   商品控制器目录
                |   |-- CategoryController.php                              商品类目控制器
                |   |-- GoodsController.php                                 商品控制器
                |   |-- SpecController.php                                  商品属性&商品规格控制器
                |-- Setting                                                 商城设置目录
                    |-- CompanyController.php                               快递公司控制器
                    |-- FocusController.php                                 焦点图控制器
                    |-- PositionController.php                              焦点图位置控制器
                    |-- TemplateController.php                              快递模板控制器
```
  

ps: 后台开发请先阅读 [luffyzhao/laravel-tools](https://github.com/luffyzhao/laravel-tools)