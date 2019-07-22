function enable(){
    document.body.style.background = "rgba(240, 240, 240, 1)";
    console.log("mouseover");
}
 function disable(){
    document.body.style.background = "white";
    console.log("mouseout")
}
$(document).ready(async function () {
    
    $('#add').on('click', openAddModal);


    $('.modal-background').on('click', function (event) {
        if (event.target != $('.modal')[0] && $('.modal').find(event.target).length==0) {
            $('.modal-background').fadeOut(500);
            setTimeout(() => {
                $('.modal')[0].innerHTML = "";
            }, 500);
        }
    
    })

    $('select').on('change', async function (ev) {
        destroyTable();
        var columns = await getColumns(this.value);
        var entries = await getEntries(this.value);
        createTable(columns, entries);
    })

    destroyTable();
    var columns = await getColumns($('select')[0].value);
    var entries = await getEntries($('select')[0].value);
    createTable(columns, entries);


})


function openAddModal() {
    if(!$('select').val().includes("_")){
    $('.modal-background').css('display', 'block');
    var columns = document.getElementsByTagName('th');
    var entry_wrp = document.createElement('div');
    entry_wrp.classList.add("entry-wrp");
    for (var i = 1; i < columns.length; i++) {
        var wrapper = document.createElement('div');
        var label = document.createElement('label');
        var field = document.createElement('input');
        wrapper.classList.add('field-wrp');
        label.innerHTML = columns[i].innerHTML;
        field.type = "text";
        wrapper.appendChild(label);
        wrapper.appendChild(field);
        entry_wrp.appendChild(wrapper)
    }
    $('.modal')[0].appendChild(entry_wrp);
    var wrapper = document.createElement('div');
    var button = document.createElement('input');
    wrapper.classList.add("btn-wrp");
    button.type = "button";
    button.value = "Add";
    button.onclick = function () {
        var _values = [];
        Array.from($('.modal .field-wrp input')).forEach(element => {
            _values.push(element.value);
        });
        var url = window.location.href.includes("Dashboard") ? window.location.href + "/Add" : window.location.href + "/Dashboard/Add";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                table: $('select')[0].value,
                values: _values
            }, success: async function (data) {
                destroyTable();
                var columns = await getColumns($('select')[0].value);
                var entries = await getEntries($('select')[0].value);
                createTable(columns, entries);
            }, error: async function (data) {
                destroyTable();
                var columns = await getColumns($('select')[0].value);
                var entries = await getEntries($('select')[0].value);
                createTable(columns, entries);
            }
        })
        $('.modal-background').fadeOut(500);
        setTimeout(() => {
            $('.modal')[0].innerHTML = "";
        }, 500);
    }.bind(button);
    wrapper.appendChild(button);
    $('.modal')[0].appendChild(wrapper);
}

}

function openEditModal(target_id) {
    var target_contain = $('#' + target_id)[0].getElementsByTagName('td');
    $('.modal-background').css('display', 'block');
    var columns = document.getElementsByTagName('th');
    var entry_wrp = document.createElement('div');
    entry_wrp.classList.add("entry-wrp");
    for (var i = 0; i < columns.length; i++) {
        var wrapper = document.createElement('div');
        var label = document.createElement('label');
        var field = document.createElement('input');
        wrapper.classList.add('field-wrp');
        label.innerHTML = columns[i].innerHTML;
        field.type = "text";
        field.value = target_contain[i].innerHTML;
        field.readOnly = label.innerHTML === "ID" && $('select').val().includes('_');
        field.classList.add(label.innerHTML === "ID" && $('select').val().includes('_')?"disabled":"enabled");
        wrapper.appendChild(label);
        wrapper.appendChild(field);
        entry_wrp.appendChild(wrapper)
    }
    $('.modal')[0].appendChild(entry_wrp);
    var wrapper = document.createElement('div');
    var button = document.createElement('input');
    wrapper.classList.add("btn-wrp");
    button.type = "button";
    button.value = "Edit";
    button.onclick = function (ev) {
        var updated_values = [];
        Array.from($('.modal .field-wrp input')).forEach(element => {
            updated_values.push(element.value);
        });
        var url = window.location.href.includes("Dashboard") ? window.location.href + "/Edit" : window.location.href + "/Dashboard/Edit";
       
        $.ajax({
            url: url,
            type: "POST",
            data: {
                table: $('select')[0].value,
                id: target_id,
                values: updated_values
            }, success: async function (data) {
                destroyTable();
                var columns = await getColumns($('select')[0].value);
                var entries = await getEntries($('select')[0].value);
                createTable(columns, entries);
            }, error: async function (data) {
                destroyTable();
                var columns = await getColumns($('select')[0].value);
                var entries = await getEntries($('select')[0].value);
                createTable(columns, entries);
            }
        })
        $('.modal-background').fadeOut(500);
        setTimeout(() => {
            $('.modal')[0].innerHTML = "";
        }, 500);
    }.bind(target_id);
    wrapper.appendChild(button);
    $('.modal')[0].appendChild(wrapper);
}


