window.addEventListener( 'load', function () { uagbTabInit(); anchorTabId(); });
window.addEventListener( 'hashchange', anchorTabId, false );
	
function uagbTabInit(){
	var tabWrap = document.getElementsByClassName( 'uagb-tabs__wrap' );
	for ( var item = 0; item < tabWrap.length; item++ ) {
        
        var tabActive = tabWrap[item].getAttribute('data-tab-active');
        var tabLi = tabWrap[item].querySelectorAll( '.uagb-tabs__panel li.uagb-tab' );
        for ( var i = 0; i < tabLi.length; i++ ) {
            if(!tabLi[i].classList.contains("uagb-tabs__active")){
                if(tabActive == i){  
                    tabLi[i].classList.add('uagb-tabs__active');
                    tabWrap[item].classList.add( 'uagb-active-tab-'+i); 
                }else{
                    tabWrap[item].classList.add( 'uagb-active-tab-'+tabActive);
                }
                tabLi[i].setAttribute('id', 'uagb-tabs__tab'+i);
            }
        }
        var tabBody = tabWrap[item].querySelectorAll( '.uagb-tabs__body-wrap .uagb-tabs__body-container' );
        for ( var body = 0; body < tabBody.length; body++ ) {
            if(tabBody[body] == undefined){
                return
            }
            if(tabBody[body].classList.contains( '.uagb-tabs__inner-tab' )){
               
                tabBody[body].classList.add('uagb-inner-tab-'+body); 
            }
        }
		var tabList = tabWrap[item].querySelectorAll( '.uagb-tabs__panel li:not(.uagb-tabs__active) a' );
        for ( var tab = 0; tab < tabList.length; tab++ ) {
			tabList[tab].setAttribute('aria-selected', 'false');
		}
        
        var tabAnchor = tabWrap[item].querySelectorAll( '.uagb-tabs__panel li a' );
        for ( var a = 0; a < tabAnchor.length; a++ ) {
            if(!tabAnchor[a].classList.contains("uagb-tabs-list")){
                tabAnchor[a].classList.add('uagb-tabs-list');
                tabAnchor[a].setAttribute('data-tab', a);
            }
		}
		tabWrap[item].querySelector('.uagb-tabs__panel li.uagb-tabs__active a').setAttribute('aria-selected', 'true');
        
        var tabPanel = tabWrap[item].querySelectorAll('.uagb-tabs__panel li a');
       
        for ( var panel = 0; panel < tabPanel.length; panel++ ) {
			tabPanel[panel].addEventListener("click", function( e ) {
                tabClickEvent( e, this , this.parentElement , tabPanel.length);
            });
		}
         
    }
}
function tabClickEvent(e , tabName , list , count){

    e.preventDefault();
    
    var tabId = tabName.getAttribute( 'data-tab' );
    var mainWrap = list.closest( '.uagb-tabs__wrap' );
    
    for ( var idx = 0; idx < 15; idx++ ) {
        if(mainWrap.classList.contains('uagb-active-tab-'+idx)){
            mainWrap.classList.remove( 'uagb-active-tab-'+idx); 
        }else{
            mainWrap.classList.add('uagb-active-tab-'+ tabId);
        }

    }
    var listPanel = list.closest( '.uagb-tabs__panel' );

    var oldActiveTab = listPanel.querySelector( '.uagb-tabs__active' );
    oldActiveTab.classList.remove( 'uagb-tabs__active' );
    
    listPanel.querySelector( 'a.uagb-tabs-list' ).setAttribute( 
        'aria-selected', 'false'
    );

    list.classList.add( 'uagb-tabs__active' );

    tabName.setAttribute( 'aria-selected', 'true' );
    
   
    mainWrap.querySelector( '.uagb-tabs__body-wrap .uagb-tabs__body-container:not(.uagb-inner-tab-' + tabId + ')' ).setAttribute( 'aria-hidden', 'true' );
    mainWrap.querySelector( '.uagb-tabs__body-wrap .uagb-inner-tab-' + tabId ).setAttribute( 'aria-hidden', 'false' );

}
function anchorTabId() {
	if ( window.location.hash != '' && /^#uagb-tabs__tab\d$/.test( window.location.hash ) ) {
        var tabId = escape(window.location.hash.substring(1));
        var tabPanel = document.querySelector('#' + tabId );
        const topPos = tabPanel.getBoundingClientRect().top + window.pageYOffset
        window.scrollTo({
            top: topPos, 
            behavior: 'smooth' 
        })
        var tabNum = tabPanel.querySelector('a.uagb-tabs-list').getAttribute( 'data-tab' );
        var listPanel = tabPanel.closest( '.uagb-tabs__panel' );

        var oldActiveTab = listPanel.querySelector( '.uagb-tabs__active' );
        oldActiveTab.classList.remove( 'uagb-tabs__active' );

        listPanel.querySelector( 'a.uagb-tabs-list' ).setAttribute( 
            'aria-selected', 'false'
        );
        tabPanel.classList.add( 'uagb-tabs__active' );
        tabPanel.setAttribute( 'aria-selected', 'true' );

        var count = listPanel.getElementsByTagName("li").length;
        var mainWrap = tabPanel.closest( '.uagb-tabs__wrap' );
        for ( var idx = 0; idx < count; idx++ ) {
            mainWrap.classList.remove( 'uagb-active-tab-'+idx); 
        }
        mainWrap.classList.add('uagb-active-tab-'+tabNum)
        mainWrap.querySelector( '.uagb-tabs__body-wrap .uagb-tabs__body-container:not(.uagb-inner-tab-' + tabNum + ')' ).setAttribute( 'aria-hidden', 'true' );
        mainWrap.querySelector( '.uagb-tabs__body-wrap .uagb-inner-tab-' + tabNum ).setAttribute( 'aria-hidden', 'false' );
	}
}