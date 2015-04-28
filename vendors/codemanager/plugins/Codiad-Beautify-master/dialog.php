<!--
    Copyright (c) Codiad & Andr3as, distributed
    as-is and without warranty under the MIT License. 
    See http://opensource.org/licenses/MIT for more information.
    This information must remain intact.
-->
<form id="beautify_form">
    <label>Beautify settings</label>
    Enable autobeautify at save: <br>
    <input type="checkbox" id="beautify_js">Beautify JS <br>
    <input type="checkbox" id="beautify_json">Beautify JSON <br>
    <input type="checkbox" id="beautify_html">Beautify HTML <br>
    <input type="checkbox" id="beautify_css">Beautify CSS <br>
    <button onclick="codiad.Beautify.save(); return false;">Close</button>
    <script>
        codiad.Beautify.get();
    </script>
</form>