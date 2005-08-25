// GPL applies
// (C) 2005 Dryw Filtiarn, Maxim Mueller
function menuX(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	return curleft;
}

function showMenu( parent, child ) {  
	var childRef = document.getElementById(child);
	
	if( childRef ) { 
		childRef.style.left = menuX(parent) + "px";
		//modern browsers only, sorry
		if (document.defaultView) {
			childRef.style.backgroundColor = document.defaultView.getComputedStyle(parent, '').getPropertyValue('background-color');
		}
		childRef.style.visibility = 'visible'; 
	}  
} 
 
function keepMenu( child ) { 
	child.style.visibility = 'visible'; 
} 
 
function hideMenu( child ) { 
	child.style.visibility = 'hidden'; 
} 