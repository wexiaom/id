<!DOCTYPE html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$res['title']}</title>
  <meta name="keywords" content="{$res['keywords']}"/>
  <meta name="description" content="{$res['description']}"/>
</head>
<frameset framespacing="0" border="0" rows="0" frameborder="0">
  <frame name="main" src="{$res['url']}" scrolling="auto" noresize>
</frameset>
<noframes>
  <body>
  抱歉，您的浏览器无法处理框架！<br/>
  <a href="{$res['url']}" target="_top">点击这里继续访问</a>
  </body>
</noframes>
</html>