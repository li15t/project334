function check_all(){
var a = document.forms[0];
var i;
if(a[2].checked) 
{for (i = 0; i < a.length; i++) 
  a[i].checked=true;
}
else
{for (i = 0; i < a.length; i++) 
  a[i].checked=false;
}
}