function destroyTable() {
    document.getElementsByTagName('table')[0].parentElement.removeChild(document.getElementsByTagName('table')[0]);
}

function createTable(columns, entries) {
    var table = document.createElement('table');
    var columns_row = document.createElement('tr');
    Array.from(columns).forEach(column => {
        var column_ = document.createElement('th');
        column_.innerHTML = column;
        column_.style.width = 100 / (columns.length + 2) - 1 + "%";
        columns_row.appendChild(column_);
    });
    var cell_ = document.createElement('td');
    cell_.innerHTML = "Edit";
    cell_.style.width = 100 / (columns.length + 2) - 1 + "%";
    columns_row.appendChild(cell_);
    var cell_ = document.createElement('td');
    cell_.innerHTML = "Remove";
    cell_.style.width = 100 / (columns.length + 2) - 1 + "%";
    columns_row.appendChild(cell_);
    table.appendChild(columns_row);
    Array.from(entries).forEach(entry => {
        var row = document.createElement('tr');
        var entry_len = entry.length;
        Array.from(entry).forEach(cell => {
            var cell_ = document.createElement('td');
            cell_.innerHTML = cell;
            cell_.style.width = 100 / (entry_len + 2) - 1 + "%";
            row.appendChild(cell_);
        })

        var edit_button = document.createElement('input');
        var remove_button = document.createElement('input');
        edit_button.type = "button";
        edit_button.classList.add('controls-btns');
        remove_button.classList.add('controls-btns');
        remove_button.type = "button"
        edit_button.value = "Edit";
        remove_button.value = "Remove";
        remove_button.disabled = $('select').val().includes("_");
        remove_button.classList.add($('select').val().includes("_")?"disabled":"enabled");
        $(edit_button).on('click', EditEntry);
        $(remove_button).on('click', RemoveEntry);
        var cell_ = document.createElement('td');
        cell_.appendChild(edit_button);
        cell_.style.width = 100 / (entry_len + 2) - 1 + "%";
        row.appendChild(cell_);
        var cell_ = document.createElement('td');
        cell_.appendChild(remove_button);
        cell_.style.width = 100 / (entry_len + 2) - 1 + "%";
        row.appendChild(cell_);
        row.id = entry[0];
        table.appendChild(row);
    })

    document.getElementsByClassName('stage')[0].appendChild(table);

}

function getEntries(table_name) {
    return new Promise((resolve, reject) => {
        var url = window.location.href.includes("Dashboard") ? window.location.href + "/View" : window.location.href + "/Dashboard/View";
        console.log("url created", url);
        $.ajax({
            url: url,
            type: "POST",
            data: { table: table_name },
            success: function (data) {
                console.log("scs", data);
                resolve(data);
            }.bind(resolve), error: function (data) {
                console.log("fail", data);
                reject(data);
            }.bind(reject)
        })
    })
};

function getColumns(table_name) {
    return new Promise((resolve, reject) => {
        var url = window.location.href.includes("Dashboard") ? window.location.href + "/getCol" : window.location.href + "/Dashboard/getCol";
        console.log("url created", url);
        $.ajax({
            url: url,
            type: "POST",
            data: { table: table_name },
            success: function (data) {
                console.log("scs", data);
                resolve(data);
            }.bind(resolve), error: function (data) {
                console.log("fail", data);
                reject(data);
            }.bind(reject)
        })
    })
};

function RemoveEntry(event) {
    var target = event.target;
    var target_id = $(target).closest('tr')[0].id;
    var url = window.location.href.includes("Dashboard") ? window.location.href + "/Remove" : window.location.href + "/Dashboard/Remove";
    $.ajax({
        url: url,
        type: "POST",
        data: { table: $('select')[0].value, id: target_id },
        success: async function (ev) {
            destroyTable();
            var columns = await getColumns($('select')[0].value);
            var entries = await getEntries($('select')[0].value);
            createTable(columns, entries);
        }, error: async function (data) {
            destroyTable();
            var columns = await getColumns($('select')[0].value);
            var entries = await getEntries($('select')[0].value);
            createTable(columns, entries);
        }
    })
}

function EditEntry(event) {
    var target_id = $(event.target).closest('tr')[0].id;
    openEditModal(target_id);

}