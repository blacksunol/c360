/****************************************************************************************/ 
/* Project: NOVA                                                               */
/* Date: 20/01/2013                                                                     */
/* Author: HUNGAZ - Viet AZ  Co., Ltd                                                   */
/****************************************************************************************/ 
//top menu


(function($) {
    $.fn.resizeImg = function(options) {
 
        var settings = $.extend({
            scale: 1,
            maxWidth: null,
			maxHeight: null
        }, options);
 
        //return this.each(function() {
		$(this).one('load', function() {
			if(this.tagName.toLowerCase() != "img") {
				// Only images can be resized
				return $(this);
			} 
            
			var width = this.naturalWidth;
			var height = this.naturalHeight;
            //alert(width);
			if(!width || !height) {
				// Ooops you are an IE user, let's fix it.
				var img = document.createElement('img');
				img.src = this.src;
                
                width = img.width;
				height = img.height;
			}
			
			if(settings.scale != 1) {
				width = width*settings.scale;
				height = height*settings.scale;
			}
			
			var pWidth = 1;
			if(settings.maxWidth != null) {
				pWidth = width/settings.maxWidth;
			}
			var pHeight = 1;
			if(settings.maxHeight != null) {
				pHeight = height/settings.maxHeight;
			}
			var reduce = 1;
			
			if(pWidth < pHeight) {
				reduce = pHeight;
			} else {
				reduce = pWidth;
			}
			
			if(reduce < 1) {
				reduce = 1;
			}
			
			var newWidth = width/reduce;
			var newHeight = height/reduce;
			
			return $(this)
				.attr("width", newWidth)
				.attr("height", newHeight);
			
            }).each(function(){
                if (this.complete){
                    $(this).trigger("load");
                }
            });
    }
})(jQuery);
(function (e, t, n) {
    "use strict";
    e.fn.backstretch = function (n, r) {
        return e(t).scrollTop() === 0 && t.scrollTo(0, 0), this.each(function () {
            var t = e(this),
                s = t.data("backstretch");
            s && (r = e.extend(s.options, r), s.destroy(!0)), s = new i(this, n, r), t.data("backstretch", s)
        })
    }, e.backstretch = function (t, n) {
        return e("body").backstretch(t, n).data("backstretch")
    }, e.expr[":"].backstretch = function (t) {
        return e(t).data("backstretch") !== n
    }, e.fn.backstretch.defaults = {
        centeredX: !0,
        centeredY: !0,
        duration: 5e3,
        fade: 0
    };
    var r = {
        wrap: {
            left: 0,
            top: 0,
            overflow: "hidden",
            margin: 0,
            padding: 0,
            height: "100%",
            width: "100%",
            zIndex: -999999
        },
        img: {
            position: "absolute",
            display: "none",
            margin: 0,
            padding: 0,
            border: "none",
            width: "auto",
            height: "auto",
            maxWidth: "none",
            zIndex: -999999
        }
    }, i = function (n, i, o) {
        this.options = e.extend({}, e.fn.backstretch.defaults, o || {}), this.images = e.isArray(i) ? i : [i], e.each(this.images, function () {
            e("<img />")[0].src = this
        }), this.isBody = n === document.body, this.$container = e(n), this.$wrap = e('<div class="backstretch"></div>').css(r.wrap).appendTo(this.$container), this.$root = this.isBody ? s ? e(t) : e(document) : this.$container;
        if (!this.isBody) {
            var u = this.$container.css("position"),
                a = this.$container.css("zIndex");
            this.$container.css({
                position: u === "static" ? "relative" : u,
                zIndex: a === "auto" ? 0 : a,
                background: "none"
            }), this.$wrap.css({
                zIndex: -999998
            })
        }
        this.$wrap.css({
            position: this.isBody && s ? "fixed" : "absolute"
        }), this.index = 0, this.show(this.index), e(t).on("resize.backstretch", e.proxy(this.resize, this)).on("orientationchange.backstretch", e.proxy(function () {
            this.isBody && t.pageYOffset === 0 && (t.scrollTo(0, 1), this.resize())
        }, this))
    };
    i.prototype = {
        resize: function () {
            try {
                var e = {
                    left: 0,
                    top: 0
                }, n = this.isBody ? this.$root.width() : this.$root.innerWidth(),
                    r = n,
                    i = this.isBody ? t.innerHeight ? t.innerHeight : this.$root.height() : this.$root.innerHeight(),
                    s = r / this.$img.data("ratio"),
                    o;
                s >= i ? (o = (s - i) / 2, this.options.centeredY && (e.top = "-" + o + "px")) : (s = i, r = s * this.$img.data("ratio"), o = (r - n) / 2, this.options.centeredX && (e.left = "-" + o + "px")), this.$wrap.css({
                    width: n,
                    height: i
                }).find("img:not(.deleteable)").css({
                    width: r,
                    height: s
                }).css(e)
            } catch (u) {}
            return this
        },
        show: function (t) {
            if (Math.abs(t) > this.images.length - 1) return;
            this.index = t;
            var n = this,
                i = n.$wrap.find("img").addClass("deleteable"),
                s = e.Event("backstretch.show", {
                    relatedTarget: n.$container[0]
                });
            return clearInterval(n.interval), n.$img = e("<img />").css(r.img).bind("load", function (t) {
                var r = this.width || e(t.target).width(),
                    o = this.height || e(t.target).height();
                e(this).data("ratio", r / o), n.resize(), e(this).fadeIn(n.options.fade || n.options.speed, function () {
                    i.remove(), n.paused || n.cycle(), n.$container.trigger(s)
                })
            }).appendTo(n.$wrap), n.$img.attr("src", n.images[t]), n
        },
        next: function () {
            return this.show(this.index < this.images.length - 1 ? this.index + 1 : 0)
        },
        prev: function () {
            return this.show(this.index === 0 ? this.images.length - 1 : this.index - 1)
        },
        pause: function () {
            return this.paused = !0, this
        },
        resume: function () {
            return this.paused = !1, this.next(), this
        },
        cycle: function () {
            return this.images.length > 1 && (clearInterval(this.interval), this.interval = setInterval(e.proxy(function () {
                this.paused || this.next()
            }, this), this.options.duration)), this
        },
        destroy: function (n) {
            e(t).off("resize.backstretch orientationchange.backstretch"), clearInterval(this.interval), n || this.$wrap.remove(), this.$container.removeData("backstretch")
        }
    };
    var s = function () {
        var e = navigator.userAgent,
            n = navigator.platform,
            r = e.match(/AppleWebKit\/([0-9]+)/),
            i = !! r && r[1],
            s = e.match(/Fennec\/([0-9]+)/),
            o = !! s && s[1],
            u = e.match(/Opera Mobi\/([0-9]+)/),
            a = !! u && u[1],
            f = e.match(/MSIE ([0-9]+)/),
            l = !! f && f[1];
        return !((n.indexOf("iPhone") > -1 || n.indexOf("iPad") > -1 || n.indexOf("iPod") > -1) && i && i < 534 || t.operamini && {}.toString.call(t.operamini) === "[object OperaMini]" || u && a < 7458 || e.indexOf("Android") > -1 && i && i < 533 || o && o < 6 || "palmGetResource" in t && i && i < 534 || e.indexOf("MeeGo") > -1 && e.indexOf("NokiaBrowser/8.5.0") > -1 || l && l <= 6)
    }()
})(jQuery, window);

