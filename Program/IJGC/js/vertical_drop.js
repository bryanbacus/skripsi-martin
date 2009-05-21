//Javascrip drop down menu

/***********************************************
* AnyLink Vertical Menu- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

//Contents for menu 1
var menu1=new Array()
menu1[0]='<a href="?page=visi">Vision & Mission</a>'
menu1[1]='<a href="?page=objective">Quick Facts</a>'
menu1[2]='<a href="?page=about">About Our Community</a>'
menu1[3]='<a href="?page=board&tipeP=1">Management Profile</a>'
menu1[4]='<a href="?page=board&tipeP=2">Board Of Director Profile</a>'
menu1[5]='<a href="?page=galery">IJGC Galery</a>'

//Contents for menu 2, and so on
var menu2=new Array()
menu2[0]='<a href="?page=become">How to Become a Member</a>'
menu2[1]='<a href="?page=benefit">Benefit of Membership</a>'
menu2[2]='<a href="?page=rules">Rules & Regulation</a>'
menu2[3]='<a href="?page=etiket">Etiquette</a>'
menu2[4]='<a href="?page=member">Form Application Membership Request</a>'

//Contents for menu 3, and so on
var menu3=new Array()
menu3[0]='<a href="?page=">List of Members</a>'

//Contents for menu 3, and so on
var menu4=new Array()
menu4[0]='<a href="?page=tourlist">List of Tournaments</a>'
menu4[1]='<a href="?page=conduct">Code of Conduct</a>'
menu4[2]='<a href="?page=tourlist&aksi2=register">Tournaments Registration</a>'
menu4[3]='<a href="?page=crview">List of Golf Course</a>'

//Contents for menu 3, and so on
var menu5=new Array()
menu5[0]='<a href="?page=tourrest">5 Last Tournaments Result</a>'
menu5[1]='<a href="?page=tourrest&aksi2=filter">Yearly Tournament Result Archieve</a>'
		
//Contents for menu 3, and so on
var menu6=new Array()
menu6[0]='<a href="?page=partner">How to Become Partners</a>'
menu6[1]='<a href="?page=partnerK&tipeP=1">National Partners</a>'
menu6[2]='<a href="?page=partnerK&tipeP=2">Official Partners</a>'
menu6[3]='<a href="?page=partnerK&tipeP=3">Event Sponsor</a>'

//Contents for menu 3, and so on
var menu7=new Array()
menu7[0]='<a href="?page=donor">How to Become Donors</a>'
menu7[1]='<a href="?page=found">List Of Foundation</a>'//Contents for menu 3, and so on

var menu8=new Array()
menu8[0]='<a href="?page=news&tipeP=1">Other News</a>'
menu8[1]='<a href="?page=news&tipeP=2">Player News</a>'

//Contents for menu 3, and so on
var menu9=new Array()
menu9[0]='<a href="?page=tips&tipeP=1">Getting Started</a>'
menu9[1]='<a href="?page=tips&tipeP=2">For The Parents</a>'
menu9[2]='<a href="?page=tips&tipeP=3">Quick Fix</a>'
menu9[3]='<a href="?page=tips&tipeP=4">Golf Clinics</a>'
menu9[4]='<a href="?page=tips&tipeP=5">Golf Academies</a>'

//Contents for menu 3, and so on
var menu10=new Array()
menu10[0]='<a href="?page=product&tipeP=1">Latest Products</a>'
menu10[1]='<a href="?page=product&tipeP=2">Conforming Product</a>'
menu10[2]='<a href="?page=product&tipeP=3">Product Exchange</a>'

var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var horizontaloffset=2 //horizontal offset of menu from default location. (0-5 is a good value)

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width: 160px" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x-obj.offsetWidth < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move menu up?
edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either? (position at top of viewable window then)
edgeoffset=dropmenuobj.y
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+horizontaloffset+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}
