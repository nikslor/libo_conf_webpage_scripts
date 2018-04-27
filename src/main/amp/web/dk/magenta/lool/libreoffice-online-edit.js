/**
 * LibreOffice edit online component.
 *
 * @namespace Magenta
 * @class Magenta.LibreOfficeOnline
 */
// Ensure Magenta root object exists
if (typeof Magenta == "undefined" || !Magenta) {
    var Magenta = {};

}


(function () {

    /**
     * Alfresco.CustomisePages constructor.
     *
     * @param {string} htmlId The HTML id of the parent element
     * @return {Alfresco.CustomisePages} The new CustomisePages instance
     * @constructor
     */
    Magenta.LibreOfficeOnline = function (htmlId) {
        return Magenta.LibreOfficeOnline.superclass.constructor.call(this, "Magenta.LibreOfficeOnline", htmlId, ["container"]);
    };

    YAHOO.extend(Magenta.LibreOfficeOnline, Alfresco.component.Base, {
        /**
         * Object container for initialization options
         *
         * @property options
         * @type object
         */
        options: {
            access_token: '',
            access_token_ttl: '',
            firstName: '',
            lastName: '',
            iFrameURL: '',
            userId: '',
            wopiFileURL: ''
        },

        /**
         * Fired by YUILoaderHelper when required component script files have
         * been loaded into the browser.
         *
         * @method onReady
         */
        onReady: function MLO_onReady() {
            var me = this;
            require(["jquery"], (function ($) {
                var form = '<form id="loleafletform" name="loleafletform" target="loleafletframe" action="' + me.options.iFrameURL + '" method="post">' +
                    '<input name="access_token" value="' + encodeURIComponent(me.options.access_token) + '" type="hidden"/>' +
                    '<input name="access_token_ttl" value="' + encodeURIComponent(me.options.access_token_ttl) + '" type="hidden"/></form>';

                var frame = '<iframe id="loleafletframe" name= "loleafletframe" allowfullscreen />';

                $('#loolcontainer').remove();

                var container = '<div id="loolcontainer"></div>';
                $('#libreoffice-online').append(container);
                var loolContainer = $('#loolcontainer');

                loolContainer.append(form);
                loolContainer.append(frame);

                $('#loleafletframe').load(function () {
                    console.log("Loaded loleafletframe");
                });

                $('#loleafletform').submit();
            }));

        }
    });
})();