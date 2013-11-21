// news list image 
Util.Objects["newsImage"] = new function() {
	this.init = function(li) {

		u.as(li, "backgroundImage", "url(/images/"+u.cv(li, "item_id")+"/landscape/x100."+u.cv(li, "format")+")");

	}
}
// extension of curated list page
Util.Objects["curatedList"] = new function() {
	this.init = function(scene) {

		scene.nodes = u.qsa("li.page", scene);

		var i, node;
		for(i = 0; node = scene.nodes[i]; i++) {

			// enabled buttons
			node.bn_enable = u.qs(".status", node);
			if(node.bn_enable) {
				u.ce(node.bn_enable);
				node.bn_enable.clicked = function() {
					this.response = function(response) {
						if(response.cms_status == "success") {
							location.reload();
						}
						else {
							alert(response.message);
						}
					}
					u.request(this, this.url);
				}
			}

			// delete buttons
			node.bn_delete = u.qs(".delete", node);
			if(node.bn_delete) {
				node.bn_delete.a = u.qs("a", node.bn_delete);
				u.ce(node.bn_delete);

				node.bn_delete.restore = function(event) {
					this.a.innerHTML = "Delete";
					u.rc(this.a, "confirm");
				}

				node.bn_delete.clicked = function(event) {
					u.e.kill(event);

					// first click
					if(!u.hc(this.a, "confirm")) {
						u.ac(this.a, "confirm");
						this.a.innerHTML = "Confirm";
						this.t_confirm = u.t.setTimer(this, this.restore, 3000);
					}
					// confirm click
					else {
						u.t.resetTimer(this.t_confirm);

						this.response = function(response) {
							if(response.cms_status == "success") {
								location.reload();
							}
							else {
								alert(response.message);
							}
						}
						u.request(this, this.url);
					}

				}
			}

		}

		scene.curated_lists = u.qsa(".pages ul.news", scene);

		var list, j;
		// enable sorting of curated lists
		for(i = 0; list = scene.curated_lists[i]; i++) {

			u.s.sortable(list);
			list.picked = function(event) {
				u.bug(u.nodeId(event.target.node))
			}
			list.dropped = function(event) {

				this.response = function(response) {
					if(response.cms_status == "success") {
//						location.reload();
					}
					else {
						alert(response.message);
					}
				}
				// get new order
				var new_order = "";
				this.nodes = u.qsa("li.draggable", this);
				for(i = 0; node = this.nodes[i]; i++) {
					if(u.cv(node, "item_id")) {
						new_order += "/"+u.cv(node, "item_id");
					}
				}

				u.request(this, "/admin/cms/curatedpage/"+u.cv(this, "item_id")+"/updateCuration"+new_order)
			}

			// load images for list items
			list.nodes = u.qsa("li.draggable", list);
			for(j = 0; node = list.nodes[j]; j++) {
				u.as(node, "backgroundImage", "url(/images/"+u.cv(node, "item_id")+"/landscape/x50."+u.cv(node, "format")+")");
			}

		}

		// enable dragging news onto curated list
		var news_items = u.qsa(".all_items .items li.item", scene);
		for(i = 0; node = news_items[i]; i++) {
			node.scene = scene;

			// load background
			u.as(node, "backgroundImage", "url(/images/"+u.cv(node, "item_id")+"/landscape/x50."+u.cv(node, "format")+")");

			// click
			u.e.click(node);
			node.moved = function(event) {
				u.e.kill(event);

				this.scene._news_clone = u.ae(document.body, "div", {"class":"news_clone", "html":this.innerHTML});
				u.as(this.scene._news_clone, "height", u.gcs(this, "height"));
				u.as(this.scene._news_clone, "width", u.gcs(this, "width"));
				u.as(this.scene._news_clone, "padding", u.gcs(this, "padding"));
				u.as(this.scene._news_clone, "margin", u.gcs(this, "margin"));
				u.as(this.scene._news_clone, "backgroundImage", u.gcs(this, "background-image"));
				u.as(this.scene._news_clone, "position", "absolute");
				u.as(this.scene._news_clone, "left", u.absX(this)+"px");
				u.as(this.scene._news_clone, "top", u.absY(this)+"px");

				// mouse offset to top/left corner
				this.scene._news_clone.offset_x = u.absX(this) - u.eventX(event);
				this.scene._news_clone.offset_y = u.absY(this) - u.eventY(event);
//				u.bug(this.scene._news_clone.offset_x + " x " + this.scene._news_clone.offset_y)

				// remember what is being dragged
				this.scene._dragged_news = this;
				
				document.body.scene = this.scene;

				// follow mouse events
				u.e.addMoveEvent(document.body, this.scene._news_drag);
				u.e.addEndEvent(document.body, this.scene._news_drop);
			}
		}

		// attached to body
		scene._news_drag = function(event) {
//			u.bug("move")
			var left = (u.eventX(event) + this.scene._news_clone.offset_x);
			var top = (u.eventY(event) + this.scene._news_clone.offset_y);

			// move 
			u.as(this.scene._news_clone, "left", left+"px");
			u.as(this.scene._news_clone, "top", top+"px");

			var i, list;
			for(i = 0; list = this.scene.curated_lists[i]; i++) {
				if(
					u.eventX(event) > u.absX(list) && 
					u.eventX(event) < u.absX(list)+list.offsetWidth && 
					u.eventY(event) > u.absY(list) && 
					u.eventY(event) < u.absY(list)+list.offsetHeight
				) {
					u.ac(list, "activetarget");
				}
				else {
					u.rc(list, "activetarget");
					
				}
			}
		}

		// attached to body
		scene._news_drop = function(event) {
//			u.bug("drop")

			// stop tracking mouse
			u.e.removeMoveEvent(document.body, this.scene._news_drag);
			u.e.removeEndEvent(document.body, this.scene._news_drop);

			var i, list;
			for(i = 0; list = this.scene.curated_lists[i]; i++) {
				if(
					u.eventX(event) > u.absX(list) && 
					u.eventX(event) < u.absX(list)+list.offsetWidth && 
					u.eventY(event) > u.absY(list) && 
					u.eventY(event) < u.absY(list)+list.offsetHeight
				) {

					this.scene.response = function(response) {
						if(response.cms_status == "success") {

					
	//						u.notify(response.message);
							location.reload();

		//					location.href = this.actions["cancel"].url;
						}
						else {
							page.notify(response.cms_message, {"class":"error"});
		//					alert(response.message);
						}


						// if(response.cms_status == "success") {
						// 	location.reload();
						// }
						// else {
						// 	alert(response.message);
						// }
					}

					u.request(this.scene, "/admin/cms/curatedpage/"+u.cv(list, "item_id")+"/addToCuration/"+u.cv(this.scene._dragged_news, "item_id"))

					u.rc(list, "activetarget");
				}
				else {
					u.rc(list, "activetarget");
				}
			}

			// get rid of clone
			this.scene._news_clone.parentNode.removeChild(this.scene._news_clone);
			this.scene._news_clone = false;
			this.scene._dragged_news = false;
			this.scene = false;
		}
	}
}


