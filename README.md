# Gulliver SERVICE FRAMEWORK BASE ON PHP & Restler
Minimal Restful framework build by PHP5.X, provide a performance API workout, SIMPLE AND EFEECTIVE ! <br/>
Inspired by ProcessMaker !

## WHY USE Gulliver
* Simple and effective
* Auto-Generate ORM classes
* Auto-Generate API DOC PAGE

## REQUIREMENTS
* PHP 5.6+
* Composer
* WAMP/LNMP

## DEPENDED ON LIBRARY
* PROPEL-ORM: https://propelorm.org/
* Restler: https://www.luracast.com/restler/


## SET UP
### 1. vi gulliver.bat
```
@ECHO OFF
for %%F in (%0) do set dirname=%%~dpF
SET PHP_PATH="{path2php}\php5.6.40"
SET PHP_BIN="{path2php}\php.exe"
SET PATH_GULLIVER="%dirname%\"
SET PATH_GULLIVER_BIN="%dirname%bin\gulliver"
SET PATH=%PATH%;%PHP_PATH%;%PATH_GULLIVER_BIN% 
%PHP_BIN% %PATH_GULLIVER_BIN% %1 %2 %3 %4 %5 %6 %7 %8 %9
pause
```

### 2. config
* database.ini Config DBconnection
* gulliver.ini Config API
* propel.ini Config for PHP-PROPEL ORM
* composer.json for COMPOSER library

### 3. RUN SERVER

```
PS D:\gulliver> .\gulliver2.bat
available pake tasks:
  propel-build-model  > create classes for current model
  start-apiserver     > run apiserver with php(5.4+) apiserver: usage: gulliver.bat start-apiserver 127.0.0.1:2017
  start-webserver     > run webserver with php(5.4+) webserver: usage: gulliver.bat start-webserver 127.0.0.1:2016
  version             > gulliver version
  workspace-backup    > backup a workspace
   args: [-c|--compress] <workspace> [<backup-name>|<backup-filename>]
```

### START WEB SERVER
```
PS D:\gulliver> .\gulliver2.bat start-webserver 127.0.0.1:{port}
```

### START API SERVER
```
PS D:\gulliver> .\gulliver2.bat start-apiserver 127.0.0.1:{port}
```

### CREATE ORM MODEL
this will create PHP-ORM classes for current model AUTO-GENERATE, ALL MODELS WILL BE GENERATE AT `./classes/model`， FELLOW PROPEL RULE
```
PS D:\gulliver> .\gulliver2.bat propel-build-model
```

### FRAMEWORK ARCHITECTURE

```
gulliver/
├── bin/                    # 命令行工具和可执行文件
├── classes/                # 类文件目录
│   ├── model/             # Propel ORM 生成的模型类
│   └── controller/        # API 控制器类
├── config/                # 配置文件目录
│   ├── database.ini      # 数据库配置
│   ├── gulliver.ini      # API 配置
│   └── propel.ini        # Propel ORM 配置
├── doc/                   # API DOC文档（API-DOC）
├── cron/                   # 定时任务
├── classes/               # 源代码目录
│   ├── library/              # 核心库文件
│   ├── vendor              # 系统依赖库
│   └── model/              # PROPEL-ORM 模型（自动生成）
├── service/               # 业务接口实现
├── vendor/                # Composer 依赖包
├── shared/                # 共享文件夹（资源库）
├── composer.json          # Composer 配置文件
├── gulliver2.bat          # Windows 启动脚本
├── gulliver2          # Linux 启动脚本
├── index.php          # 入口文件
└── README.md             # 项目说明文档
```

