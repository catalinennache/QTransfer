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
            <p>%%size%% Kb Size</p>
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

window.clipcard = `
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
            <p>%%size%% Kb Size</p>
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

<!-- flip card view-->`
window.createClipboardCard = function (card_info) {
    console.log("Creating card ",card_info);
    var id = card_info.id;
    var title = decodeURIComponent(card_info.title);
    var content = card_info.content;
    var parent = $('.card-view')[0];
    var vector =  document.createElement('div'); //<div class="col-md-4 flip-card" style=""></div>
    vector.classList.add('col-md-4');
    vector.classList.add('flip-card');
    var card = window.clipcard;
    card = card.replace("%%title%%", title);
    content = decodeURIComponent(content);
    card = card.replace('%%8ch%%', content.length > 8 ? content.substring(0, 8) + "..." : content);
    var m = encodeURIComponent(content).match(/%[89ABab]/g);
    card = card.replace("%%size%%",""+Math.round(((content.length + (m ? m.length : 0))/1024 + Number.EPSILON) * 100) / 100);
    card = card.replace("%%UTE%%", "0 min");
    card = card.replace("%%download_times%%", "0");
    card = card.replace("%%content_id%%",id);
    card = card.replace("%%content_id%%",id);
    vector.innerHTML = card;
    parent.appendChild(vector);
  //  window.assignHandlers(vector); no need of this since we have click="Copy(this)"

};

window.createFileCard = function () {

}

window.createLargeFileCard = function () {

}