// extension of curated list page
Util.Objects["slidesList"] = new function() {
	this.init = function(scene) {


		scene.list = u.qs("ul.items", scene);
		if(!scene.list) {
			scene.list = u.ae(scene, "ul", {"class":"items"});
		}
		scene.list.scene = scene;

		scene.default_class_text = "Add class";
		scene.nodes = u.qsa("li.item", scene.list);
		var i, node, slideclass;
		for(i = 0; node = scene.nodes[i]; i++) {
			slideclass = u.qs(".class", node);
			slideclass.scene = scene;
			slideclass.slide_id = u.cv(slideclass.parentNode, "slide_id");
			slideclass.item_id = u.cv(slideclass.parentNode, "item_id");
			if(slideclass.innerHTML == "") {
				slideclass.innerHTML = scene.default_class_text;
			}
			u.e.click(slideclass);
			slideclass.clicked = function() {
				var current_class = this.innerHTML != this.scene.default_class_text ? this.innerHTML : "";
				this.innerHTML = "";
				var input = u.ae(this, "input", {"name":"slideclass", "type":"text", "value":current_class});
				input.slideclass = this;
				u.e.click(input);
				input.clicked = function(event) {
					u.e.kill(event);
				}
				input.focus();
				input.onblur = function() {
					// update class

					this.response = function(response) {
						if(response.cms_status == "success") {
							// Notify of event
							if(typeof(page.notify) == "function") {
								page.notify(response.cms_message);
							}
							else {
								alert(response.cms_message[0]);
							}
						}
					}
					u.request(this, "/admin/cms/project/"+this.slideclass.item_id+"/updateSlideClass/"+this.slideclass.slide_id, {"method":"post", "params":u.f.getParams(this.slideclass)});
					// remove input and set text to new classname (og default text) 
					this.parentNode.innerHTML = this.value ? this.value : this.slideclass.scene.default_class_text;
				}
			}

		}

		scene.default_name_text = "Hvadhedderjeg?";
		scene.nodes = u.qsa("li.item", scene.list);
		var i, node, slidename;
		for(i = 0; node = scene.nodes[i]; i++) {
			slidename = u.qs("h2", node);
			slidename.scene = scene;
			slidename.slide_id = u.cv(slidename.parentNode, "slide_id");
			slidename.item_id = u.cv(slidename.parentNode, "item_id");
			if(slidename.innerHTML == "") {
				slidename.innerHTML = scene.default_name_text;
			}
			u.e.click(slidename);
			slidename.clicked = function() {
				var current_name = this.innerHTML != this.scene.default_name_text ? this.innerHTML : "";
				this.innerHTML = "";
				var input = u.ae(this, "input", {"name":"slidename", "type":"text", "value":current_name});
				input.slidename = this;
				u.e.click(input);
				input.clicked = function(event) {
					u.e.kill(event);
				}
				input.focus();
				input.onblur = function() {
					// update class

					this.response = function(response) {
						if(response.cms_status == "success") {
							// Notify of event
							if(typeof(page.notify) == "function") {
								page.notify(response.cms_message);
							}
							else {
								alert(response.cms_message[0]);
							}
						}
					}
					u.request(this, "/admin/cms/project/"+this.slidename.item_id+"/updateSlideName/"+this.slidename.slide_id, {"method":"post", "params":u.f.getParams(this.slidename)});
					// remove input and set text to new classname (og default text) 
					this.parentNode.innerHTML = this.value ? this.value : this.slidename.scene.default_name_text;
				}
			}

		}


		// sortable list
		if(u.hc(scene.list, "sortable")) {
			u.s.sortable(scene.list);
			scene.list.dropped = function() {
				
				var url = this.getAttribute("data-action");
				this.scene.nodes = u.qsa("li.item", scene.list);
				for(i = 0; node = this.scene.nodes[i]; i++) {
					url += "/"+u.cv(node, "slide_id");
				}
				this.response = function(response) {
					if(response.cms_status == "success") {
						location.reload();
					}
					else {
						alert(response.message);
					}
				}
				u.request(this, url);
			}
		}

		// add slide button buttons
		var bn_add_slide = u.qs(".add_slide", scene);
		if(bn_add_slide) {
			u.ce(bn_add_slide);
			bn_add_slide.clicked = function() {
				this.response = function(response) {
					if(response.cms_status == "success") {
						location.reload();
					}
					else {
						alert(response.message);
					}
				}
				u.request(this, this.url);
			}
		}
		
	}
}


