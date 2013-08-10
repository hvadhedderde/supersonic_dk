
Util.Objects["page"] = new function() {
	this.init = function(page) {

		// header reference
		page.hN = u.qs("#header");

		// content reference
		page.cN = u.qs("#content");

		// navigation reference
		page.nN = u.qs("#navigation");
		page.nN = u.ie(page.hN, page.nN);

		// footer reference
		page.fN = u.qs("#footer");

	}
}

u.e.addDOMReadyEvent(u.init);
