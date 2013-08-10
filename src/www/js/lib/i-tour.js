Util.Objects["tour"] = new function() {
	this.init = function(scene) {
		var i, node;

//		u.bug_force = true;

		var offices = u.qsa(".text .actions li", scene);
		for(i = 0; node = offices[i]; i++) {
			node.offices = offices;

			u.ce(node);
			node.url = "#" + node.url.split("#")[1];
			node.resetOffices = function() {
				for(i = 0; li = this.offices[i]; i++) {
					u.rc(li, "selected");
					u.as(u.qs(li.url), "display", "none");
				}
			}

			node.moved = function(event) {
//				u.bug("fuckup")
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {
//				u.bug("clicked:" + u.nodeId(this))
				this.resetOffices();
				u.ac(this, "selected");
				u.as(u.qs(this.url), "display", "block");

			}
		}

		var nodes = u.qsa("div.tour ul li", scene);
		for(i = 0; node = nodes[i]; i++) {

			u.ce(node);
			node.clicked = function() {
//				u.bug("clicked:" + u.nodeId(this))
				if(!u.qs(".scene").frozen) {
					this.large();
				}
			}

			node.large = function() {

				var id = u.gcs(this, "background-image");


				scene = u.qs(".scene");
				var div = u.ae(scene, "div", {"class":"large"});
				var list = u.ae(div, this.parentNode.cloneNode(true), {"id":"large_"+this.parentNode.id});

				scene.unfreeze = function() {
					this.frozen = false;
				}
				scene.close = function() {
					var large = u.qs(".large", this);
					// avoid fast-click reopens new series
					this.frozen = true;
					u.t.setTimer(this, this.unfreeze, 1500);
					if(large) {
						large.parentNode.removeChild(large);
					}
					u.e.removeEvent(document.body, "keyup", this.esc);
				}
				scene.esc = function(event) {
					event = event ? event : window.event;
					key = String.fromCharCode(event.keyCode);
					if(event.keyCode == 27) {
						u.e.kill(event);
						u.qs(".scene").close();
					}
				}
				u.e.addEvent(document.body, "keyup", scene.esc)
				var slides = u.qsa("li", list);
				var zindex = 1000;
				for(i = 0; slide = slides[i]; i++) {
					u.as(slide, "zIndex", zindex--);

//					u.e.removeEvent(slide, "mousemove", this.moved);

					if(id == u.gcs(slide, "background-image")) {
						list.selected_node = slide;
					}

					slide.i = i;
					u.e.click(slide);
					slide.clicked = function(event) {
//						u.bug("this.i%2:" + this.i%2)
//						if(this.i%2) {
							this.parentNode.swipedLeft(event);
//						}
//						else {
//							this.parentNode.swipedRight(event);
//						}
					}
				}
				u.as(list.selected_node, "zIndex", 1001);
				


				u.e.swipe(list, list);
				list.moved = function(event) {
//					u.bug("list.moved:" + u.nodeId(this));

					if(this.swiped && this.swiped.match("left|right")) {
						u.a.translate(u.qs("li", this), this.current_x, 0)
					}
				}

				list.swipedRight = function(event) {
//					u.bug("swiped right")
					if(this.selected_node) {
						li = this.selected_node;
						this.selected_node = false;
					}
					else {
						var li = u.qs("li", this);
					}
					li.transitioned = function() {
						if(u.qsa("li", this.parentNode).length < 2) {
							u.qs(".scene").close();
						}
						this.transitioned = null;
						u.a.transition(this, "none");
						this.parentNode.removeChild(this);
					}
					u.a.transition(li, "all 0.4s linear");
					u.a.translate(li, this.offsetWidth, 0);
				}
				list.swipedLeft = function(event) {
//					u.bug("swiped left")
					if(this.selected_node) {
						li = this.selected_node;
						this.selected_node = false;
					}
					else {
						var li = u.qs("li", this);
					}
					li.transitioned = function() {
						if(u.qsa("li", this.parentNode).length < 2) {
							u.qs(".scene").close();
						}
						this.transitioned = null;
						u.a.transition(this, "none");
						this.parentNode.removeChild(this);
					}
					u.a.transition(li, "all 0.4s linear");
					u.a.translate(li, -this.offsetWidth, 0)
				}
				
			}
		}


		


//		offices[u.random(0, offices.length-1)].clicked();
		offices[0].clicked();


		// var nodes = u.qsa("ul.people li", scene);
		// var node, i;
		// for(i = 0; node = nodes[i]; i++) {
		// 	node.person = person;
		// 	node.nodes = nodes;
		// 	u.ce(node);
		// 	node.resetNodes = function() {
		// 		for(i = 0; li = this.nodes[i]; i++) {
		// 			u.rc(li, "selected");
		// 		}
		// 	}
		// 
		// 	node.moved = function(event) {
		// 		u.e.resetEvents(this);
		// 	}
		// 	node.clicked = function(event) {
		// 
		// 		this.resetNodes();
		// 		u.ac(this, "selected");
		// 
		// 		this.Response = function(response) {
		// 			var profile = u.qs(".profile", response);
		// 
		// 			if(profile) {
		// 				this.person.innerHTML = "";
		// 				u.ae(this.person, profile);
		// 			}
		// 		}
		// 
		// 		u.Request(this, this.url);
		// 	}
		// 	if(u.e.event_pref == "mouse") {
		// 		u.e.addEvent(node, "mouseover", node.clicked);
		// 	}
		// }
		// 
		// if(nodes.length) {
		// 	nodes[u.random(0, nodes.length-1)].clicked();
		// }
	}
}