(function($){
	$.fn.imgCenter = function(options) {

		var defaults = {  
		  	parentSteps: 0,
		  	scaleToFit: true,
		  	centerVertical: true,
		  	complete: function(){},
		  	start: function(){},
		  	end: function(){}
	  	};  
	 	var opts = $.extend(defaults, options);
	 	
		opts.start.call(this);
		
		// Get total number of items.
		var len = this.length - 1;
		
		return this.each(function(i){
			var current = i;
			
			// Declare the current Image as a variable.
			var org_image = $(this);
			
			org_image.hide();
			
			// Move up Parents until the spcified limit has been met.
			var theParent = org_image;
			for (var i=0; i <= opts.parentSteps; i++){
				theParent = theParent.parent();
			}			
			var parWidth = parseInt(theParent.width());
			var parHeight = parseInt(theParent.height());
			var parAspect = parWidth / parHeight;

			if(org_image[0].complete){
				imgMath(org_image);
			} else {
				var loadWatch = setInterval(watch, 500);
			}
			
			function watch(){
				if(org_image[0].complete){
					clearInterval(loadWatch);
					imgMath(org_image);
				}
			}

			function imgMath(org_image) {
				// Get image properties.		
				var imgWidth = parseInt(org_image.width());
				var imgHeight = parseInt(org_image.height());
				var imgAspect = imgWidth / imgHeight;
	
				// Center the image.
				if(parWidth != imgWidth || parHeight != imgHeight){
					theParent.css("overflow","hidden");
					
					if(opts.scaleToFit){
						if(parAspect >= 1){
							org_image.css({"width": parWidth +"px"});
							imgWidth = parWidth;
							imgHeight = Math.round(imgWidth / imgAspect);
							
							if((parWidth / imgAspect) < parHeight){
								org_image.css({"height": parHeight +"px","width":"auto"});
								imgHeight = parHeight;
								imgWidth = Math.round(imgHeight * imgAspect);
							}				
						} else {
							org_image.css({"height": parHeight +"px"});
							imgHeight = parHeight;
							imgWidth = Math.round(imgHeight * imgAspect);
							if((parHeight * imgAspect) < parWidth){
								org_image.css({"width": parWidth +"px","height":"auto"});
								imgWidth = parWidth;
								imgHeight = Math.round(imgWidth / imgAspect);
							}
						}
						if(imgWidth > parWidth){
							org_image.css({"margin-left":"-"+ Math.round((imgWidth - parWidth) / 2) +"px"});
						}
						if(imgHeight > parHeight && opts.centerVertical){
							org_image.css({"margin-top":"-"+ Math.round((imgHeight - parHeight) / 2) +"px"});
						}		
					} else {
						if(imgWidth > parWidth){
							org_image.css({"margin-left":"-"+ Math.round((imgWidth - parWidth) / 2) +"px"});
						} else if(imgWidth < parWidth){
							org_image.css({"margin-left": Math.round((parWidth -imgWidth) / 2) +"px"});
						}
						if(imgHeight > parHeight && opts.centerVertical){
							org_image.css({"margin-top":"-"+ Math.round((imgHeight - parHeight) / 2) +"px"});
						} else if(imgHeight < parHeight && opts.centerVertical){
							org_image.css({"margin-top": Math.round((parHeight - imgHeight) / 2) +"px"});
						}
					}
					opts.complete.call(this);
					if(current == len){
						opts.end.call(this);
					}
				}
				org_image.show();	
			}
			
		});		
	}
})(jQuery);
(function($) {
	$.fn.accordion = function(options) {
		initialize(this, options);
	};

	//create the initial accordion
	function initialize(obj, options) {
		//build main options before element iteration
		var opts = $.extend({}, $.fn.accordion.defaults, options);

		//store any opened default values to set cookie later
		var opened = '';

		//iterate each matched object, bind, and open/close
		obj.each(function() {
			var $this = $(this);
			saveOpts($this, opts);

			//bind it to the event
			if (opts.bind == 'mouseenter') {
				$this.bind('mouseenter', function(e) {
					e.preventDefault();
					toggle($this, opts);
				});
			}

			//bind it to the event
			if (opts.bind == 'mouseover') {
				$this.bind('mouseover',function(e) {
					e.preventDefault();
					toggle($this, opts);
				});
			}

			//bind it to the event
			if (opts.bind == 'click') {
				$this.bind('click', function(e) {
					e.preventDefault();
					toggle($this, opts);
				});
			}

			//bind it to the event
			if (opts.bind == 'dblclick') {
				$this.bind('dblclick', function(e) {
					e.preventDefault();
					toggle($this, opts);
				});
			}

			//initialize the panels
			//get the id for this element
			id = $this.attr('id');

			//if not using cookies, open defauls
			if (!useCookies(opts)) {
				//close it if not defaulted to open
				if (id != opts.defaultOpen) {
					$this.addClass(opts.cssClose);
					$this.next().hide();
				} else { //its a default open, open it
					$this.addClass(opts.cssOpen);
					$this.next().show();
					opened = id;
				}
			} else { //can use cookies, use them now
				//has a cookie been set, this overrides default open
				if (issetCookie(opts)) {
					if (inCookie(id, opts) === false) {
						$this.addClass(opts.cssClose);
						$this.next().hide();
					} else {
						$this.addClass(opts.cssOpen);
						$this.next().show();
						opened = id;
					}
				} else { //a cookie hasn't been set open defaults
					if (id != opts.defaultOpen) {
						$this.addClass(opts.cssClose);
						$this.next().hide();
					} else { //its a default open, open it
						$this.addClass(opts.cssOpen);
						$this.next().show();
						opened = id;
					}
				}
			}
		});

		//now that the loop is done, set the cookie
		if (opened.length > 0 && useCookies(opts)) {
			setCookie(opened, opts);
		} else { //there are none open, set cookie
			setCookie('', opts);
		}

		return obj;
	};

	//load opts from object
	function loadOpts($this) {
		return $this.data('accordion-opts');
	}

	//save opts into object
	function saveOpts($this, opts) {
		return $this.data('accordion-opts', opts);
	}

	//hides a accordion panel
	function close(opts) {
		opened = $(document).find('.' + opts.cssOpen);
		$.each(opened, function() {
			//give the proper class to the linked element
			$(this).addClass(opts.cssClose).removeClass(opts.cssOpen);
			opts.animateClose($(this), opts);
		});
	}

	//opens a accordion panel
	function open($this, opts) {
		close(opts);
		//give the proper class to the linked element
		$this.removeClass(opts.cssClose).addClass(opts.cssOpen);

		//open the element
		opts.animateOpen($this, opts);

		//do cookies if plugin available
		if (useCookies(opts)) {
			// split the cookieOpen string by ","
			id = $this.attr('id');
			setCookie(id, opts);
		}
	}

	//toggle a accordion on an event
	function toggle($this, opts) {
		// close the only open item
                if ($this.hasClass(opts.cssOpen))
		{
		     close(opts);
                     //do cookies if plugin available
                    if (useCookies(opts)) {
                            // split the cookieOpen string by ","
                            setCookie('', opts);
                    }
                     return false;
		}
		close(opts);
		//open a closed element
		open($this, opts);
		return false;
	}

	//use cookies?
	function useCookies(opts) {
		//return false if cookie plugin not present or if a cookie name is not provided
		if (!$.cookie || opts.cookieName == '') {
			return false;
		}

		//we can use cookies
		return true;
	}

	//set a cookie
	function setCookie(value, opts)
	{
		//can use the cookie plugin
		if (!useCookies(opts)) { //no, quit here
			return false;
		}

		//cookie plugin is available, lets set the cookie
		$.cookie(opts.cookieName, value, opts.cookieOptions);
	}

	//check if a accordion is in the cookie
	function inCookie(value, opts)
	{
		//can use the cookie plugin
		if (!useCookies(opts)) {
			return false;
		}

		//if its not there we don't need to remove from it
		if (!issetCookie(opts)) { //quit here, don't have a cookie
			return false;
		}

		//unescape it
		cookie = unescape($.cookie(opts.cookieName));

		//is this value in the cookie arrray
		if (cookie != value) { //no, quit here
			return false;
		}

		return true;
	}

	//check if a cookie is set
	function issetCookie(opts)
	{
		//can we use the cookie plugin
		if (!useCookies(opts)) { //no, quit here
			return false;
		}

		//is the cookie set
		if ($.cookie(opts.cookieName) == null) { //no, quit here
			return false;
		}

		return true;
	}

	// settings
	$.fn.accordion.defaults = {
		cssClose: 'accordion-close', //class you want to assign to a closed accordion header
		cssOpen: 'accordion-open', //class you want to assign an opened accordion header
		cookieName: 'accordion', //name of the cookie you want to set for this accordion
		cookieOptions: { //cookie options, see cookie plugin for details
			path: '/',
			expires: 7,
			domain: '',
			secure: ''
		},
		defaultOpen: '', //id that you want opened by default
		speed: 'slow', //speed of the slide effect
		bind: 'click', //event to bind to, supports click, dblclick, mouseover and mouseenter
		animateOpen: function (elem, opts) { //replace the standard slideDown with custom function
			elem.next().slideDown(opts.speed);
		},
		animateClose: function (elem, opts) { //replace the standard slideUp with custom function
			elem.next().slideUp(opts.speed);
		}
	};
})(jQuery);
//custom animation for open/close
jQuery.fn.slideFadeToggle = function(speed, easing, callback) {
	return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};
