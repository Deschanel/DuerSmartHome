# 小度音箱的homeassistant网关

Fork From https://github.com/Deschanel/DuerSmartHome.git

增加长期访问令牌支持

Add Long-Lived Access Tokens Support

# 本文为Oauth2.0搭建过程

搭建网站

下载代码

把我github上的代码放到根目录

然后在网站根目录输入以下命令：


```
$ git clone https://github.com/bshaffer/oauth2-server-php.git -b master
```

修改文件

修改serverDuerOS.php中的dbname、host、username和password！

修改homeassistant_conf.php中的地址和密码！

数据库操作

默认数据库已经建好且默认编码为utf8！

然后执行以下语句！

```
CREATE TABLE oauth_clients (
  client_id             VARCHAR(80)   NOT NULL,
  client_secret         VARCHAR(80),
  redirect_uri          VARCHAR(2000),
  grant_types           VARCHAR(80),
  scope                 VARCHAR(4000),
  user_id               VARCHAR(80),
  PRIMARY KEY (client_id)
);

CREATE TABLE oauth_access_tokens (
  access_token         VARCHAR(40)    NOT NULL,
  client_id            VARCHAR(80)    NOT NULL,
  user_id              VARCHAR(80),
  expires              TIMESTAMP      NOT NULL,
  scope                VARCHAR(4000),
  PRIMARY KEY (access_token)
);

CREATE TABLE oauth_authorization_codes (
  authorization_code  VARCHAR(40)     NOT NULL,
  client_id           VARCHAR(80)     NOT NULL,
  user_id             VARCHAR(80),
  redirect_uri        VARCHAR(2000),
  expires             TIMESTAMP       NOT NULL,
  scope               VARCHAR(4000),
  id_token            VARCHAR(1000),
  PRIMARY KEY (authorization_code)
);

CREATE TABLE oauth_refresh_tokens (
  refresh_token       VARCHAR(40)     NOT NULL,
  client_id           VARCHAR(80)     NOT NULL,
  user_id             VARCHAR(80),
  expires             TIMESTAMP       NOT NULL,
  scope               VARCHAR(4000),
  PRIMARY KEY (refresh_token)
);

CREATE TABLE oauth_users (
  username            VARCHAR(80),
  password            VARCHAR(80),
  first_name          VARCHAR(80),
  last_name           VARCHAR(80),
  email               VARCHAR(80),
  email_verified      BOOLEAN,
  scope               VARCHAR(4000),
  PRIMARY KEY (username)
);

CREATE TABLE oauth_scopes (
  scope               VARCHAR(80)     NOT NULL,
  is_default          BOOLEAN,
  PRIMARY KEY (scope)
);

CREATE TABLE oauth_jwt (
  client_id           VARCHAR(80)     NOT NULL,
  subject             VARCHAR(80),
  public_key          VARCHAR(2000)   NOT NULL
);
```

然后插入数据！

```
insert into oauth_clients (client_id, client_secret, redirect_uri) VALUES ("your clientid", "your secret", "your callback address");
```

智能家居技能填写

授权地址

就是给予duer授权码的地址，也就是authorize.php地址

- Client_Id

不解释

- Scope

如果有的话，如实填写

- Token地址

就是duerOS使用授权码获取token的地址，也就是token.php地址

- 请求方式

按照你的需求选择，Oauth2.0标准是post方法

- ClientSecret

不解释

设备云信息的WebService

根据智能家居协议写的网关地址，也就是gate.php地址

授权

授权时可以看到一个很丑的页面，就是authorize.php里的form表单，可以自己修改漂亮一点，加上逻辑验证等！

看到json数据中有login success就说明好了！

说明

dueros.php为与hass连接的文件，目前只完成了状态查看和控制简单动作，可自行开发，参见智能家居技能的协议！

# DuerSmartHome
This project is based on DuerOS &amp; HomeAssistant.
注意看里面的注释
applianceId是你Hass里面的Entity
,教程地址https://xiaozhuo1314.github.io/
