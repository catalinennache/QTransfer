window.democard = `<div class="col-md-4 flip-card" style="">
<div class=" flip-card-inner" style="">
    <div class="flip-card-front">
        <i class="fa fa-file"></i>
        <h3 style="margin-bottom:0;">Realistic Filename</h3>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>Text File (TXT)</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>3256 Kb Size</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>Uploaded 29 min ago.</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>23 Downloads</p>
        </div>

        <a href="javascript:void(0)" onclick="flip(this)">Download</a>
        <span>|</span>
        <a href="javascript:void(0)" onclick="flip(this)">Delete</a>

    </div>


</div><!-- flip cARD-->


</div><!-- flip card view-->`;

window.filecard = `<div class="col-md-4 flip-card" style="">
<div class=" flip-card-inner" style="">
    <div class="flip-card-front">
        <i class="fa fa-file"></i>
        <h3 style="margin-bottom:0;">%%title%%</h3>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%type%% File (%%extension%%)</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%size%% Size</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>Uploaded %%UET%% ago.</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%download_times%% Downloads</p>
        </div>

        <a href="javascript:void(0)" cid="%%content_id%%" onclick="">Download</a>
        <span>|</span>
        <a href="javascript:void(0)" cid="%%content_id%%" onclick="">Delete</a>

    </div>


</div><!-- flip cARD-->


</div><!-- flip card view-->`

window.clipcard = `<div class="col-md-4 flip-card" style="">
<div class="flip-card-inner" style="">
    <div class="flip-card-front">
        <i class="fa fa-clipboard"></i>
        <h3 style="margin-bottom:0;">%%title%%</h3>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%8ch%%</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%size%% Size</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>Uploaded %%UTE%% ago.</p>
        </div>
        <div class="feature">
            <i class="fa fa-info"></i>
            <p>%%download_times%% Downloads</p>
        </div>
        <a href="javascript:void(0)" cid="%%content_id%%" onclick="Copy(this)">Copy</a>
        <span>|</span>
        <a href="javascript:void(0)" cid="%%content_id%%" onclick="Delete(this)">Delete</a>

    </div>


</div><!-- flip cARD-->


</div><!-- flip card view-->`
window.createClipboardCard = function (id,title, content, parent) {
    var card = window.clipcard;
    card = card.replace("%%title%%", title);
    card = card.replace('%%8ch%%', content.length > 8 ? content.substring(0, 8) + "..." : content);
    var m = encodeURIComponent(content).match(/%[89ABab]/g);
    card = card.replace("%%size%%",""+content.length + (m ? m.length : 0));
    card = card.replace("%%UTE%%", "0 min");
    card = card.replace("%%download_times%%", "0");
    card = card.replace("%%content_id%%",id);
    card = card.replace("%%content_id%%",id);
    parent.innerHTML += card;

};

window.createFileCard = function () {

}

window.createLargeFileCard = function () {

}

