(function() {
	YAHOO.Bubbling
			.fire(
					"registerRenderer",
					{
						propertyName : "editingBanner",
						renderer : function loolEditing_renderer(record, label) {
							var jsNode = record.jsNode, properties = jsNode.properties, html = "";
							var editors = properties["lool:editors"] || "";
							var txt = this.msg("details.banner.lool-editing");
							return '<span>' + label + '</span><span>' + txt
									+ ' ' + editors + '</span>';
						}
					});
})();
