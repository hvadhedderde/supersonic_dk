Util.Objects["people"] = new function() {
	this.init = function(scene) {

		var person = u.qs(".person");
		var nodes = u.qsa("ul.people li", scene);
		var node, i;
		for(i = 0; node = nodes[i]; i++) {
			node.person = person;
			node.nodes = nodes;
			u.ce(node);
			node.resetNodes = function() {
				for(i = 0; li = this.nodes[i]; i++) {
					u.rc(li, "selected");
				}
			}

			node.moved = function(event) {
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {

				this.resetNodes();
				u.ac(this, "selected");

				this.response = function(response) {
					var profile = u.qs(".profile", response);

					if(profile) {
						this.person.innerHTML = "";
						u.ae(this.person, profile);
					}
				}

				u.request(this, this.url);
			}
			if(u.e.event_pref == "mouse") {
				u.e.addEvent(node, "mouseover", node.clicked);
			}
		}

		if(nodes.length) {
			nodes[u.random(0, nodes.length-1)].clicked();
		}
	}
}