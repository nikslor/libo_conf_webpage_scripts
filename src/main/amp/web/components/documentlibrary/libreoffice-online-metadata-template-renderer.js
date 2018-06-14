(function() {
	YAHOO.Bubbling
			.fire(
					"registerRenderer",
					{
						propertyName : "editingBanner",
						renderer : function loolEditing_renderer(record, label) {
							var jsNode = record.jsNode, properties = jsNode.properties, html = "";
							var editors = properties["loo:editors"] || "";
							return '<span>' + label + '<h2>' + editors
									+ '</h2></span>';
						}
					});
})();
