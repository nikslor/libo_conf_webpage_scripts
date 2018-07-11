<@markup id="css" >
   <#-- CSS Dependencies -->
   <@link href="${url.context}/res/fr/jeci/libreoffice-online/node-header/node-header.css" group="lool"/>
</@>

<@markup id="html">
    <#if editing>
        <@uniqueIdDiv>
            <div class="lool-node-header">
                <span class="lool-editing">${msg("lool.editing")}</span>
            </div>
        </@>
    </#if>
</@>
