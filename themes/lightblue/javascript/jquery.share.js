/**
 * jQuery.share - social media sharing plugin
 * ---
 * @author Carol Skelly (http://in1.com)
 * @version 1.0
 * @license MIT license (http://opensource.org/licenses/mit-license.php)
 * ---
 */

function ShowMyName(imgUrl,pageTitle,desc) { 
	
	alert(imgUrl);
	FB.init({
        appId: '833365473353575',
        status: true, 
        cookie: true, 
        xfbml: true
    });    
        /*FB.api("/me",
                function (response) {
                    alert('Name is ' + response.name + ' link' + response.link + ' username' + response.username + ' id' + response.id + ' email' + response.email);
                });*/

        
        
        FB.ui(
        		  {
        		   method: 'stream.publish',
        		   name: pageTitle,
        		   //caption: 'Bringing Facebook to the desktop and mobile web',
        		  description: (
        				   desc
        		   ),
        		   link: imgUrl,//"http://www.nz.com/collections/infinity",
        		   picture:  imgUrl
        		  },
        		  function(response) { 
        		    if (response && response.post_id) {
        		      //alert('Post was published.');
        		      window.location = "?action=update_facebook"; 
        		    } else {
        		      alert('Post was not published.');
        		    }
        		  }
        		);
         
    }
    

