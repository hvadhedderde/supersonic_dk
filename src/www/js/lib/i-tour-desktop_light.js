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
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {
				this.resetOffices();
				u.ac(this, "selected");
				u.as(u.qs(this.url), "display", "block");

			}
		}

		var nodes = u.qsa("div.tour ul li", scene);
		for(i = 0; node = nodes[i]; i++) {

			u.ce(node);
			node.clicked = function() {
				if(!u.qs(".scene").frozen) {
					this.large();
				}
				else {
					u.qs(".scene").close();
				}
			}

			node.large = function() {

				u.ac(this, "big");
				scene = u.qs(".scene");
				scene.frozen = true;
				scene.selected_node = this;
				scene.close = function() {
					this.frozen = false;
					u.rc(this.selected_node, "big");
					// u.as(this.selected_node, "position", "static");
					// u.a.setWidth(this.selected_node, 230);
					// u.a.setHeight(this.selected_node, 115);

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
			}
		}

		offices[u.random(0, offices.length-1)].clicked();


	}
}