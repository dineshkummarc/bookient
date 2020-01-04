// JavaScript Document
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='http://ankur.local/ci_singing_cop/application/views/admin/images/plus.gif' class='statusicon' />", "<img src='http://ankur.local/ci_singing_cop/application/views/admin/images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		myiframe=window.frames["myiframe"]
		if (expandedindices.length>0 && expandedindices[expandedindices.length-1]>=2)
			myiframe.location.replace(headers[expandedindices.pop()].getAttribute('href')) //Get "href" attribute of final expanded header to load into IFRAME
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		if (state=="block" && isuseractivated==true && index>=2){ //if header is expanded and as the result of the user initiated action
			myiframe.location.replace(header.getAttribute('href'))
		}
	}
})