;(function ( $, window, undefined ) {
    
    var document = window.document;
    
    $.fn.share = function(method) {

        var methods = {

            init : function(options) { 
                this.share.settings = $.extend({}, this.share.defaults, options);
                var settings = this.share.settings,
                    networks = this.share.settings.networks,
                    theme = this.share.settings.theme,
                    orientation = this.share.settings.orientation,
                    affix = this.share.settings.affix,
                    margin = this.share.settings.margin,
                    pageTitle = this.share.settings.title||$(document).attr('title'),
                    pageUrl = this.share.settings.urlToShare||$(location).attr('href'),
                    pageDesc = "";
                
                $.each($(document).find('meta[name="description"]'),function(idx,item){
                    pageDesc = $(item).attr("content");
        		});
                
                // each instance of this plugin
                return this.each(function(i) {
                    var $element = $(this),
                        id=$element.attr("id"),
                        u=encodeURIComponent(pageUrl),
                        t=encodeURIComponent(pageTitle),
                        d=pageDesc.substring(0,250),
                        href;
                    var mydiv = jQuery('.mydiv:eq('+i+')');
                    if(mydiv.parents().eq(9).find("div").hasClass('photos-wrapper') )
           			 var image_url = url_img= mydiv.parents().eq(9).find("div.photos-wrapper img").attr('src');
           		 else if(mydiv.parents().eq(9).find("div").hasClass('text-wrapper'))
           			 var image_url = url_img= mydiv.parents().eq(9).find("div.text-wrapper").html();
           		 else if(mydiv.parents().eq(9).find("div").hasClass('youtube-wrapper') )
           			 var image_url = url_img= mydiv.parents().eq(9).find("div.youtube-wrapper iframe").attr('src');
           		
                    //alert(i + image_url);
                	//$element.attr("class").parent().parent().prev().find("a.promo").attr('href');
                    // append HTML for each network button
                    for (var item in networks) {
                        item = networks[item];
                        href = helpers.networkDefs[item].url;
                        href = href.replace('|u|',u).replace('|t|',t).replace('|d|',d)
                                   .replace('|140|',t.substring(0,130));
                        if(item=='facebook'){
                        	
                        	$("<a onclick=\"javascript:ShowMyName('"+image_url+"','"+pageTitle+"','"+d+"')\" title='Share this page on "+item+
                                    "' class='pop_f share-"+theme+" share-"+theme+"-"+item+"'></a>")
                                    .appendTo($element);
                        }else{
                        $("<a href='"+href+"' title='Share this page on "+item+
                            "' class='pop share-"+theme+" share-"+theme+"-"+item+"'></a>")
                            .appendTo($element);
                        }
                    }
                    
                    // customize css
                    $("#"+id+".share-"+theme).css('margin',margin);
                    
                    if (orientation != "horizontal"){
                        $("#"+id+" a.share-"+theme).css('display','block');
                    }
                    else {
                        $("#"+id+" a.share-"+theme).css('display','inline-block');
                    }
                    
                    if (typeof affix != "undefined"){
                        $element.addClass('share-affix');
                        if (affix.indexOf('right')!=-1){
                            $element.css('left','auto');
                            $element.css('right','0px');
                            if (affix.indexOf('center')!=-1){
                                $element.css('top','40%');
                            }
                        }
                        else if (affix.indexOf('left center')!=-1){
                            $element.css('top','40%');
                        }
                        
                        if (affix.indexOf('bottom')!=-1){
                            $element.css('bottom','0px');
                            $element.css('top','auto');
                            if (affix.indexOf('center')!=-1){
                                $element.css('left','40%');
                            }
                        }
                    }
                    
                    // bind click
                    $('.pop').click(function(i){ 
                    		var title_f=jQuery(this).attr('title');
                    		if(title_f == 'Share this page on facebook'){ alert(1);
                    			var url=jQuery(this).attr('onclick');
                       		 var image_url = url_img=jQuery(this).parent().parent().parent().prev().find("a.promo").attr('href');
                       		 
                       		 var url1 = url.replace("image_url", url_img);
                       		 //jQuery(this).removeAttr('href');
                       		 jQuery(this).attr('onclick',url1);
                    		}else{ //alert(2);
                    		 var url=jQuery(this).attr('href');
                    		 
                    		 
                    		 //alert(jQuery(this).parents().eq(9).find("div.text-wrapper").html());
                    		 if(jQuery(this).parents().eq(9).find("div").hasClass('photos-wrapper') )
                    			 var image_url = url_img= jQuery(this).parents().eq(9).find("div.photos-wrapper img").attr('src');
                    		 else if(jQuery(this).parents().eq(9).find("div").hasClass('text-wrapper'))
                    			 var image_url = url_img= jQuery(this).parents().eq(9).find("div.text-wrapper").html();
                    		 else if(jQuery(this).parents().eq(9).find("div").hasClass('youtube-wrapper') )
                    			 var image_url = url_img= jQuery(this).parents().eq(9).find("div.youtube-wrapper iframe").attr('src');
                    		 
                    		 var url1 = url.replace("image_url", url_img);
                    		 jQuery(this).attr('href',url1);
                    		}
                    		 //alert(jQuery(this).attr('href'));
                    		 
                        window.open($(this).attr('href'),'t','toolbar=0,resizable=1,status=0,width=640,height=528');
                        return false;
                    });
                    
                    
                });// end plugin instance
                
            }        
        }
        var gmail_text = encodeURI('Hey! \n\nI found this on nazraanajewellery.com. What do you think about it? \n\n');
        var gmail_link = encodeURI('\n\n\n Via www.nazraanajewellery.com');
        var helpers = {
            networkDefs: {
                facebook:{url:'http://www.facebook.com/share.php?u=|u|'},
                //http://twitter.com/home?status=jQuery%20Share%20Social%20Media%20Plugin%20-%20Share%20to%20multiple%20social%20networks%20from%20a%20single%20form%20http://plugins.in1.com/share/demo
                twitter:{url:'https://twitter.com/share?url=|u|&text=|140|'},
                linkedin:{url:'http://www.linkedin.com/shareArticle?mini=true&url=|u|&title=|t|&summary=|d|&source=in1.com'},
                in1:{url:'http://www.in1.com/cast?u=|u|',w:'490',h:'529'},
                tumblr:{url:'http://www.tumblr.com/share?v=3&u=|u|'},
                digg:{url:'http://digg.com/submit?url=|u|&title=|t|'},
                googleplus:{url:'https://plusone.google.com/_/+1/confirm?hl=en&url=|u|'},
                reddit:{url:'http://reddit.com/submit?url=|u|'},
                pinterest:{url:'http://pinterest.com/pin/create/button/?media=|u|&url=|t|&description=|d|'},
                posterous:{url:'http://posterous.com/share?linkto=|u|&title=|t|'},
                stumbleupon:{url:'http://www.stumbleupon.com/submit?url=|u|&title=|t|'},
                email:{url:'https://mail.google.com/mail/?view=cm&fs=1&tf=1&shva=1&to=&su=|t|&body=' + gmail_text + '|d|%0D%0D|u|' + gmail_link}
            }
        }
     
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error( 'Method "' +  method + '" does not exist in social plugin');
        }

    }

    $.fn.share.defaults = {
        networks: ['facebook','twitter','linkedin'],
        theme: 'icon', // use round icons sprite
        autoShow: true,
        margin: '3px',
        orientation: 'horizontal',
        useIn1: false
    }

    $.fn.share.settings = {}
        
})(jQuery, window);
