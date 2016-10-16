function deactivatenavbar()
{
  var navbarheader=document.getElementById("header_navlist");
  var navbarlist=navbarheader.childNodes
  for (var i=0;i<navbarlist.length;i++)
  {
    navbarlist[i].className = "";
  }
}

// "Активирует" элемент навбара. Все id - на master.blade.php
function nav_activate(sectionlist)
{
  deactivatenavbar();
  var element=document.getElementById(sectionlist);
  element.className="active";
}
