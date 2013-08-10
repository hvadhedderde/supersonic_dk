Util.Objects["newslist"] = new function() {
	this.init = function(scene) {

		var page = u.qs("#page");

		var news = u.qsa("ul.news li", scene);
		var node, i;
		for(i = 0; node = news[i]; i++) {

			node._start_height = parseInt(u.gcs(node, "height"));

			u.ce(node);
			node.moved = function(event) {
				u.e.resetEvents(this);
			}
			node.clicked = function(event) {

				if(u.hc(this, "selected")) {

					u.rc(this, "selected");
					this.transitioned = function() {
						this.transitioned = null;
						this.removeChild(u.qs(".text", this));
					}

					u.a.transition(this, "all 0.4s ease-in");
					u.a.setHeight(this, this._start_height);
				}
				else {

					u.ac(this, "selected");

					this.Response = function(response) {
						var text = this.appendChild(u.qs(".text", response));
						u.a.transition(this, "all 0.4s ease-in");
						u.a.setHeight(this, this._start_height + text.offsetHeight);
					}
					u.Request(this, this.url);
				}

			}
		}

	}
}