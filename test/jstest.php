<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
         <script type="text/javascript">
             var y=0;
             var f=false;
             var tout;
             var openelemid=0;
             var atwork=false;
function changeheight(elemid)
{
e=document.getElementById(elemid);
if(atwork==false)
    {
if(elemid!=0 && openelemid!=0)
    {
        if(elemid==openelemid)
            {
                f=true;
                atwork=true;
            }else
                {
                    atwork=true;
                    changeheight(openelemid);
                    f=false;
                    
                }

    }
    }
if(y<5&&f==true){f=false;atwork=false;openelemid=0;return;}
if(y>95&&f==false){f=true;atwork=false;openemelid=elemid;return;}
if(f==false)y=y+5;
if(f==true)y=y-5;
e.style.height=y + 'px';
tout=setTimeout("changeheight('"+elemid+"')",10);
}
</script>

    </head>
    <body>
    
        <a href="javascript:void(0)" onClick="changeheight('d1');">Change height 1.</a>
        <a href="javascript:void(0)" onClick="changeheight('d2');">Change height 2.</a>
        
<div id="d1" style="position: relative; height: 0px; background-color: red; overflow: hidden">
    <td>
    To jest test DIV'a<br />
    Kolejna linijka DIV'a<br />
    I trzecia linijka<br />
    Na tym koniec.
    </td>
</div>
                    
<div id="d2" style="position: relative; height: 0px; background-color: blue; overflow: hidden">
    
    To jest test DIV'a<br />
    Kolejna linijka DIV'a<br />
    I trzecia linijka<br />
    Na tym koniec.
    </div>
            </body>
</html>
