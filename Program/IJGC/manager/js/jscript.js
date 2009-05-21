// JavaScript Document<script type="text/javascript">

/***********************************************
* AnyLink Drop Down Menu- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

//Contents for menu 1
var menu1=new Array()
menu1[0]='<a href="index.php?aksi=about">About Us</a>'
menu1[1]='<a href="index.php?aksi=alamat">Quick Facts</a>'
menu1[2]='<a href="index.php?aksi=contact">Contact Us</a>'
menu1[3]='<a href="index.php?aksi=visi">Vision & Mission</a>'
menu1[4]='<a href="index.php?aksi=become">How to Become a Member</a>'
menu1[5]='<a href="index.php?aksi=benefit">Benefit of Membership</a>'
menu1[6]='<a href="index.php?aksi=rules">Rules & Regulation</a>'
menu1[7]='<a href="index.php?aksi=etiket">Etiquette</a>'
menu1[8]='<a href="index.php?aksi=partner">How to Become Partner</a>'

var menu2=new Array()
menu2[0]='<a href="index.php?aksi=crtype">Course - Type</a>'
menu2[1]='<a href="index.php?aksi=crlist">Course - List</a>'
menu2[2]='<a href="index.php?aksi=crview">Course - View</a>'
menu2[3]='<a href="index.php?aksi=ranking">Tours - Setting</a>'
menu2[4]='<a href="index.php?aksi=touradmin">Tours - Admin</a>'
menu2[5]='<a href="index.php?aksi=tourlist">Tours - List of Event</a>'
menu2[6]='<a href="index.php?aksi=tourrest">Tours - View Result</a>'
menu2[7]='<a href="index.php?aksi=topranking">Top 10 Ranking</a>'
menu2[8]='<a href="index.php?aksi=conduct">Code of Conduct</a>'

var menu3=new Array()
menu3[0]='<a href="index.php?aksi=board">Board Manager</a>'
menu3[1]='<a href="index.php?aksi=galery">Galery Management</a>'

var menu4=new Array()
menu4[0]='<a href="index.php?aksi=news&kategori=1">Golf News</a>'
menu4[1]='<a href="index.php?aksi=news&kategori=2">Player News</a>'

var menu5=new Array()
menu5[0]='<a href="index.php?aksi=gamelist">Practice List</a>'
menu5[1]='<a href="index.php?aksi=gamestat">Match Statistic</a>'

var menu6=new Array()
menu6[0]='<a href="index.php?aksi=tip&kategori=1">Getting Started</a>'
menu6[1]='<a href="index.php?aksi=tip&kategori=2">For The Parents</a>'
menu6[2]='<a href="index.php?aksi=tip&kategori=3">Quick Fix</a>'
menu6[3]='<a href="index.php?aksi=tip&kategori=4">Golf Clinics</a>'
menu6[4]='<a href="index.php?aksi=tip&kategori=5">Golf Academies</a>'

var menu7=new Array()
menu7[0]='<a href="index.php?aksi=donor">How to Become Donors</a>'
menu7[1]='<a href="index.php?aksi=found&kategori=1">List Foundation</a>'

var menu8=new Array()
menu8[0]='<a href="index.php?aksi=users">Management User</a>'
menu8[1]='<a href="index.php?aksi=userm">Membership</a>'
menu8[2]='<a href="index.php?aksi=usrprofile">User Profile</a>'

var menuwidth='0px' //default menu width
var menubgcolor='#ffffff'  //menu bgcolor
var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var hidemenu_onclick="yes" //hide menu when user clicks within menu?

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

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
dropmenuobj.style.left=dropmenuobj.style.top="-500px"
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
	if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover"){
		obj.visibility="visible";
			//document.getElementById('clock').style.visibility="hidden"
	} else if (e.type=="click") {
		obj.visibility="hidden";
	}
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
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
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
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
	if (ie4||ns6){
	delayhide=setTimeout("hidemenu()",disappeardelay)
	}
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu