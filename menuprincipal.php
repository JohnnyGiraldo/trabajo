<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<style>
  * {
  margin: 0;
  padding: 0;
}
body {
  background: rgb(247, 253, 255);
}
ul {
  display: flex;
  list-style: none;
}
a {
  text-decoration: none;
  display: block;
  padding: 20px 30px;
  background: rgb(184, 197, 206);
  color: rgb(15, 36, 44);
  font-weight: bold;
}
a:hover {
  background: rgb(157, 172, 184);
}
h3 {
  background: rgb(45, 123, 196);
  padding: 20px;
}

main{
    margin-top: 60px;
}
header {
  width: 100%;
  background: rgb(184, 197, 206);
  position: fixed;
  top: 0;
}
.item{
    scroll-margin-top: 8ex;
}
html{
    scroll-behavior: smooth;
}
</style>
</head>

<body>
<ul id="MenuBar1" class="MenuBarHorizontal">
  <li><a class="MenuBarItemSubmenu" href="#">Menu</a>
    <header></header>
      <nav>
        <ul>
          <li><a href="personapais.php">Insertar Registro</a></li>
          <li><a href="lista.php">Ir a listado</a></li>
          <li><a href="menu.php">Ir a menu principal</a></li>
        </ul>
    </nav>
  </header>
  </li>
  <li><a href="#">Barrio</a></li>
  <li><a class="MenuBarItemSubmenu" href="#">Pais</a>
   
  </li>
</ul>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>