/*!
 * jQuery Selectbox plugin 0.2
 *
 * Copyright 2011-2012, Dimitar Ivanov (http://www.bulgaria-web-developers.com/projects/javascript/selectbox/)
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
 * 
 * Date: Tue Jul 17 19:58:36 2012 +0300
 */
(function ($, undefined) {
	var PROP_NAME = 'selectbox',
		FALSE = false,
		TRUE = true;
	/**
	 * Selectbox manager.
	 * Use the singleton instance of this class, $.selectbox, to interact with the select box.
	 * Settings for (groups of) select boxes are maintained in an instance object,
	 * allowing multiple different settings on the same page
	 */
	function Selectbox() {
		this._state = [];
		this._defaults = { // Global defaults for all the select box instances
			classHolder: "sbHolder",
			classHolderDisabled: "sbHolderDisabled",
			classSelector: "sbSelector",
			classOptions: "sbOptions",
			classGroup: "sbGroup",
			classSub: "sbSub",
			classDisabled: "sbDisabled",
			classToggleOpen: "sbToggleOpen",
			classToggle: "sbToggle",
			classFocus: "sbFocus",
			speed: 200,
			effect: "slide", // "slide" or "fade"
			onChange: null, //Define a callback function when the selectbox is changed
			onOpen: null, //Define a callback function when the selectbox is open
			onClose: null //Define a callback function when the selectbox is closed
		};
	}
	
	$.extend(Selectbox.prototype, {
		/**
		 * Is the first field in a jQuery collection open as a selectbox
		 * 
		 * @param {Object} target
		 * @return {Boolean}
		 */
		_isOpenSelectbox: function (target) {
			if (!target) {
				return FALSE;
			}
			var inst = this._getInst(target);
			return inst.isOpen;
		},
		/**
		 * Is the first field in a jQuery collection disabled as a selectbox
		 * 
		 * @param {HTMLElement} target
		 * @return {Boolean}
		 */
		_isDisabledSelectbox: function (target) {
			if (!target) {
				return FALSE;
			}
			var inst = this._getInst(target);
			return inst.isDisabled;
		},
		/**
		 * Attach the select box to a jQuery selection.
		 * 
		 * @param {HTMLElement} target
		 * @param {Object} settings
		 */
		_attachSelectbox: function (target, settings) {
			if (this._getInst(target)) {
				return FALSE;
			}
			var $target = $(target),
				self = this,
				inst = self._newInst($target),
				sbHolder, sbSelector, sbToggle, sbOptions,
				s = FALSE, optGroup = $target.find("optgroup"), opts = $target.find("option"), olen = opts.length;
				
			$target.attr("sb", inst.uid);
				
			$.extend(inst.settings, self._defaults, settings);
			self._state[inst.uid] = FALSE;
			$target.hide();
			
			function closeOthers() {
				var key, sel,
					uid = this.attr("id").split("_")[1];
				for (key in self._state) {
					if (key !== uid) {
						if (self._state.hasOwnProperty(key)) {
							sel = $("select[sb='" + key + "']")[0];
							if (sel) {
								self._closeSelectbox(sel);
							}
						}
					}
				}
			}
			
			sbHolder = $("<div>", {
				"id": "sbHolder_" + inst.uid,
				"class": inst.settings.classHolder,
				"tabindex": $target.attr("tabindex")
			});
			
			sbSelector = $("<a>", {
				"id": "sbSelector_" + inst.uid,
				"href": "#",
				"class": inst.settings.classSelector,
				"click": function (e) {
					e.preventDefault();
					closeOthers.apply($(this), []);
					var uid = $(this).attr("id").split("_")[1];
					if (self._state[uid]) {
						self._closeSelectbox(target);
					} else {
						self._openSelectbox(target);
					}
				}
			});
			
			sbToggle = $("<a>", {
				"id": "sbToggle_" + inst.uid,
				"href": "#",
				"class": inst.settings.classToggle,
				"click": function (e) {
					e.preventDefault();
					closeOthers.apply($(this), []);
					var uid = $(this).attr("id").split("_")[1];
					if (self._state[uid]) {
						self._closeSelectbox(target);
					} else {
						self._openSelectbox(target);
					}
				}
			});
			sbToggle.appendTo(sbHolder);

			sbOptions = $("<ul>", {
				"id": "sbOptions_" + inst.uid,
				"class": inst.settings.classOptions,
				"css": {
					"display": "none"
				}
			});
			
			$target.children().each(function(i) {
				var that = $(this), li, config = {};
				if (that.is("option")) {
					getOptions(that);
				} else if (that.is("optgroup")) {
					li = $("<li>");
					$("<span>", {
						"text": that.attr("label")
					}).addClass(inst.settings.classGroup).appendTo(li);
					li.appendTo(sbOptions);
					if (that.is(":disabled")) {
						config.disabled = true;
					}
					config.sub = true;
					getOptions(that.find("option"), config);
				}
			});
			
			function getOptions () {
				var sub = arguments[1] && arguments[1].sub ? true : false,
					disabled = arguments[1] && arguments[1].disabled ? true : false;
				arguments[0].each(function (i) {
					var that = $(this),
						li = $("<li>"),
						child;
					if (that.is(":selected")) {
						sbSelector.text(that.text());
						s = TRUE;
					}
					if (i === olen - 1) {
						li.addClass("last");
					}
					if (!that.is(":disabled") && !disabled) {
						child = $("<a>", {
							"href": "#" + that.val(),
							"rel": that.val()
						}).text(that.text()).bind("click.sb", function (e) {
							if (e && e.preventDefault) {
								e.preventDefault();
							}
							var t = sbToggle,
							 	$this = $(this),
								uid = t.attr("id").split("_")[1];
							self._changeSelectbox(target, $this.attr("rel"), $this.text());
							self._closeSelectbox(target);
						}).bind("mouseover.sb", function () {
							var $this = $(this);
							$this.parent().siblings().find("a").removeClass(inst.settings.classFocus);
							$this.addClass(inst.settings.classFocus);
						}).bind("mouseout.sb", function () {
							$(this).removeClass(inst.settings.classFocus);
						});
						if (sub) {
							child.addClass(inst.settings.classSub);
						}
						if (that.is(":selected")) {
							child.addClass(inst.settings.classFocus);
						}
						child.appendTo(li);
					} else {
						child = $("<span>", {
							"text": that.text()
						}).addClass(inst.settings.classDisabled);
						if (sub) {
							child.addClass(inst.settings.classSub);
						}
						child.appendTo(li);
					}
					li.appendTo(sbOptions);
				});
			}
			
			if (!s) {
				sbSelector.text(opts.first().text());
			}

			$.data(target, PROP_NAME, inst);
			
			sbHolder.data("uid", inst.uid).bind("keydown.sb", function (e) {
				var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0,
					$this = $(this),
					uid = $this.data("uid"),
					inst = $this.siblings("select[sb='"+uid+"']").data(PROP_NAME),
					trgt = $this.siblings(["select[sb='", uid, "']"].join("")).get(0),
					$f = $this.find("ul").find("a." + inst.settings.classFocus);
				switch (key) {
					case 37: //Arrow Left
					case 38: //Arrow Up
						if ($f.length > 0) {
							var $next;
							$("a", $this).removeClass(inst.settings.classFocus);
							$next = $f.parent().prevAll("li:has(a)").eq(0).find("a");
							if ($next.length > 0) {
								$next.addClass(inst.settings.classFocus).focus();
								$("#sbSelector_" + uid).text($next.text());
							}
						}
						break;
					case 39: //Arrow Right
					case 40: //Arrow Down
						var $next;
						$("a", $this).removeClass(inst.settings.classFocus);
						if ($f.length > 0) {
							$next = $f.parent().nextAll("li:has(a)").eq(0).find("a");
						} else {
							$next = $this.find("ul").find("a").eq(0);
						}
						if ($next.length > 0) {
							$next.addClass(inst.settings.classFocus).focus();
							$("#sbSelector_" + uid).text($next.text());
						}
						break;				
					case 13: //Enter
						if ($f.length > 0) {
							self._changeSelectbox(trgt, $f.attr("rel"), $f.text());
						}
						self._closeSelectbox(trgt);
						break;
					case 9: //Tab
						if (trgt) {
							var inst = self._getInst(trgt);
							if (inst/* && inst.isOpen*/) {
								if ($f.length > 0) {
									self._changeSelectbox(trgt, $f.attr("rel"), $f.text());
								}
								self._closeSelectbox(trgt);
							}
						}
						var i = parseInt($this.attr("tabindex"), 10);
						if (!e.shiftKey) {
							i++;
						} else {
							i--;
						}
						$("*[tabindex='" + i + "']").focus();
						break;
					case 27: //Escape
						self._closeSelectbox(trgt);
						break;
				}
				e.stopPropagation();
				return false;
			}).delegate("a", "mouseover", function (e) {
				$(this).addClass(inst.settings.classFocus);
			}).delegate("a", "mouseout", function (e) {
				$(this).removeClass(inst.settings.classFocus);	
			});
			
			sbSelector.appendTo(sbHolder);
			sbOptions.appendTo(sbHolder);			
			sbHolder.insertAfter($target);
			
			$("html").live('mousedown', function(e) {
				e.stopPropagation();          
				$("select").selectbox('close'); 
			});
			$([".", inst.settings.classHolder, ", .", inst.settings.classSelector].join("")).mousedown(function(e) {    
				e.stopPropagation();
			});
		},
		/**
		 * Remove the selectbox functionality completely. This will return the element back to its pre-init state.
		 * 
		 * @param {HTMLElement} target
		 */
		_detachSelectbox: function (target) {
			var inst = this._getInst(target);
			if (!inst) {
				return FALSE;
			}
			$("#sbHolder_" + inst.uid).remove();
			$.data(target, PROP_NAME, null);
			$(target).show();			
		},
		/**
		 * Change selected attribute of the selectbox.
		 * 
		 * @param {HTMLElement} target
		 * @param {String} value
		 * @param {String} text
		 */
		_changeSelectbox: function (target, value, text) {
			var onChange,
				inst = this._getInst(target);
			if (inst) {
				onChange = this._get(inst, 'onChange');
				$("#sbSelector_" + inst.uid).text(text);
			}
			value = value.replace(/\'/g, "\\'");
			$(target).find("option[value='" + value + "']").attr("selected", TRUE);
			if (inst && onChange) {
				onChange.apply((inst.input ? inst.input[0] : null), [value, inst]);
			} else if (inst && inst.input) {
				inst.input.trigger('change');
			}
		},
		/**
		 * Enable the selectbox.
		 * 
		 * @param {HTMLElement} target
		 */
		_enableSelectbox: function (target) {
			var inst = this._getInst(target);
			if (!inst || !inst.isDisabled) {
				return FALSE;
			}
			$("#sbHolder_" + inst.uid).removeClass(inst.settings.classHolderDisabled);
			inst.isDisabled = FALSE;
			$.data(target, PROP_NAME, inst);
		},
		/**
		 * Disable the selectbox.
		 * 
		 * @param {HTMLElement} target
		 */
		_disableSelectbox: function (target) {
			var inst = this._getInst(target);
			if (!inst || inst.isDisabled) {
				return FALSE;
			}
			$("#sbHolder_" + inst.uid).addClass(inst.settings.classHolderDisabled);
			inst.isDisabled = TRUE;
			$.data(target, PROP_NAME, inst);
		},
		/**
		 * Get or set any selectbox option. If no value is specified, will act as a getter.
		 * 
		 * @param {HTMLElement} target
		 * @param {String} name
		 * @param {Object} value
		 */
		_optionSelectbox: function (target, name, value) {
			var inst = this._getInst(target);
			if (!inst) {
				return FALSE;
			}
			//TODO check name
			inst[name] = value;
			$.data(target, PROP_NAME, inst);
		},
		/**
		 * Call up attached selectbox
		 * 
		 * @param {HTMLElement} target
		 */
		_openSelectbox: function (target) {
			var inst = this._getInst(target);
			//if (!inst || this._state[inst.uid] || inst.isDisabled) {
			if (!inst || inst.isOpen || inst.isDisabled) {
				return;
			}
			var	el = $("#sbOptions_" + inst.uid),
				viewportHeight = parseInt($(window).height(), 10),
				offset = $("#sbHolder_" + inst.uid).offset(),
				scrollTop = $(window).scrollTop(),
				height = el.prev().height(),
				diff = viewportHeight - (offset.top - scrollTop) - height / 2,
				onOpen = this._get(inst, 'onOpen');
			el.css({
				"top": height + "px",
				"maxHeight": (diff - height) + "px"
			});
			inst.settings.effect === "fade" ? el.fadeIn(inst.settings.speed) : el.slideDown(inst.settings.speed);
			$("#sbToggle_" + inst.uid).addClass(inst.settings.classToggleOpen);
			this._state[inst.uid] = TRUE;
			inst.isOpen = TRUE;
			if (onOpen) {
				onOpen.apply((inst.input ? inst.input[0] : null), [inst]);
			}
			$.data(target, PROP_NAME, inst);
		},
		/**
		 * Close opened selectbox
		 * 
		 * @param {HTMLElement} target
		 */
		_closeSelectbox: function (target) {
			var inst = this._getInst(target);
			//if (!inst || !this._state[inst.uid]) {
			if (!inst || !inst.isOpen) {
				return;
			}
			var onClose = this._get(inst, 'onClose');
			inst.settings.effect === "fade" ? $("#sbOptions_" + inst.uid).fadeOut(inst.settings.speed) : $("#sbOptions_" + inst.uid).slideUp(inst.settings.speed);
			$("#sbToggle_" + inst.uid).removeClass(inst.settings.classToggleOpen);
			this._state[inst.uid] = FALSE;
			inst.isOpen = FALSE;
			if (onClose) {
				onClose.apply((inst.input ? inst.input[0] : null), [inst]);
			}
			$.data(target, PROP_NAME, inst);
		},
		/**
		 * Create a new instance object
		 * 
		 * @param {HTMLElement} target
		 * @return {Object}
		 */
		_newInst: function(target) {
			var id = target[0].id.replace(/([^A-Za-z0-9_-])/g, '\\\\$1');
			return {
				id: id, 
				input: target, 
				uid: Math.floor(Math.random() * 99999999),
				isOpen: FALSE,
				isDisabled: FALSE,
				settings: {}
			}; 
		},
		/**
		 * Retrieve the instance data for the target control.
		 * 
		 * @param {HTMLElement} target
		 * @return {Object} - the associated instance data
		 * @throws error if a jQuery problem getting data
		 */
		_getInst: function(target) {
			try {
				return $.data(target, PROP_NAME);
			}
			catch (err) {
				throw 'Missing instance data for this selectbox';
			}
		},
		/**
		 * Get a setting value, defaulting if necessary
		 * 
		 * @param {Object} inst
		 * @param {String} name
		 * @return {Mixed}
		 */
		_get: function(inst, name) {
			return inst.settings[name] !== undefined ? inst.settings[name] : this._defaults[name];
		}
	});

	/**
	 * Invoke the selectbox functionality.
	 * 
	 * @param {Object|String} options
	 * @return {Object}
	 */
	$.fn.selectbox = function (options) {
		
		var otherArgs = Array.prototype.slice.call(arguments, 1);
		if (typeof options == 'string' && options == 'isDisabled') {
			return $.selectbox['_' + options + 'Selectbox'].apply($.selectbox, [this[0]].concat(otherArgs));
		}
		
		if (options == 'option' && arguments.length == 2 && typeof arguments[1] == 'string') {
			return $.selectbox['_' + options + 'Selectbox'].apply($.selectbox, [this[0]].concat(otherArgs));
		}
		
		return this.each(function() {
			typeof options == 'string' ?
				$.selectbox['_' + options + 'Selectbox'].apply($.selectbox, [this].concat(otherArgs)) :
				$.selectbox._attachSelectbox(this, options);
		});
	};
	
	$.selectbox = new Selectbox(); // singleton instance
	$.selectbox.version = "0.2";
})(jQuery);
/**
* author Remy Sharp
* url http://remysharp.com/tag/marquee
*/

(function ($) {
    $.fn.marquee = function (klass) {
        var newMarquee = [],
            last = this.length;

        // works out the left or right hand reset position, based on scroll
        // behavior, current direction and new direction
        function getReset(newDir, marqueeRedux, marqueeState) {
            var behavior = marqueeState.behavior, width = marqueeState.width, dir = marqueeState.dir;
            var r = 0;
            if (behavior == 'alternate') {
                r = newDir == 1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : width;
            } else if (behavior == 'slide') {
                if (newDir == -1) {
                    r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] : width;
                } else {
                    r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : 0;
                }
            } else {
                r = newDir == -1 ? marqueeRedux[marqueeState.widthAxis] : 0;
            }
            return r;
        }

        // single "thread" animation
        function animateMarquee() {
            var i = newMarquee.length,
                marqueeRedux = null,
                $marqueeRedux = null,
                marqueeState = {},
                newMarqueeList = [],
                hitedge = false;
                
            while (i--) {
                marqueeRedux = newMarquee[i];
                $marqueeRedux = $(marqueeRedux);
                marqueeState = $marqueeRedux.data('marqueeState');
                
                if ($marqueeRedux.data('paused') !== true) {
                    // TODO read scrollamount, dir, behavior, loops and last from data
                    marqueeRedux[marqueeState.axis] += (marqueeState.scrollamount * marqueeState.dir);

                    // only true if it's hit the end
                    hitedge = marqueeState.dir == -1 ? marqueeRedux[marqueeState.axis] <= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState) : marqueeRedux[marqueeState.axis] >= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                    
                    if ((marqueeState.behavior == 'scroll' && marqueeState.last == marqueeRedux[marqueeState.axis]) || (marqueeState.behavior == 'alternate' && hitedge && marqueeState.last != -1) || (marqueeState.behavior == 'slide' && hitedge && marqueeState.last != -1)) {                        
                        if (marqueeState.behavior == 'alternate') {
                            marqueeState.dir *= -1; // flip
                        }
                        marqueeState.last = -1;

                        $marqueeRedux.trigger('stop');

                        marqueeState.loops--;
                        if (marqueeState.loops === 0) {
                            if (marqueeState.behavior != 'slide') {
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                            } else {
                                // corrects the position
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                            }

                            $marqueeRedux.trigger('end');
                        } else {
                            // keep this marquee going
                            newMarqueeList.push(marqueeRedux);
                            $marqueeRedux.trigger('start');
                            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                        }
                    } else {
                        newMarqueeList.push(marqueeRedux);
                    }
                    marqueeState.last = marqueeRedux[marqueeState.axis];

                    // store updated state only if we ran an animation
                    $marqueeRedux.data('marqueeState', marqueeState);
                } else {
                    // even though it's paused, keep it in the list
                    newMarqueeList.push(marqueeRedux);                    
                }
            }

            newMarquee = newMarqueeList;
            
            if (newMarquee.length) {
                setTimeout(animateMarquee, 25);
            }            
        }
        
        // TODO consider whether using .html() in the wrapping process could lead to loosing predefined events...
        this.each(function (i) {
            var $marquee = $(this),
                width = $marquee.attr('width') || $marquee.width(),
                height = $marquee.attr('height') || $marquee.height(),
                $marqueeRedux = $marquee.after('<div ' + (klass ? 'class="' + klass + '" ' : '') + 'style="display: block-inline; width: ' + width + 'px; height: ' + height + 'px; overflow: hidden;"><div style="float: left;">' + $marquee.html() + '</div></div>').next(),
                marqueeRedux = $marqueeRedux.get(0),
                hitedge = 0,
                direction = ($marquee.attr('direction') || 'left').toLowerCase(),
                marqueeState = {
                    dir : /down|right/.test(direction) ? -1 : 1,
                    axis : /left|right/.test(direction) ? 'scrollLeft' : 'scrollTop',
                    widthAxis : /left|right/.test(direction) ? 'scrollWidth' : 'scrollHeight',
                    last : -1,
                    loops : $marquee.attr('loop') || -1,
                    scrollamount : $marquee.attr('scrollamount') || this.scrollAmount || 2,
                    behavior : ($marquee.attr('behavior') || 'scroll').toLowerCase(),
                    width : /left|right/.test(direction) ? width : height
                };
            
            // corrects a bug in Firefox - the default loops for slide is -1
            if ($marquee.attr('loop') == -1 && marqueeState.behavior == 'slide') {
                marqueeState.loops = 1;
            }

            $marquee.remove();
            
            // add padding
            if (/left|right/.test(direction)) {
                $marqueeRedux.find('> div').css('padding', '0 ' + width + 'px');
            } else {
                $marqueeRedux.find('> div').css('padding', height + 'px 0');
            }
            
            // events
            $marqueeRedux.bind('stop', function () {
                $marqueeRedux.data('paused', true);
            }).bind('pause', function () {
                $marqueeRedux.data('paused', true);
            }).bind('start', function () {
                $marqueeRedux.data('paused', false);
            }).bind('unpause', function () {
                $marqueeRedux.data('paused', false);
            }).data('marqueeState', marqueeState); // finally: store the state
            
            // todo - rerender event allowing us to do an ajax hit and redraw the marquee

            newMarquee.push(marqueeRedux);

            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
            $marqueeRedux.trigger('start');
            
            // on the very last marquee, trigger the animation
            if (i+1 == last) {
                animateMarquee();
            }
        });            

        return $(newMarquee);
    };
}(jQuery));
/* Plugin jscroll*/
(function ($) {
	$.fn.ScrollbarVisibility = function () {
		var $el	= $(this).jScrollPane({
			verticalGutter 	: -4,
			verticalDragMinHeight:50,
			verticalDragMaxHeight:50
		}),
		extensionPlugin = {
			extPluginOpts	: {
				// speed for the fadeOut animation
				mouseLeaveFadeSpeed	: 500,
				// scrollbar fades out after hovertimeout_t milliseconds
				hovertimeout_t		: 1000,
				// if set to false, the scrollbar will be shown on mouseenter and hidden on mouseleave
				// if set to true, the same will happen, but the scrollbar will be also hidden on mouseenter after "hovertimeout_t" ms
				// also, it will be shown when we start to scroll and hidden when stopping
				useTimeout			: true,
				// the extension only applies for devices with width > deviceWidth
				deviceWidth			: 980
			},
			hovertimeout	: null, // timeout to hide the scrollbar
			isScrollbarHover: false,// true if the mouse is over the scrollbar
			elementtimeout	: null,	// avoids showing the scrollbar when moving from inside the element to outside, passing over the scrollbar
			isScrolling		: false,// true if scrolling
			addHoverFunc	: function() {
				
				// run only if the window has a width bigger than deviceWidth
				if( $(window).width() <= this.extPluginOpts.deviceWidth ) return false;
				
				var instance		= this;
				
				// functions to show / hide the scrollbar
				$.fn.jspmouseenter 	= $.fn.show;
				$.fn.jspmouseleave 	= $.fn.fadeOut;
				
				// hide the jScrollPane vertical bar
				var $vBar			= this.getContentPane().siblings('.jspVerticalBar').hide();
				
				/*
				 * mouseenter / mouseleave events on the main element
				 * also scrollstart / scrollstop - @James Padolsey : http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
				 */
				$el.bind('mouseenter.jsp',function() {
					
					// show the scrollbar
					$vBar.stop( true, true ).jspmouseenter();
					
					if( !instance.extPluginOpts.useTimeout ) return false;
					
					// hide the scrollbar after hovertimeout_t ms
					clearTimeout( instance.hovertimeout );
					instance.hovertimeout 	= setTimeout(function() {
						// if scrolling at the moment don't hide it
						if( !instance.isScrolling )
							$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
					}, instance.extPluginOpts.hovertimeout_t );
					
					
				}).bind('mouseleave.jsp',function() {
					
					// hide the scrollbar
					if( !instance.extPluginOpts.useTimeout )
						$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
					else {
					clearTimeout( instance.elementtimeout );
					if( !instance.isScrolling )
							$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
					}
					
				});
				
				if( this.extPluginOpts.useTimeout ) {
					
					$el.bind('scrollstart.jsp', function() {
					
						// when scrolling show the scrollbar
					clearTimeout( instance.hovertimeout );
					instance.isScrolling	= true;
					$vBar.stop( true, true ).jspmouseenter();
					
				}).bind('scrollstop.jsp', function() {
					
						// when stop scrolling hide the scrollbar (if not hovering it at the moment)
					clearTimeout( instance.hovertimeout );
					instance.isScrolling	= false;
					instance.hovertimeout 	= setTimeout(function() {
						if( !instance.isScrollbarHover )
								$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
						}, instance.extPluginOpts.hovertimeout_t );
					
				});
				
					// wrap the scrollbar
					// we need this to be able to add the mouseenter / mouseleave events to the scrollbar
				var $vBarWrapper	= $('<div/>').css({
					position	: 'absolute',
					left		: $vBar.css('left'),
					top			: $vBar.css('top'),
					right		: $vBar.css('right'),
					bottom		: $vBar.css('bottom'),
					width		: $vBar.width(),
					height		: $vBar.height()
				}).bind('mouseenter.jsp',function() {
					
					clearTimeout( instance.hovertimeout );
					clearTimeout( instance.elementtimeout );
					
					instance.isScrollbarHover	= true;
					
						// show the scrollbar after 100 ms.
						// avoids showing the scrollbar when moving from inside the element to outside, passing over the scrollbar								
					instance.elementtimeout	= setTimeout(function() {
						$vBar.stop( true, true ).jspmouseenter();
					}, 100 );	
					
				}).bind('mouseleave.jsp',function() {
					
						// hide the scrollbar after hovertimeout_t
					clearTimeout( instance.hovertimeout );
					instance.isScrollbarHover	= false;
					instance.hovertimeout = setTimeout(function() {
							// if scrolling at the moment don't hide it
						if( !instance.isScrolling )
								$vBar.stop( true, true ).jspmouseleave( instance.extPluginOpts.mouseLeaveFadeSpeed || 0 );
						}, instance.extPluginOpts.hovertimeout_t );
					
				});
				
				$vBar.wrap( $vBarWrapper );
				
			}
			
			}
		},
		// the jScrollPane instance
		jspapi = $el.data('jsp');
		
		$.extend( true, jspapi, extensionPlugin );
		jspapi.addHoverFunc();
	};
}(jQuery));