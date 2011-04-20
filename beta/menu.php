<script language="JavaScript1.2" type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

//-->
</script>

<div align="center">
<?php
if ($zalogowany)
{
    ?>
<table border="0" cellpadding="0" cellspacing="0" width="1276">
  <tr>
   <td colspan="13"><img name="menu_zal_fw_r1_c1" src="images/menu_zal_fw_r1_c1.gif" width="1276" height="14" border="0" id="menu_zal_fw_r1_c1" alt="" /></td>
  </tr>
  <tr>
   <td rowspan="2"><img name="menu_zal_fw_r2_c1" src="images/menu_zal_fw_r2_c1.gif" width="14" height="58" border="0" id="menu_zal_fw_r2_c1" alt="" /></td>
   <td><a href="logout.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c2','','images/menu_zal_fw_r2_c2_f2.gif',1);"><img name="menu_zal_fw_r2_c2" src="images/menu_zal_fw_r2_c2.gif" width="204" height="39" border="0" id="menu_zal_fw_r2_c2" alt="Wyloguj" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c3" src="images/menu_zal_fw_r2_c3.gif" width="15" height="58" border="0" id="menu_zal_fw_r2_c3" alt="" /></td>
   <td><a href="user.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c4','','images/menu_zal_fw_r2_c4_f2.gif',1);"><img name="menu_zal_fw_r2_c4" src="images/menu_zal_fw_r2_c4.gif" width="221" height="39" border="0" id="menu_zal_fw_r2_c4" alt="Moje Konto" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c5" src="images/menu_zal_fw_r2_c5.gif" width="17" height="58" border="0" id="menu_zal_fw_r2_c5" alt="" /></td>
   <td><a href="up.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c6','','images/menu_zal_fw_r2_c6_f2.gif',1);"><img name="menu_zal_fw_r2_c6" src="images/menu_zal_fw_r2_c6.gif" width="208" height="39" border="0" id="menu_zal_fw_r2_c6" alt="Wyślij pliki" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c7" src="images/menu_zal_fw_r2_c7.gif" width="19" height="58" border="0" id="menu_zal_fw_r2_c7" alt="" /></td>
   <td><a href="konkurs.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c8','','images/menu_zal_fw_r2_c8_f2.gif',1);"><img name="menu_zal_fw_r2_c8" src="images/menu_zal_fw_r2_c8.gif" width="159" height="39" border="0" id="menu_zal_fw_r2_c8" alt="Konkurs" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c9" src="images/menu_zal_fw_r2_c9.gif" width="19" height="58" border="0" id="menu_zal_fw_r2_c9" alt="" /></td>
   <td><a href="rules.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c10','','images/menu_zal_fw_r2_c10_f2.gif',1);"><img name="menu_zal_fw_r2_c10" src="images/menu_zal_fw_r2_c10.gif" width="197" height="39" border="0" id="menu_zal_fw_r2_c10" alt="Regulamin" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c11" src="images/menu_zal_fw_r2_c11.gif" width="18" height="58" border="0" id="menu_zal_fw_r2_c11" alt="" /></td>
   <td><a href="contact.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_zal_fw_r2_c12','','images/menu_zal_fw_r2_c12_f2.gif',1);"><img name="menu_zal_fw_r2_c12" src="images/menu_zal_fw_r2_c12.gif" width="159" height="39" border="0" id="menu_zal_fw_r2_c12" alt="Kontakt" /></a></td>
   <td rowspan="2"><img name="menu_zal_fw_r2_c13" src="images/menu_zal_fw_r2_c13.gif" width="26" height="58" border="0" id="menu_zal_fw_r2_c13" alt="" /></td>
  </tr>
  <tr>
   <td><img name="menu_zal_fw_r3_c2" src="images/menu_zal_fw_r3_c2.gif" width="204" height="19" border="0" id="menu_zal_fw_r3_c2" alt="" /></td>
   <td><img name="menu_zal_fw_r3_c4" src="images/menu_zal_fw_r3_c4.gif" width="221" height="19" border="0" id="menu_zal_fw_r3_c4" alt="" /></td>
   <td><img name="menu_zal_fw_r3_c6" src="images/menu_zal_fw_r3_c6.gif" width="208" height="19" border="0" id="menu_zal_fw_r3_c6" alt="" /></td>
   <td><img name="menu_zal_fw_r3_c8" src="images/menu_zal_fw_r3_c8.gif" width="159" height="19" border="0" id="menu_zal_fw_r3_c8" alt="" /></td>
   <td><img name="menu_zal_fw_r3_c10" src="images/menu_zal_fw_r3_c10.gif" width="197" height="19" border="0" id="menu_zal_fw_r3_c10" alt="" /></td>
   <td><img name="menu_zal_fw_r3_c12" src="images/menu_zal_fw_r3_c12.gif" width="159" height="19" border="0" id="menu_zal_fw_r3_c12" alt="" /></td>
  </tr>
</table>


<?php
}else{
?>
<table border="0" cellpadding="0" cellspacing="0" width="1276">
  <tr>
   <td><img src="images/spacer.gif" width="209" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="19" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="204" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="18" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="208" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="20" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="159" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="26" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="189" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="21" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="203" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>
  <tr>
   <td><a id="logmenu" href="zaloguj.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c1','','images/menu_nzal_r1_c1_f2.gif',1);"><img name="menu_nzal_r1_c1" src="images/menu_nzal_r1_c1.gif" width="209" height="72" border="0" id="menu_nzal_r1_c1" alt="Zaloguj" /></a></td>
   <td><img name="menu_nzal_r1_c2" src="images/menu_nzal_r1_c2.png" width="19" height="72" border="0" id="menu_nzal_r1_c2" alt="" /></td>
   <td><a id="addmenu" href="adduser.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c3','','images/menu_nzal_r1_c3_f2.png',1);"><img name="menu_nzal_r1_c3" src="images/menu_nzal_r1_c3.png" width="204" height="72" border="0" id="menu_nzal_r1_c3" alt="Zarejestruj" /></a></td>
   <td><img name="menu_nzal_r1_c4" src="images/menu_nzal_r1_c4.png" width="18" height="72" border="0" id="menu_nzal_r1_c4" alt="" /></td>
   <td><a href="up.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c5','','images/menu_nzal_r1_c5_f2.png',1);"><img name="menu_nzal_r1_c5" src="images/menu_nzal_r1_c5.png" width="208" height="72" border="0" id="menu_nzal_r1_c5" alt="Wyślij pliki" /></a></td>
   <td><img name="menu_nzal_r1_c6" src="images/menu_nzal_r1_c6.png" width="20" height="72" border="0" id="menu_nzal_r1_c6" alt="" /></td>
   <td><a href="konkurs.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c7','','images/menu_nzal_r1_c7_f2.png',1);"><img name="menu_nzal_r1_c7" src="images/menu_nzal_r1_c7.png" width="159" height="72" border="0" id="menu_nzal_r1_c7" alt="Konkurs" /></a></td>
   <td><img name="menu_nzal_r1_c8" src="images/menu_nzal_r1_c8.png" width="26" height="72" border="0" id="menu_nzal_r1_c8" alt="" /></td>
   <td><a href="rules.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c9','','images/menu_nzal_r1_c9_f2.png',1);"><img name="menu_nzal_r1_c9" src="images/menu_nzal_r1_c9.png" width="189" height="72" border="0" id="menu_nzal_r1_c9" alt="Regulamin" /></a></td>
   <td><img name="menu_nzal_r1_c10" src="images/menu_nzal_r1_c10.png" width="21" height="72" border="0" id="menu_nzal_r1_c10" alt="" /></td>
   <td><a href="contact.php" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('menu_nzal_r1_c11','','images/menu_nzal_r1_c11_f2.png',1);"><img name="menu_nzal_r1_c11" src="images/menu_nzal_r1_c11.png" width="203" height="72" border="0" id="menu_nzal_r1_c11" alt="Kontakt" /></a></td>
   <td><img src="images/spacer.gif" width="1" height="72" border="0" alt="" /></td>
  </tr>
</table>
<?php

}
?>
</div>
