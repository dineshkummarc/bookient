
isIphone = (/iphone/gi).test(navigator.appVersion); isIpad = (/ipad/gi).test(navigator.appVersion); isAndroid = (/android/gi).test(navigator.appVersion); isTouch = isIphone || isIpad || isAndroid;


function overlayGAdget() {


    function __apk() {
		var isIe7 = false;
        if (navigator.appVersion.indexOf("MSIE") != -1)
            isIe7 = true;
        if(window.pardcoHeight === undefined)
            pardcoHeight = '700';
        if(window.pardcoWidth === undefined)
            pardcoWidth = '900';
			
		if(window.pardcoDomain === undefined)
            pardcoDomain = 'pardco.com';	
        
        if(window.ShowSchedulemeImg === undefined)
            ShowSchedulemeImg = true; 
        //if showSchedulemeImg is set to false then it will override the properties below. This can be used if you want to call overlay from your own custom link.
        if(window.ScheduleMeBgImg === undefined)
            ScheduleMeBgImg = 'http:\/\/'+pardcoDomain+'/widget/images/schedule-an-appointment.png';
        if(window.ScheduleMeBg === undefined)
            ScheduleMeBg = '#000000';       
        if(window.ScheduleMeWidth === undefined)
            ScheduleMeWidth = '50';
        if(window.ScheduleMeHeight === undefined)
            ScheduleMeHeight = '350';
        if(window.ScheduleMePosition === undefined)
            ScheduleMePosition = 'right';

        if (window.AppointyExtraParameter === undefined)
            AppointyExtraParameter = '';
			
        
        

        var acn_ = document.getElementsByTagName('body')[0];

        var ae_ = __apl();
        var aco_ = document.createElement('div');
        aco_.setAttribute('id', 'pardcoOverlayGdOv');
        aco_.setAttribute('style', 'position: fixed; top: 0px; left: 0px; 	filter: alpha(opacity=30);	-moz-opacity: 0.3;	opacity: 0.3; background-color: rgb(0, 0, 0); z-index: 2000000003; width: 100%; height: ' + ae_[1] + 'px; display: none;');

        
        if (isIe7) {
            aco_.style.position = 'absolute';
            aco_.style.left = '0px';
            aco_.style.top = '0';
            aco_.style.filter = 'alpha(opacity=30)';
            aco_.style.backgroundColor = 'rgb(0, 0, 0)';
            aco_.style.zIndex = '2000000003';
            aco_.style.width = '100%';
            aco_.style.height = ae_[1] + 'px';
            aco_.style.display = 'none';
        }

        //aco_.style.display = 'none';
        acn_.appendChild(aco_);
        //aco_.style.height= ae_[1]+'px';


        var acp_ = document.createElement('div');
        acp_.setAttribute('id', 'pardcoOverlayGdIf');
        acp_.setAttribute('style', '-moz-border-radius: 5px 5px 5px 5px; -moz-box-shadow: 3px 3px 3px #CCCCCC;	-webkit-border-radius: 0px 0px 4px 4px;	-webkit-box-shadow: 3px 3px 3px #ddd;    background-color: #F4F4F4; border: 2px solid #CCCCCC; left: 50%; margin-left: -'+ pardcoWidth/2 +'px;    padding: 10px; position: absolute; top: 50px; width: ' + pardcoWidth + 'px; z-index: 2000000004;    display: none; background-image:url(http:\/\/'+pardcoDomain+'/widget/images/loading.gif);background-repeat:no-repeat;background-position:center center');
        

		
		
		acp_.innerHTML = '<iframe src="" frameborder="0" id="pardcoOvIfram" style="width:'+ pardcoWidth +'px; height: '+ pardcoHeight +'px; border: 0px;"></iframe>';

        if (isIe7) {
            acp_.style.backgroundColor = '#F4F4F4';
            acp_.style.border = '2px solid #CCCCCC';
            acp_.style.left = '50%';
            acp_.style.marginLeft = -pardcoWidth / 2 + 'px';
            acp_.style.padding =  '10px';
            acp_.style.position = 'absolute';
            acp_.style.top = '50px';
            acp_.style.width = pardcoWidth + 'px';
            acp_.style.zIndex = '2000000004';
            acp_.style.display = 'none';
            acp_.style.backgroundImage = 'url(http:\/\/'+pardcoDomain+'/widget/images/loading.gif)';
            acp_.style.backgroundRepeat = 'no-repeat';
            acp_.style.backgroundPosition = 'center center';
        }
        
		
		if(isTouch){
		
            acp_.style.left = '0%';
            acp_.style.marginLeft = '0px';
            acp_.style.width =   '100%';		
			
            acp_.style.padding =  '0px';
		}
		
		
        acn_.appendChild(acp_);
		
		
		if(isTouch){
		
            document.getElementById('pardcoOvIfram').style.width =   '100%';		
		}
		
        var iframClosSp = document.createElement('span');
        iframClosSp.setAttribute('style', 'background-image: url(http:\/\/'+pardcoDomain+'/widget/images/buttonClose1.gif); background-position: left top;        background-repeat: no-repeat; cursor: pointer; padding: 12px; position: absolute;        right: -15px; top: -15px; z-index: 2000000005;');

        if (isIe7) {
            iframClosSp.style.backgroundImage = 'url(http:\/\/'+pardcoDomain+'/widget/images/buttonClose1.gif)';
            iframClosSp.style.backgroundPosition = 'left top';
            iframClosSp.style.backgroundRepeat = 'no-repeat';
            iframClosSp.style.cursor = 'pointer';
            iframClosSp.style.padding = '12px';
            iframClosSp.style.position = 'absolute';
            iframClosSp.style.right = '-15px';
            iframClosSp.style.top = '-15px';
            iframClosSp.style.zIndex = '2000000005';
        }
        acp_.appendChild(iframClosSp);

        
        var acq_ = document.createElement('div');
        acq_.setAttribute('id', 'appScheduleMeBt');
		acq_.innerHTML = 'Appointment Scheduling Software';
        acq_.setAttribute('style', 'background-color:' + ScheduleMeBg + '; background-image: url('+ScheduleMeBgImg+');        color: #FFFFFF; cursor: pointer; height: '+ScheduleMeHeight+'px; '+ScheduleMePosition+': -3px;		margin-left: -7px; overflow: hidden; background-repeat:no-repeat; position: fixed; text-indent: -100000px; top: 25%; width: '+ScheduleMeWidth+'px; z-index: 100000;');
		
        
        if (isIe7) {
            acq_.style.backgroundColor = ScheduleMeBg;
            acq_.style.backgroundImage = 'url(' + ScheduleMeBgImg + ')';
            acq_.style.color = '#FFFFFF';
            acq_.style.cursor = 'pointer';
            acq_.style.height = ScheduleMeHeight + 'px';
            acq_.style[ScheduleMePosition] = '-3px';
            acq_.style.marginLeft = '-7px';
            acq_.style.overflow = 'hidden';
            acq_.style.backgroundRepeat = 'no-repeat';
            acq_.style.position = 'fixed';
            acq_.style.textIndent = '-10000000px';
            acq_.style.top = '25%';
            acq_.style.width = ScheduleMeWidth + 'px';
            acq_.style.zIndex = '1000000';
        }
		/*
		acq_.style.backgroundColor=ScheduleMeBg;
		acq_.style.backgroundImage='url('+ScheduleMeBgImg+')';
		acq_.style.color='#FFFFFF';
		acq_.style.cursor='pointer';
		acq_.style.height=ScheduleMeHeight+'px';
		acq_.style[ScheduleMePosition]='-3px';
		acq_.style.marginLeft='-7px';
		acq_.style.overflow='hidden';
		acq_.style.backgroundRepeat='no-repeat';
		acq_.style.position='fixed';
		acq_.style.textIndent='-10000000px';
		acq_.style.top='25%';
		acq_.style.width=ScheduleMeWidth+'px';
		acq_.style.zIndex='1000000';
		*/
		//acq_.setAttribute('style', 'background-color:' + ScheduleMeBg + '; background-image: url('+ScheduleMeBgImg+');        color: #FFFFFF; cursor: pointer; height: '+ScheduleMeHeight+'px; '+ScheduleMePosition+': -3px; margin-left: -7px; overflow: hidden; background-repeat:no-repeat; position: fixed; text-indent: -100000px; top: 25%; width: '+ScheduleMeWidth+'px; z-index: 100000;');
        
        if(!ShowSchedulemeImg)
            acq_.style.display='none';
            
        acn_.appendChild(acq_);

        acq_.onclick = function () { document.documentElement.scrollTop = '0px'; acp_.style.display = ''; aco_.style.display = ''; document.getElementById('pardcoOvIfram').src = 'http:\/\/' + pardco + '.'+pardcoDomain+'/?isgadget=1&'+AppointyExtraParameter }
        iframClosSp.onclick = function () { acp_.style.display = 'none'; aco_.style.display = 'none'; document.getElementById('pardcoOvIfram').src='' }
    }




    function __apl() {
        var xScroll, yScroll;
        if (window.innerHeight && window.scrollMaxY) {

            xScroll = document.body.scrollWidth;
            yScroll = window.innerHeight + window.scrollMaxY;
        } else if (document.body.scrollHeight > document.body.offsetHeight) {

            xScroll = document.body.scrollWidth;
            yScroll = document.body.scrollHeight;
        } else {
            //document.documentElement.scrollHeight;
            xScroll = document.documentElement.offsetWidth;
            yScroll = document.documentElement.scrollHeight;
        }
        var windowWidth, windowHeight;
        if (self.innerHeight) {
            windowWidth = self.innerWidth;
            windowHeight = self.innerHeight;
        } else if (document.documentElement && document.documentElement.clientHeight) {
            windowWidth = document.documentElement.clientWidth;
            windowHeight = document.documentElement.clientHeight;
        } else if (document.body) {
            windowWidth = document.body.clientWidth;
            windowHeight = document.body.clientHeight;
        }
        if (yScroll < windowHeight) {
            pageHeight = windowHeight;
        } else {
            pageHeight = yScroll;
        }
        if (xScroll < windowWidth) {
            pageWidth = windowWidth;
        } else {
            pageWidth = xScroll;
        }

        arrayPageSize = new Array(pageWidth, pageHeight, windowWidth, windowHeight);
        return arrayPageSize;
    };
     
        __apk();
}
window.onload = function () { overlayGAdget() };

function ShowPardcoInOverlay()
{
    if(document.getElementById('appScheduleMeBt').click)
        document.getElementById('appScheduleMeBt').click();
    else
        document.getElementById('appScheduleMeBt').onclick();
}