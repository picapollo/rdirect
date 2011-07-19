(function(b) {
	b.uniform = {
		options : {
			selectClass : "selector",
			radioClass : "radio",
			checkboxClass : "checker",
			fileClass : "uploader",
			filenameClass : "filename",
			fileBtnClass : "action",
			fileDefaultText : "No file selected",
			fileBtnText : "Choose File",
			checkedClass : "checked",
			focusClass : "focus",
			disabledClass : "disabled",
			buttonClass : "button",
			activeClass : "active",
			hoverClass : "hover",
			useID : true,
			idPrefix : "uniform",
			resetSelector : false,
			autoHide : true
		},
		elements : []
	};
	if(b.browser.msie && b.browser.version < 7) {
		b.support.selectOpacity = false
	} else {
		b.support.selectOpacity = true
	}
	b.fn.uniform = function(a) {
		a = b.extend(b.uniform.options, a);
		var r = this;
		if(a.resetSelector != false) {b(a.resetSelector).mouseup(function() {
				function c() {b.uniform.update(r)
				}setTimeout(c, 10)
			})
		}
		function l(c) {
			$el = b(c);
			$el.addClass($el.attr("type"));
			t(c)
		}

		function o(c) {b(c).addClass("uniform");
			t(c)
		}

		function m(f) {
			var c = b(f);
			var e = b("<div>"), d = b("<span>");
			e.addClass(a.buttonClass);
			if(a.useID && c.attr("id") != "") {e.attr("id", a.idPrefix + "-" + c.attr("id"))
			}
			var g;
			if(c.is("a") || c.is("button")) {
				g = c.text()
			} else {
				if(c.is(":submit") || c.is(":reset") || c.is("input[type=button]")) {
					g = c.attr("value")
				}
			}
			g = g == "" ? c.is(":reset") ? "Reset" : "Submit" : g;
			d.html(g);
			c.css("opacity", 0);
			c.wrap(e);
			c.wrap(d);
			e = c.closest("div");
			d = c.closest("span");
			if(c.is(":disabled")) {e.addClass(a.disabledClass)
			}e.bind({
				"mouseenter.uniform" : function() {e.addClass(a.hoverClass)
				},
				"mouseleave.uniform" : function() {e.removeClass(a.hoverClass);
					e.removeClass(a.activeClass)
				},
				"mousedown.uniform touchbegin.uniform" : function() {e.addClass(a.activeClass)
				},
				"mouseup.uniform touchend.uniform" : function() {e.removeClass(a.activeClass)
				},
				"click.uniform touchend.uniform" : function(h) {
					if(b(h.target).is("span") || b(h.target).is("div")) {
						if(f[0].dispatchEvent) {
							var i = document.createEvent("MouseEvents");
							i.initEvent("click", true, true);
							f[0].dispatchEvent(i)
						} else {f[0].click()
						}
					}
				}
			});
			f.bind({
				"focus.uniform" : function() {e.addClass(a.focusClass)
				},
				"blur.uniform" : function() {e.removeClass(a.focusClass)
				}
			});
			b.uniform.noSelect(e);
			t(f)
		}

		function q(f) {
			var c = b(f);
			var e = b("<div />"), d = b("<span />");
			if(!c.css("display") == "none" && a.autoHide) {e.hide()
			}e.addClass(a.selectClass);
			if(a.useID && f.attr("id") != "") {e.attr("id", a.idPrefix + "-" + f.attr("id"))
			}
			var g = f.find(":selected:first");
			if(g.length == 0) {
				g = f.find("option:first")
			}d.html(g.html());
			f.css("opacity", 0);
			f.wrap(e);
			f.before(d);
			e = f.parent("div");
			d = f.siblings("span");
			f.bind({
				"change.uniform" : function() {d.text(f.find(":selected").html());
					e.removeClass(a.activeClass)
				},
				"focus.uniform" : function() {e.addClass(a.focusClass)
				},
				"blur.uniform" : function() {e.removeClass(a.focusClass);
					e.removeClass(a.activeClass)
				},
				"mousedown.uniform touchbegin.uniform" : function() {e.addClass(a.activeClass)
				},
				"mouseup.uniform touchend.uniform" : function() {e.removeClass(a.activeClass)
				},
				"click.uniform touchend.uniform" : function() {e.removeClass(a.activeClass)
				},
				"mouseenter.uniform" : function() {e.addClass(a.hoverClass)
				},
				"mouseleave.uniform" : function() {e.removeClass(a.hoverClass);
					e.removeClass(a.activeClass)
				},
				"keyup.uniform" : function() {d.text(f.find(":selected").html())
				}
			});
			if(b(f).attr("disabled")) {e.addClass(a.disabledClass)
			}b.uniform.noSelect(d);
			t(f)
		}

		function p(f) {
			var c = b(f);
			var e = b("<div />"), d = b("<span />");
			if(!c.css("display") == "none" && a.autoHide) {e.hide()
			}e.addClass(a.checkboxClass);
			if(a.useID && f.attr("id") != "") {e.attr("id", a.idPrefix + "-" + f.attr("id"))
			}b(f).wrap(e);
			b(f).wrap(d);
			d = f.parent();
			e = d.parent();
			b(f).css("opacity",0).bind({
				"focus.uniform" : function() {e.addClass(a.focusClass)
				},
				"blur.uniform" : function() {e.removeClass(a.focusClass)
				},
				"click.uniform touchend.uniform" : function() {
					if(!b(f).attr("checked")) {d.removeClass(a.checkedClass)
					} else {d.addClass(a.checkedClass)
					}
				},
				"mousedown.uniform touchbegin.uniform" : function() {e.addClass(a.activeClass)
				},
				"mouseup.uniform touchend.uniform" : function() {e.removeClass(a.activeClass)
				},
				"mouseenter.uniform" : function() {e.addClass(a.hoverClass)
				},
				"mouseleave.uniform" : function() {e.removeClass(a.hoverClass);
					e.removeClass(a.activeClass)
				}
			});
			if(b(f).attr("checked")) {d.addClass(a.checkedClass)
			}
			if(b(f).attr("disabled")) {e.addClass(a.disabledClass)
			}t(f)
		}

		function s(f) {
			var c = b(f);
			var e = b("<div />"), d = b("<span />");
			if(!c.css("display") == "none" && a.autoHide) {e.hide()
			}e.addClass(a.radioClass);
			if(a.useID && f.attr("id") != "") {e.attr("id", a.idPrefix + "-" + f.attr("id"))
			}b(f).wrap(e);
			b(f).wrap(d);
			d = f.parent();
			e = d.parent();
			b(f).css("opacity",0).bind({
				"focus.uniform" : function() {e.addClass(a.focusClass)
				},
				"blur.uniform" : function() {e.removeClass(a.focusClass)
				},
				"click.uniform touchend.uniform" : function() {
					if(!b(f).attr("checked")) {d.removeClass(a.checkedClass)
					} else {
						var g = a.radioClass.split(" ")[0];
						b("."+g+" span."+a.checkedClass+":has([name='"+b(f).attr("name")+"'])").removeClass(a.checkedClass);
						d.addClass(a.checkedClass)
					}
				},
				"mousedown.uniform touchend.uniform" : function() {
					if(!b(f).is(":disabled")) {e.addClass(a.activeClass)
					}
				},
				"mouseup.uniform touchbegin.uniform" : function() {e.removeClass(a.activeClass)
				},
				"mouseenter.uniform touchend.uniform" : function() {e.addClass(a.hoverClass)
				},
				"mouseleave.uniform" : function() {e.removeClass(a.hoverClass);
					e.removeClass(a.activeClass)
				}
			});
			if(b(f).attr("checked")) {d.addClass(a.checkedClass)
			}
			if(b(f).attr("disabled")) {e.addClass(a.disabledClass)
			}t(f)
		}

		function n(f) {
			var h = b(f);
			var e = b("<div />"), g = b("<span>" + a.fileDefaultText + "</span>"), c = b("<span>" + a.fileBtnText + "</span>");
			if(!h.css("display") == "none" && a.autoHide) {e.hide()
			}e.addClass(a.fileClass);
			g.addClass(a.filenameClass);
			c.addClass(a.fileBtnClass);
			if(a.useID && h.attr("id") != "") {e.attr("id", a.idPrefix + "-" + h.attr("id"))
			}h.wrap(e);
			h.after(c);
			h.after(g);
			e = h.closest("div");
			g = h.siblings("." + a.filenameClass);
			c = h.siblings("." + a.fileBtnClass);
			if(!h.attr("size")) {
				var d = e.width();
				h.attr("size", d / 10)
			}
			var i = function() {
				var j = h.val();
				if(j === "") {
					j = a.fileDefaultText
				} else {
					j = j.split(/[\/\\]+/);
					j = j[(j.length - 1)]
				}g.text(j)
			};
			i();
			h.css("opacity",0).bind({
				"focus.uniform" : function() {e.addClass(a.focusClass)
				},
				"blur.uniform" : function() {e.removeClass(a.focusClass)
				},
				"mousedown.uniform" : function() {
					if(!b(f).is(":disabled")) {e.addClass(a.activeClass)
					}
				},
				"mouseup.uniform" : function() {e.removeClass(a.activeClass)
				},
				"mouseenter.uniform" : function() {e.addClass(a.hoverClass)
				},
				"mouseleave.uniform" : function() {e.removeClass(a.hoverClass);
					e.removeClass(a.activeClass)
				}
			});
			if(b.browser.msie) {h.bind("click.uniform.ie7", function() {setTimeout(i, 0)
				})
			} else {h.bind("change.uniform", i)
			}
			if(h.attr("disabled")) {e.addClass(a.disabledClass)
			}b.uniform.noSelect(g);
			b.uniform.noSelect(c);
			t(f)
		}

		b.uniform.restore = function(c) {
			if(c == undefined) {
				c = b(b.uniform.elements)
			}b(c).each(function() {
				if(b(this).is(":checkbox")) {b(this).unwrap().unwrap()
				} else {
					if(b(this).is("select")) {b(this).siblings("span").remove();
						b(this).unwrap()
					} else {
						if(b(this).is(":radio")) {b(this).unwrap().unwrap()
						} else {
							if(b(this).is(":file")) {b(this).siblings("span").remove();
								b(this).unwrap()
							} else {
								if(b(this).is("button, :submit, :reset, a, input[type='button']")) {b(this).unwrap().unwrap()
								}
							}
						}
					}
				}b(this).unbind(".uniform");
				b(this).css("opacity", "1");
				var d = b.inArray(b(c), b.uniform.elements);
				b.uniform.elements.splice(d, 1)
			})
		};
		function t(c) {
			c = b(c).get();
			if(c.length > 1) {b.each(c, function(d, e) {b.uniform.elements.push(e)
				})
			} else {b.uniform.elements.push(c)
			}
		}

		b.uniform.noSelect = function(d) {
			function c() {
				return false
			}b(d).each(function() {
				this.onselectstart = this.ondragstart = c;
				b(this).mousedown(c).css({
					MozUserSelect : "none"
				})
			})
		};
		b.uniform.update = function(c) {
			if(c == undefined) {
				c = b(b.uniform.elements)
			}
			c = b(c);
			c.each(function() {
				var g = b(this);
				if(g.is("select")) {
					var d = g.siblings("span");
					var e = g.parent("div");
					e.removeClass(a.hoverClass + " " + a.focusClass + " " + a.activeClass);
					d.html(g.find(":selected").html());
					if(g.is(":disabled")) {e.addClass(a.disabledClass)
					} else {e.removeClass(a.disabledClass)
					}
				} else {
					if(g.is(":checkbox")) {
						var d = g.closest("span");
						var e = g.closest("div");
						e.removeClass(a.hoverClass + " " + a.focusClass + " " + a.activeClass);
						d.removeClass(a.checkedClass);
						if(g.is(":checked")) {d.addClass(a.checkedClass)
						}
						if(g.is(":disabled")) {e.addClass(a.disabledClass)
						} else {e.removeClass(a.disabledClass)
						}
					} else {
						if(g.is(":radio")) {
							var d = g.closest("span");
							var e = g.closest("div");
							e.removeClass(a.hoverClass + " " + a.focusClass + " " + a.activeClass);
							d.removeClass(a.checkedClass);
							if(g.is(":checked")) {d.addClass(a.checkedClass)
							}
							if(g.is(":disabled")) {e.addClass(a.disabledClass)
							} else {e.removeClass(a.disabledClass)
							}
						} else {
							if(g.is(":file")) {
								var e = g.parent("div");
								var f = g.siblings(a.filenameClass);
								btnTag = g.siblings(a.fileBtnClass);
								e.removeClass(a.hoverClass + " " + a.focusClass + " " + a.activeClass);
								f.text(g.val());
								if(g.is(":disabled")) {e.addClass(a.disabledClass)
								} else {e.removeClass(a.disabledClass)
								}
							} else {
								if(g.is(":submit") || g.is(":reset") || g.is("button") || g.is("a") || c.is("input[type=button]")) {
									var e = g.closest("div");
									e.removeClass(a.hoverClass + " " + a.focusClass + " " + a.activeClass);
									if(g.is(":disabled")) {e.addClass(a.disabledClass)
									} else {e.removeClass(a.disabledClass)
									}
								}
							}
						}
					}
				}
			})
		};
		return this.each(function() {
			if(b.support.selectOpacity) {
				var c = b(this);
				if(c.is("select")) {
					if(c.attr("multiple") != true) {
						if(c.attr("size") == undefined || c.attr("size") <= 1) {q(c)
						}
					}
				} else {
					if(c.is(":checkbox")) {p(c)
					} else {
						if(c.is(":radio")) {s(c)
						} else {
							if(c.is(":file")) {n(c)
							} else {
								if(c.is(":text, :password, input[type='email']")) {l(c)
								} else {
									if(c.is("textarea")) {o(c)
									} else {
										if(c.is("a") || c.is(":submit") || c.is(":reset") || c.is("button") || c.is("input[type=button]")) {m(c)
										}
									}
								}
							}
						}
					}
				}
			}
		})
	}
})(jQuery);
(function(a, c) {
	var b = function() {
	};
	b.prototype = {
		localizedMessages : {
			signin : {},
			signup : {}
		},
		init : function() {
			var d = this;
			c("input:checkbox").uniform();
			c("#user_password").focus(function() {d.showConfirmPassword()
			});
			c("a[rel=toggle-sign-up]").click(function() {c("#section_signin, #section_signup").each(function(f, g) {
					var h = c(this);
					if(h.is(":visible")) {h.hide()
					} else {h.fadeIn("fast")
					}
				});
				return false
			});
			this.initValidation();
			this.initFacebookEvents();
			this.initForgotPassword()
		},
		validationRules : {
			signin : {
				email : {
					required : true,
					email : true,
					maxlength : 255
				},
				password : {
					required : true,
					minlength : 5
				}
			},
			signup : {
				first_name : "required",
				last_name : "required",
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 5
				},
				password_confirmation : {
					required : true,
					minlength : 5,
					equalTo : "#user_password"
				}
			}
		},
		initValidation : function() {
			var d = this;
			this.validationOptions = {
				submitHandler : function(e) {e.submit();
					ajax_log("signup_funnel", "signup_login.submit_form");
					d.disableSubmit(e)
				},
				onkeyup : false,
				focusInvalid : false,
				wrapper : "span",
				errorPlacement : function(e, f) {e.prependTo(f.parents(".textInput"));
					e.animate({
						marginLeft : "-210px",
						opacity : "1"
					}, 200, function() {c(this).css({
							filter : "",
							display : "table-cell"
						})
					});
					f.one("focus", function() {d.clearError(e)
					});
					if(f.attr("id") === "user_password_confirmation") {d.showConfirmPassword()
					}
				}
			};
			c("#section_signin form").validate(c.extend({}, this.validationOptions, {
				rules : this.validationRules.signin
			}, {
				messages : this.localizedMessages.signin
			}));
			c("#section_signup form").validate(c.extend({}, this.validationOptions, {
				rules : this.fixSignupKeys(this.validationRules.signup)
			}, {
				messages : this.fixSignupKeys(this.localizedMessages.signup)
			}))
		},
		fixSignupKeys : function(f) {
			var e = {};
			for(var d in f) {
				if(f.hasOwnProperty(d)) {
					e["user[" + d + "]"] = f[d]
				}
			}
			return e
		},
		initFacebookEvents : function() {
			var e = a.fbAsyncInit;
			a.fbAsyncInit = function() {e();
				FB.getLoginStatus(function(f) {_gaq.push(["_trackEvent", "Login", "FacebookLoginStatus", f.status])
				})
			};
			var d = this;
			c("a.fb-button").click(function() {
				var f = c(this);
				FB.login(function(g) {
					if(g.session) {f.addClass("loading");
						c("#facebook_form").submit();
						d.disableSubmit()
					}
				}, {
					perms : Airbnb.FACEBOOK_PERMS
				});
				return false
			})
		},
		initForgotPassword : function() {c(".forgotPassword").click(function() {
				var e = c.trim(c("#signin_email").val()), d = c(this).attr("href");
				if(e.length) {
					d = d.split("?")[0] + "?email=" + e
				}c.colorbox({
					href : d,
					initialWidth : "458px",
					initialHeight : "228px",
					scrolling : false,
					opacity : 0.8
				});
				return false
			})
		},
		setLocalizedMessages : function(d) {
			this.localizedMessages = d
		},
		disableSubmit : function(d) {c("input:submit",d).attr("disabled", "disabled")
		},
		clearError : function(d) {d.animate({
				marginLeft : "-300px",
				opacity : "0"
			}, 200, function() {d.remove()
			})
		},
		showConfirmPassword : function() {c("#inputConfirmPassword .hidden").animate({
				height : "44px",
				"margin-top" : "12px"
			}, 300)
		}
	};
	a.Airbnb = a.Airbnb || {};
	a.Airbnb.SignInUp = new b();
	c(document).ready(function() {a.Airbnb.SignInUp.init();
		ajax_log("signup_funnel", "signup_login.document_ready");
		bind_logging("#user_first_name", "change", "signup_funnel", {
			prefix : "signup_login"
		});
		bind_logging("#user_last_name", "change", "signup_funnel", {
			prefix : "signup_login"
		});
		bind_logging("#user_email", "change", "signup_funnel", {
			prefix : "signup_login"
		});
		bind_logging("#user_password", "change", "signup_funnel", {
			prefix : "signup_login",
			field_fns : {
				change : function() {
					return {}
				}
			}
		});
		bind_logging("#user_password_confirmation", "change", "signup_funnel", {
			prefix : "signup_login",
			field_fns : {
				change : function() {
					return {}
				}
			}
		});
		bind_logging("a#fb-button", "click", "signup_funnel", {
			prefix : "signup_login"
		});
		bind_logging("a[rel=toggle-sign-up]", "click", "signup_funnel", {
			prefix : "signup_login",
			selector : "a[rel=toggle-sign-up]"
		});
		bind_logging("#signin_email", "change", "signup_funnel", {
			prefix : "signup_login"
		});
		bind_logging("#signin_password", "change", "signup_funnel", {
			prefix : "signup_login",
			field_fns : {
				change : function() {
					return {}
				}
			}
		})
	})
})(window, jQuery, undefined);
