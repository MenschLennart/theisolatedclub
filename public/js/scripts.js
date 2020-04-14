if (typeof $ == 'undefined') {
    var $ = jQuery;
}

/**
 * A simple forEach() implementation for Arrays, Objects and NodeLists
 * @private
 * @param {Array|Object|NodeList} collection Collection of items to iterate
 * @param {Function} callback Callback function for each iteration
 * @param {Array|Object|NodeList|null} scope Object/NodeList/Array that forEach is iterating over (aka `this`)
 */
var forEach = function (collection, callback, scope) {
    if (Object.prototype.toString.call(collection) === '[object Object]') {
        for (var prop in collection) {
            if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                callback.call(scope, collection[prop], prop, collection);
            }
        }
    } else {
        for (var i = 0, len = collection.length; i < len; i++) {
            callback.call(scope, collection[i], i, collection);
        }
    }
};

$('#categorySelect').change(function() {
    var select = $('#categoryOption');
    var types = select.data('types');

    console.log(types)

    var typeSelect = $('#typeSelect');
    typeSelect.empty();

    forEach(types, function(value, prop, obj) {
        addTypeSelectOption('typeSelect', value['id'], value['title'])
    });
});

/**
 * Adds a div checkbox child to a given element
 * @param element
 * @param type_id
 * @param type_title
 */
function addTypeCheckBox(element, type_id, type_title) {
    const div = document.createElement('div');

    div.className = 'type-item form-check';
    div.innerHTML = `
        <input class="form-check-input" type="radio" name="type_id" id="inputType" value="` + type_id + `" required>
        <label class="form-check-label" for="inputType">` + type_title + `</label>
    `;
    document.getElementById(element).appendChild(div);
}

function addTypeSelectOption(element, type_id, type_title) {
    const optionElement = document.createElement('option');

    optionElement.value = type_id;
    optionElement.text = type_title;

    document.getElementById(element).appendChild(optionElement);
}

$('#category_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var category_id = button.data('category_id');
    var types = button.data('types');

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);

    modal.find('#activityTitle').text('Add ' + title + ' activity');
    modal.find('input[name="category_id"]').val(category_id);
    modal.find('#labelCategory').text(title);
    modal.find('#submitButton').addClass('btn-category-' + category_id);

    // Reset type checkboxes
    modal.find('#typesArea').empty();

    // Create type checkboxes
    forEach(types, function(value, prop, obj) {
        addTypeCheckBox('typesArea', value['id'], value['title'])
    });
});
