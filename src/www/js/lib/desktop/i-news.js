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
						this.removeChild(u.qs(".articlebody", this));
					}

					u.a.transition(this, "all 0.4s ease-in");
					u.a.setHeight(this, this._start_height);
				}
				else {

					u.ac(this, "selected");

					this.response = function(response) {
						var text = this.appendChild(u.qs(".articlebody", response));

						this.transitioned = function() {
							u.a.transition(this, "none");
						}
						u.a.transition(this, "all 0.4s ease-in");
						u.a.setHeight(this, this._start_height + text.offsetHeight);
					}
					u.request(this, this.url);
				}

			}
		}

	}
}