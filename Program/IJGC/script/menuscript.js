<!--Links used to initiate the sub menus. Pass in the desired submenu index numbers (ie: 0, 1) -->
<a href="http://www.javascriptkit.com" onMouseover="showit(0)">JavaScript Kit</a> | <a href="http://freewarejava.com" onMouseover="showit(1)">Freewarejava</a><br>

<!-- Edit the dimensions of the below, plus background color-->
<ilayer width=400 height=32 name="dep1" bgColor="#E6E6FF">
<layer name="dep2" width=400 height=32>
</layer>
</ilayer>
<div id="describe" style="background-color:#E6E6FF;width:400px;height:32px" onMouseover="clear_delayhide()" onMouseout="resetit(event)"></div>


<script language="JavaScript1.2">

/*
Tabs Menu (mouseover)- By Dynamic Drive
For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
This credit MUST stay intact for use
*/

var submenu=new Array()

//Set submenu contents. Expand as needed. For each content, make sure everything exists on ONE LINE. Otherwise, there will be JS errors.
 
submenu[0]='<font size="2" face="Verdana"><b><a href="http://www.javascriptkit.com/cutpastejava.shtml">Scripts</a> | <a href="http://www.javascriptkit.com/javaindex.shtml">JS tutorials</a> | <a href="http://www.javascriptkit.com/javatutors/index.shtml">Advanced JS tutorials</a> | <a href="http://www.javascriptkit.com/java/">Applets</a> | <a href="http://www.javascriptkit.com/howto/">Web Tutorials</a></b></font>'

submenu[1]='<font size="2" face="Verdana"><b><a href="http://freewarejava.com/applets/index.shtml">Applets</a> | <a href="http://freewarejava.com/tutorials/index.shtml">Tutorials</a> | <a href="http://freewarejava.com/javasites/index.shtml">Sites and Zines</a> | <a href="http://freewarejava.com/jsp/index.shtml">JSP</a></b></font>'

//Set delay before submenu disappears after mouse moves out of it (in milliseconds)
var delay_hide=500

/////No need to edit beyond here

var menuobj=document.getElementById? document.getElementById("describe") : document.all? document.all.describe : document.layers? document.dep1.document.dep2 : ""

function showit(which){
clear_delayhide()
thecontent=(which==-1)? "" : submenu[which]
if (document.getElementById||document.all)
menuobj.innerHTML=thecontent
else if (document.layers){
menuobj.document.write(thecontent)
menuobj.document.close()
}
}

function resetit(e){
if (document.all&&!menuobj.contains(e.toElement))
delayhide=setTimeout("showit(-1)",delay_hide)
else if (document.getElementById&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhide=setTimeout("showit(-1)",delay_hide)
}

function clear_delayhide(){
if (window.delayhide)
clearTimeout(delayhide)
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

</script>