// extension of curated list page
Util.Objects["slideEdit"] = new function() {
	this.init = function(scene) {


		scene.list = u.qs("ul.items", scene);
		if(!scene.list) {
			scene.list = u.ae(scene, "ul", {"class":"items"});
		}
		scene.list.scene = scene;

		scene.nodes = u.qsa("li.item", scene.list);

		// sortable list
		if(u.hc(scene.list, "sortable")) {
			u.s.sortable(scene.list);
			scene.list.dropped = function() {
				
				var url = this.getAttribute("data-action");
				this.scene.nodes = u.qsa("li.item", scene.list);
				for(i = 0; node = this.scene.nodes[i]; i++) {
					url += "/"+u.cv(node, "layer_id");
				}
				this.response = function(response) {
					if(response.cms_status == "success") {
						location.reload();
					}
					else {
						alert(response.message);
					}
				}
				u.request(this, url);
			}
		}


		// enabled buttons
		var bns_add_layer = u.qsa(".add_layer", scene);
		if(bns_add_layer) {

			var i, bn_add_layer;
			for(i = 0; bn_add_layer = bns_add_layer[i]; i++) {
				u.ce(bn_add_layer);
				bn_add_layer.clicked = function() {

					this.response = function(response) {
						if(response.cms_status == "success") {
							location.reload();
						}
						else {
							alert(response.message);
						}
					}
					u.request(this, this.url);
				}
			}
		}

	}
}

// extension of project slide text-layer form
Util.Objects["formTextLayer"] = new function() {
	this.init = function(form) {

		u.f.init(form);

		form.changed = form.submitted = function(iN) {

			this.response = function(response) {
				if(response.cms_status == "success") {
					u.notifier(response.cms_message);
//					location.href = this.actions["cancel"].url;
				}
				else {
					u.notifier(response.cms_message);
//					alert(response.message);
				}
			}
			u.request(this, this.action, {"method":"post", "params" : u.f.getParams(this)});
		}
	}
}

// extension of project slide text-layer form
Util.Objects["formColorLayer"] = new function() {
	this.init = function(form) {

		u.f.init(form);

		form.changed = form.submitted = function(iN) {

			this.response = function(response) {
				if(response.cms_status == "success") {
					u.notifier(response.cms_message);
//					location.href = this.actions["cancel"].url;
				}
				else {
					u.notifier(response.cms_message);
//					alert(response.message);
				}
			}
			u.request(this, this.action, {"method":"post", "params" : u.f.getParams(this)});
		}
	}
}


