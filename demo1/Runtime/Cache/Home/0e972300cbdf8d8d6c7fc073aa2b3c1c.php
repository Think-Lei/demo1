<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户界面</title>
</head>
<body bgcolor="#f5f5dc">
<center>
    欢迎您,<?php echo ($name); ?>!
    <br/>
    <br/>
    <a href="../UserInformation/information.html">个人信息</a>
    <a href="../Update/update.html">修改信息</a>
    <br><br>
    <a href="../Eximport/eximport.html">导入导出数据</a>
    <a href="../Search/search.html">查询</a>
    <a href="../Login/login.html">安全退出</a>
</center>
</body>
</html>