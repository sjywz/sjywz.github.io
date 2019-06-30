<?php
$token = $_SERVER['HTTP_X_GITEE_TOKEN'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

if($userAgent === 'git-oschina-hook' && $token === 'blog.lzhy.me.auth.webhooks'){
  try{
    exec('git pull',$result);
    print_r($result);
  }catch(\Exception $e){
    echo $e->getMessage();
  }
  exit();
}
header('Location:/');