// extension of project slide text-layer form
Util.Objects["formVideoLayer"] = new function() {
	this.init = function(form) {
		u.bug("init formVideoLayer:" + u.nodeId(form));

		u.f.init(form);


		// set all radio_button item selected states 
		var i, item;
		var rbs = u.qsa(".radio_buttons .item input", form);
		for(i = 0; item = rbs[i]; i++) {
			if(item.checked) {
				u.ac(item.parentNode, "checked");
			}
			else {
				u.rc(item.parentNode, "checked");
			}
		}

		var file = u.qs(".field.files", form);
		if(file) {
			var _id = u.cv(file, "id");
			var _variant = u.cv(file, "variant");
			var _format = u.cv(file, "format");
			if(_id && _variant && _format) {
				var videoplayer = u.videoPlayer();
				u.ae(file, videoplayer);

				videoplayer.loadAndPlay("/videos/"+_id+"/"+_variant+"/x100."+_format)
//				u.as(file, "backgroundImage", "url(/images/"+_id+"/"+_variant+"/x100."+_format+")");
			}
		}


		form.changed = form.submitted = function(iN) {

			// file updated
			if(iN.type && iN.type == "file") {

				this.response = function(response) {
					response = JSON.parse(this.responseText);

					if(response.cms_status == "success") {
						location.reload();
					}
					else {
						u.notifier(response.message, {"type":"error"});
					}
				}


				var fd = new FormData();
				var i, file;
				for(i = 0; file = this.fields["files"].files[i]; i++) {
					fd.append("files["+i+"]", file);
				}

				this.HTTPRequest = u.createRequestObject();
				this.HTTPRequest.node = this;

				u.e.addEvent(this.HTTPRequest, "load", this.response);
				u.e.addEvent(this.HTTPRequest, "error", this.response);


				this.HTTPRequest.open("POST", this.action);
				this.HTTPRequest.send(fd);
			}

			// not file
			else {
				this.response = function(response) {
					if(response.cms_status == "success") {

					
//						u.notify(response.message);
						location.reload();

	//					location.href = this.actions["cancel"].url;
					}
					else {
						u.notifier(response.cms_message);
	//					alert(response.message);
					}
				}
				u.request(this, this.action, {"method":"post", "params" : u.f.getParams(this)});
			}

		}

	}
}

// extension of project slide text-layer form
Util.Objects["formImageLayer"] = new function() {
	this.init = function(form) {
		u.bug("init formImageLayer:" + u.nodeId(form));

		u.f.init(form);



		// set all radio_button item selected states 
		var i, item;
		var rbs = u.qsa(".radio_buttons .item input", form);
		for(i = 0; item = rbs[i]; i++) {
			if(item.checked) {
				u.ac(item.parentNode, "checked");
			}
			else {
				u.rc(item.parentNode, "checked");
			}
		}


		var file = u.qs(".field.files", form);
		if(file) {
			var _id = u.cv(file, "id");
			var _variant = u.cv(file, "variant");
			var _format = u.cv(file, "format");
			if(_id && _variant && _format) {
				u.as(file, "backgroundImage", "url(/images/"+_id+"/"+_variant+"/x100."+_format+")");
			}
		}



		form.changed = form.submitted = function(iN) {

			// file updated
			if(iN.type && iN.type == "file") {

				this.response = function(response) {
					response = JSON.parse(this.responseText);

					if(response.cms_status == "success") {
						location.reload();
					}
					else {
						u.notifier(response.cms_message);
					}
				}


				var fd = new FormData();
				var i, file;
				u.xInObject(this.fields)
				for(i = 0; file = this.fields["files"].files[i]; i++) {
					fd.append("files["+i+"]", file);
				}

				this.HTTPRequest = u.createRequestObject();
				this.HTTPRequest.node = this;

				u.e.addEvent(this.HTTPRequest, "load", this.response);
				u.e.addEvent(this.HTTPRequest, "error", this.response);


				this.HTTPRequest.open("POST", this.action);
				this.HTTPRequest.send(fd);
			}

			// not file
			else {
				this.response = function(response) {
					if(response.cms_status == "success") {

					
//						u.notify(response.message);
						location.reload();

	//					location.href = this.actions["cancel"].url;
					}
					else {
						u.notifier(response.cms_message);
	//					alert(response.message);
					}
				}
				u.request(this, this.action, {"method":"post", "params" : u.f.getParams(this)});
			}

		}


	}
}

