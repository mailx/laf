<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hydra Admin </title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="theme/admin/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="theme/admin/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="theme/admin/css/invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="theme/admin/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="theme/admin/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="theme/admin/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="theme/admin/scripts/jquery.wysiwyg.js"></script>
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <!--<h1>Hydra Admin</h1>-->
    <!-- Logo (221px width) -->
    <!--<a href="#"><img id="logo" src="theme/admin/images/logo.png" alt="Simpla Admin logo" /></a> 
    </div>-->
    <style type="text/css">
        b{  font-family: "微软雅黑"; color: #fff;font-size: 28px;}
    </style>
    <div style="padding: 24px 48px;"> 
        <b>Hydra Admin</b>
    </div>
  <!-- End #logn-top -->
  <div id="login-content">
    <form action="admin.php?c=logini" method="post">
      <p>&nbsp;</p>
      <p>
        <label>Username</label>
        <input name="username" class="text-input" type="text" />
      </p>
      <div class="clear"></div>
      <p>
        <label>Password</label>
        <input name="pwd" class="text-input" type="password" />
      </p>
      <div class="clear"></div>
      <p>
        <input class="button" type="submit" value="Sign In" />
      </p>
    </form>
  </div>
  <!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>
