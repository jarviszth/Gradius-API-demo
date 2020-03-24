/*for link url*/
function go(url, methodType, form_id){
	if(methodType=="post"){
		var form = document.getElementById(form_id);
		form.method = "post";
		form.action = url;
		form.submit();
	}else if(methodType=="get"){
		var form = document.getElementById(form_id);
		form.method = "get";
		form.action = url;
		form.submit();
	}else{
		window.location.href = url;
	}

}
function golink(url){

		window.location.href = url;

}
function goIframeParent(url){

	window.top.location.href = url;

}
//end link

function goComboSelect(sel, targetstr)
{
  var index = sel.selectedIndex;
  if (sel.options[index].value != '') {
     if (targetstr == 'blank') {
       window.open(sel.options[index].value, 'win1');
     } else {
       var frameobj;
       if (targetstr == '') targetstr = 'self';
       if ((frameobj = eval(targetstr)) != null)
         frameobj.location = sel.options[index].value;
     }
  }
}

//check box all
function checkAll(checkname, exby) {
	if( typeof checkname.length == 'undefined' ){
		checkname.checked = exby.checked? true:false
	}else{ 
		for (var i = 0; i < checkname.length; i++){
			checkname[i].checked = exby.checked? true:false
		}
	}
}
function countCheckbox(checkName){
	var count = 0;
	if( typeof checkName.length == "undefined" ){
			count = checkName.checked ? 1 : 0;
	}else{
		for (var idx = 0; idx < checkName.length; idx++) {
				count = count + checkName[idx].checked ? 1 : 0;
		}	
	}
	return count;
}
function multiDel(url, form_id){
	
	var form = document.getElementById(form_id);
	//if(countCheckbox(form.checkbox)==0){
		//alert("กรุณาเลือกข้อมูลที่ต้องการลบ");
		//return;
	//}
	//var agree=confirm("ยืนยันการลบข้อมูล?");
	//if (agree !=0){
			
			form.method = "post";
			form.action = url;
			form.submit();
	//}

}
//end check all



function popUpWindow(URL, N, W, H, S) { // name, width, height, scrollbars
	var winleft	=	(screen.width - W) / 2;
	var winup	=	(screen.height - H) / 2;
	winProp		=	'width='+W+',height='+H+',left='+winleft+',top='+winup+',scrollbars='+S+',resizable' + ',status=yes'
	Win			=	window.open(URL, N, winProp)
	if (parseInt(navigator.appVersion) >= 4) { Win.window.focus(); }
}

function lookupOpen(url, widht, height) {
	
	popUpWindow(url, 'SH1', widht, height, 'Yes');

}

function selectAllOptions(selStr)
{
  var selObj = document.getElementById(selStr);
  for (var i=0; i<selObj.options.length; i++) {
    selObj.options[i].selected = true;
  }
}

//Moving items from one multi-select box to another
function SelectMoveRows(S1,S2)
{
	var SS1 = document.getElementById(S1);
	 var SS2 = document.getElementById(S2);
    var SelID='';
    var SelText='';
    // Move rows from SS1 to SS2 from bottom to top
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            var newRow = new Option(SelText,SelID);
            SS2.options[SS2.length]=newRow;
            SS1.options[i]=null;
        }
    }
    SelectSort(SS2);
}
function SelectSort(SelList)
{
    var ID='';
    var Text='';
    for (x=0; x < SelList.length - 1; x++)
    {
        for (y=x + 1; y < SelList.length; y++)
        {
            if (SelList[x].text > SelList[y].text)
            {
                // Swap rows
                ID=SelList[x].value;
                Text=SelList[x].text;
                SelList[x].value=SelList[y].value;
                SelList[x].text=SelList[y].text;
                SelList[y].value=ID;
                SelList[y].text=Text;
            }
        }
    }
}

function getMultiple2()
{
	
	 var box1View = document.getElementById('box1View');
	 var box2View = document.getElementById("box2View");
	 var option = document.createElement("option");
	 
	 var selected = new Array();
	 var selectedText = new Array();
	 for (var i = 0; i < box1View.options.length; i++){
		  
		    if (box1View.options[ i ].selected){
		      	selected.push(box1View.options[ i ].value);
		      	selectedText.push(box1View.options[ i ].text);

		      	//add to box 2
		        var option = document.createElement("option");
		        option.text = box1View.options[ i ].text;
		        var sel = box1View.options[ i ].value;  
		        box2View.add(option, sel);

		      	
		      }
		  }
}

function chkNumber(ele)
{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
}
function hidenByCombo(sel,value,var_id){
	var index = sel.selectedIndex;
	var_hide_id = document.getElementById(var_id);
	if (sel.options[index].value == value) {
		var_hide_id.style.display = "none";
	}else{
		var_hide_id.style.display = "block";
	}
}
function addCssClassToId(id, cssClass){
	
	document.getElementById(id).className += cssClass;
	
}
function ConfDelete(object) {
	  
	  if (confirm("ยืนยันการลบ ?") == true) {
		return true;
	  }
	return false;
}
function limitMaxLength(Object, MaxLen)//onkeypress="return limitMaxLength(this, 101);"
{
  return (Object.value.length <= MaxLen);
}